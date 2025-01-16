<x-layouts.app>

    <div class="grid grid-cols-3 gap-6">
        <livewire:projects.show :project="$project" />
        <livewire:projects.proposals :project="$project" />

        <livewire.proposals.create :project="$project" />
    </div>
    
</x-layouts.app>