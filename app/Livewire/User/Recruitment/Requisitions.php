<?php

namespace App\Livewire\User\Recruitment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Recruitment\Requisition;

class Requisitions extends Component
{
    public function render()
    {
        return view('livewire.user.recruitment.requisitions')
                ->layout('layouts.app');
    }
}
