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


    public function showJobDetails($id)
    {
        $this->jobDetail = JobList::findOrFail($id);

        // preload current values
        $this->type = $this->jobDetail->type;
        $this->arrangement = $this->jobDetail->arrangement;
        $this->showModal = true;
    }

    public function publishJob()
    {
        $this->validate([
            'type' => 'required|in:On-Site,Remote,Hybrid',
            'arrangement' => 'required|in:Full-Time,Part-Time',
        ]);

        $this->jobDetail->update([
            'type' => $this->type,
            'arrangement' => $this->arrangement,
            'status' => 'Active', // 🔥 auto activate
        ]);

        session()->flash('status', 'Job successfully published.');

        $this->closeModal();
    }


    public function closeModal()
    {
        $this->showModal = false;
        $this->jobDetail = null;
    }



    public function render()
    {
        $requisitions = Requisition::where('status', 'approved')->get();
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
