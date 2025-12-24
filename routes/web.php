<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Website\Home;
use App\Livewire\Website\About;
use App\Livewire\Website\Contact;
use App\Livewire\Website\Careers;
use App\Livewire\Website\ApplyNow;
use App\Livewire\User\Dashboard;
use App\Livewire\User\Recruitment\Requisitions;
use App\Livewire\User\Recruitment\JobLists;
use App\Livewire\User\Applicants\Applications;

Route::middleware('guest')->group(function() {
    Route::get('/', Home::class)->name('home');
    Route::get('/about', About::class)->name('about');
    Route::get('/contact', Contact::class)->name('contact');
    Route::get('/careers', Careers::class)->name('careers');
    Route::get('/apply-now/{id}', ApplyNow::class)->name('apply-now');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');

Route::get('/requisitions', Requisitions::class)->name('requisitions');
Route::get('/job-lists', JobLists::class)->name('job-lists');   
Route::get('/applications', Applications::class)->name('applications');   