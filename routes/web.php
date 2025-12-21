<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\Dashboard;
use App\Livewire\User\Recruitment\Requisitions;

Route::get('/', Dashboard::class)->name('dashboard');

Route::get('/requisitions', Requisitions::class)->name('requisitions');