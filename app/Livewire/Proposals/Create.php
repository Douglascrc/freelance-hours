<?php

namespace App\Livewire\Proposals;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Actions\ArrangePositions;

class Create extends Component
{
    public Project $project;

    public bool $modal = false;

    public bool $agree = false;

    public string $email = '';

    public int $hours = 0;

    public function validation()
    {

    }

    protected array $rules = [
        'agree' => 'required|boolean',
        'email' => 'required|email',
        'hours' => 'required|numeric|min:1',
    ];

    public function save()
    {
  
        $this->validate();
        
        if (!$this-> agree) {
            $this->addError('agree', 'Você precisa concordar com os termos de uso');
            return;
        }

        DB::transaction(function () {
            $proposal =
            $this->project->proposals()
                ->updateOrcreate(
                    ['email' => $this->email],
                    ['hours' => $this->hours]
                );
        
            $this->arrangePosition($proposal);
        });
        $this->project->author->notify(new newProposal($this->project));

        $this->dispatch('proposal::created');
        $this->modal = false;
    }

    public function arrangePosition($proposal)
    {
        $query = DB::select(
            '
        select *, row_number() over (order by hours asc) as newPosition
        from proposals
        where project_id = :project',
            ['project' => $this->project->id]
        );

        $position = collect($query)
            ->where('id', '=', $proposal->id)->first();
        $otherProposal = collect($query)->where('position', '=', $position->newPosition)->first();

        if ($otherProposal) {
            $proposal->update(['position_status' > 'up']);
            Proposal::query()->where('id', '=', $otherProposal->id)->update(['position_status', 'down']);
        }
        ArrangePositions::run($this->project->id);
    }

    #[On('proposal::created')]
    public function render()
    {
        return view('livewire.proposals.create');
    }
}
