<?php

namespace App\Livewire\User\Applicants;

use App\Models\Applicants\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Applications extends Component
{
    use WithPagination;

    public $selectedId = null;

    protected $paginationTheme = 'bootstrap';

    public function selectApplication($id)
    {
        $this->selectedId = $id;
    }

    public function render()
    {
        return view('livewire.user.applicants.applications', [
            // REMOVED 'job' FROM HERE
            'applications' => Application::with(['filteredResume'])
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }

    #[\Livewire\Attributes\Computed]
    public function selectedApplication()
    {
        if (!$this->selectedId) {
            return null;
        }

        // REMOVED 'job' FROM HERE AS WELL
        return Application::with(['filteredResume'])->find($this->selectedId);
    }
}