<?php

namespace App\Livewire\Proposals;

use Livewire\Component;
use App\Models\Project;

class Create extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.proposals.create');
    }
}