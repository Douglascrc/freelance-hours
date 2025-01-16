<?php

namespace App\Livewire\Proposals;

use Livewire\Component;
use App\Models\Project;

class Create extends Component
{
    public Project $project;

    public bool $modal = false;

    public bool $agree = false;

    public string $email = '';

    public int $hours = 0;

    public function validation() {

    }

    protected array $rules = [
        'agree' => 'required|boolean',
        'email' => 'required|email',
        'hours' => 'required|numeric|min:1',
    ];

    public function save() {
  
        $this->validate();
        
        if(!$this-> agree) {
            $this->addError('agree', 'Você precisa concordar com os termos de uso');
            return;
        }

        $this->project->proposals()
            ->updateOrcreate(
                ['email' => $this->email],
                ['hours' => $this->hours]
            );

        $this->modal = false;
    }

    public function render()
    {
        return view('livewire.proposals.create');
    }
}
