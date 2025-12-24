<?php

namespace App\Livewire\User\Recruitment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Recruitment\Requisition;
use App\Models\Recruitment\JobList;

class JobLists extends Component
{
    use WithPagination;

    public $showModal = false;
    public $jobDetail;

    public $type;
    public $arrangement;
    public $expiration_date; 

    public function showJobDetails($id)
    {
        $this->jobDetail = JobList::findOrFail($id);

        $this->type = $this->jobDetail->type;
        $this->arrangement = $this->jobDetail->arrangement;
        // 2. Preload value if it exists
        $this->expiration_date = $this->jobDetail->expiration_date; 
        
        $this->showModal = true;
    }

    public function publishJob()
    {
        $this->validate([
            'type'            => 'required|in:On-Site,Remote,Hybrid',
            'arrangement'     => 'required|in:Full-Time,Part-Time',
            'expiration_date' => 'required|date|after:today', 
        ]);

        $this->jobDetail->update([
            'type'            => $this->type,
            'arrangement'     => $this->arrangement,
            'expiration_date' => $this->expiration_date, 
            'status'          => 'Active', 
        ]);

        session()->flash('status', 'Job successfully published.');
        $this->closeModal();
    }

    
    public function closeModal()
    {
        $this->showModal = false;
        $this->jobDetail = null;
        $this->reset(['expiration_date']); 
    }

    public function render()
    {
        $requisitions = Requisition::where('status', 'Accepted')->get();
        $query = JobList::query()->latest();
        $jobs = $query->paginate(10);
        $postedJobs = JobList::where('status', 'Active')->latest()->get();

        return view('livewire.user.recruitment.job-lists', [
            'requisitions' => $requisitions,
            'jobs'         => $jobs,
            'postedJobs'   => $postedJobs,
        ])->layout('layouts.app');
    }
}
