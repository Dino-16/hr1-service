<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Recruitment\Requisition;
use App\Models\Recruitment\JobList;

class Dashboard extends Component
{
    public function render()
    {

        $statusCounts = [
            'requisitions'  => Requisition::where('status', 'Pending')->count(),
            'jobs'          => Requisition::where('status', 'Active')->count(),
        ];

        return view('livewire.user.dashboard', [
            'statusCounts' => $statusCounts
        ])
                ->layout('layouts.app');
    }
}
