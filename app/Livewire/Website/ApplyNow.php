<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Applicants\Application;
use App\Models\Recruitment\JobList;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ApplyNow extends Component
{
    use WithFileUploads;

    public $applicantLastName = '';
    public $applicantFirstName = '';
    public $applicantMiddleName = '';
    public $applicantSuffixName = '';
    public $applicantPhone = '';
    public $applicantEmail = '';
    public $applicantResumeFile;
    public $job;
    public $agreedToTerms = false;
    public $showTerms = false;

    // Address Properties
    public $regions = [];
    public $provinces = [];
    public $cities = [];
    public $barangays = [];

    public $selectedRegion = null;
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedBarangay = null;
    public $houseStreet = ''; 

    public function mount($id)
    {
        $this->job = JobList::findOrFail($id);
        
        // Fix for Region Load
        $this->regions = Http::withoutVerifying()
            ->get('https://psgc.cloud/api/regions')
            ->json();
    }

    // Cascading Logic with SSL Fix
    public function updatedSelectedRegion($regionCode)
    {
        $this->provinces = Http::withoutVerifying()
            ->get("https://psgc.cloud/api/regions/{$regionCode}/provinces")
            ->json();
            
        $this->reset(['selectedProvince', 'selectedCity', 'selectedBarangay', 'cities', 'barangays']);
    }

    public function updatedSelectedProvince($provinceCode)
    {
        $this->cities = Http::withoutVerifying()
            ->get("https://psgc.cloud/api/provinces/{$provinceCode}/cities-municipalities")
            ->json();
            
        $this->reset(['selectedCity', 'selectedBarangay', 'barangays']);
    }

    public function updatedSelectedCity($cityCode)
    {
        $this->barangays = Http::withoutVerifying()
            ->get("https://psgc.cloud/api/cities-municipalities/{$cityCode}/barangays")
            ->json();
            
        $this->reset(['selectedBarangay']);
    }

    public function submitApplication()
    {

        $this->validate([
            'applicantLastName'    => 'required|string|max:50',
            'applicantFirstName'   => 'required|string|max:50',
            'applicantMiddleName'  => 'required|string|max:50',
            'applicantEmail'       => 'required|email|max:100',
            'applicantPhone'       => 'required|string|max:50',
            'applicantResumeFile'  => 'required|file|mimes:pdf,doc,docx|max:2048',
            'agreedToTerms'        => 'accepted',
            'selectedRegion'       => 'required',
            'selectedProvince'     => 'required',
            'selectedCity'         => 'required',
            'selectedBarangay'     => 'required',
            'houseStreet'          => 'required|string|max:250',
        ]);

        // Create formatted address string
        $fullAddress = "{$this->houseStreet}, {$this->selectedBarangay}, {$this->selectedCity}, {$this->selectedProvince}";

        $applicantResumePath = $this->applicantResumeFile->store('', 'resumes');
        $applicantResumeUrl = Storage::disk('resumes')->url($applicantResumePath);

        Application::create([
            'applied_position'      => $this->job->position,
            'applicant_last_name'   => $this->applicantLastName,
            'applicant_first_name'  => $this->applicantFirstName,
            'applicant_middle_name' => $this->applicantMiddleName,
            'applicant_suffix_name' => $this->applicantSuffixName,
            'applicant_address'     => $fullAddress, 
            'applicant_phone'       => $this->applicantPhone,
            'applicant_email'       => $this->applicantEmail,
            'applicant_resume_file' => $applicantResumeUrl,
            'status'                => 'Not Filtered',
            'agreed_to_terms'       => $this->agreedToTerms,
        ]);

        session()->flash('success', 'Application submitted successfully');
        return redirect()->route('application', ['id' => $this->job->id]);
    }

    // Inside your ApplyNow class
    public function removeResume()
    {
        $this->applicantResumeFile = null;
    }

    public function render()
    {
        return view('livewire.website.apply-now')->layout('layouts.website');
    }
}