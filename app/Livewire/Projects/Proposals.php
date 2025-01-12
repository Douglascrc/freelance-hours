<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Proposals extends Component
{
    public Project $project;

    #[Computed()]
    public function lastProposalTime()
    {
        return $this->project->proposals()
            ->latest()->first()
            ->created_at->diffForHumans();
    }

    public function render()
    {
        $proposals = $this->project->proposals()->paginate(10);
        return view('livewire.projects.proposals', compact('proposals'));
    }
}
