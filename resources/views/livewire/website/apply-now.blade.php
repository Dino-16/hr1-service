<div @class(['p-5', 'bg-light'])>
    <a @class(['nav-link', 'text-secondary', 'mb-4']) href="{{ route('careers') }}">
        <i class="bi bi-arrow-left-circle me-2"></i>Back to Jobs
    </a>

    <div @class(['container', 'bg-white', 'p-5', 'rounded-4', 'shadow-sm'])>
        {{-- Header Section --}}
        <div class="border-bottom mb-5 pb-3">
            <h2 class="fw-bold mb-1">Application Form</h2>
            <p class="text-muted">Position: <span style="color: #213A5C;" class="fw-semibold">{{ $job->position }}</span></p>
        </div>

        <x-alert-success />

        <form wire:submit.prevent="submitApplication">
            <div @class(['row', 'g-4'])>
                
                {{-- SECTION: Personal Information --}}
                <div class="col-12">
                    <h5 class="text-uppercase tracking-wider text-secondary fw-bold small mb-3">Personal Information</h5>
                </div>

                <div class="col-md-4">
                    <x-input-label for="first-name" :value="__('First Name')" />
                    <x-text-input wire:model="applicantFirstName" type="text" id="first-name" class="form-control-lg" required />
                    <x-input-error field="applicantFirstName" />
                </div>

                <div class="col-md-3">
                    <x-input-label for="middle-name" :value="__('Middle Name')" />
                    <x-text-input wire:model="applicantMiddleName" type="text" id="middle-name" class="form-control-lg" required />
                    <x-input-error field="applicantMiddleName" />
                </div>

                <div class="col-md-3">
                    <x-input-label for="last-name" :value="__('Last Name')" />
                    <x-text-input wire:model="applicantLastName" type="text" id="last-name" class="form-control-lg" required />
                    <x-input-error field="applicantLastName" />
                </div>

                <div class="col-md-2">
                    <x-input-label for="suffix-name" :value="__('Suffix (Optional)')" />
                    <x-text-input wire:model="applicantSuffixName" type="text" id="suffix-name" class="form-control-lg" placeholder="e.g. Jr." />
                    <x-input-error field="applicantSuffixName" />
                </div>

                {{-- SECTION: Contact --}}
                <div class="col-md-6">
                    <x-input-label for="applicant-email" :value="__('Email Address')" />
                    <x-text-input wire:model="applicantEmail" type="email" id="applicant-email" class="form-control-lg" required />
                    <x-input-error field="applicantEmail" />
                </div>

                <div class="col-md-6">
                    <x-input-label for="applicant-phone" :value="__('Phone Number')" />
                    <x-text-input wire:model="applicantPhone" type="number" id="applicant-phone" class="form-control-lg" required />
                    <x-input-error field="applicantPhone" />
                </div>

                {{-- SECTION: Address --}}
                <div class="col-12 mt-5">
                    <h5 class="text-uppercase tracking-wider text-secondary fw-bold small mb-3">Current Address</h5>
                </div>

                <div class="col-md-6">
                    <x-input-label for="region" :value="__('Region')" />
                    <select wire:model.live="selectedRegion" id="region" class="form-select form-select-lg border-gray-300">
                        <option value="">Select Region</option>
                        @foreach($regions as $region)
                            <option value="{{ $region['code'] }}">{{ $region['name'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error field="selectedRegion" />
                </div>

                <div class="col-md-6">
                    <x-input-label for="province" :value="__('Province')" />
                    <select wire:model.live="selectedProvince" id="province" class="form-select form-select-lg border-gray-300" {{ empty($provinces) ? 'disabled' : '' }}>
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error field="selectedProvince" />
                </div>

                <div class="col-md-6">
                    <x-input-label for="city" :value="__('City / Municipality')" />
                    <select wire:model.live="selectedCity" id="city" class="form-select form-select-lg border-gray-300" {{ empty($cities) ? 'disabled' : '' }}>
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city['code'] }}">{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error field="selectedCity" />
                </div>

                <div class="col-md-6">
                    <x-input-label for="barangay" :value="__('Barangay')" />
                    <select wire:model.live="selectedBarangay" id="barangay" class="form-select form-select-lg border-gray-300" {{ empty($barangays) ? 'disabled' : '' }}>
                        <option value="">Select Barangay</option>
                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay['name'] }}">{{ $barangay['name'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error field="selectedBarangay" />
                </div>

                <div class="col-12">
                    <x-input-label for="house-street" :value="__('House No. / Street / Building')" />
                    <x-text-input wire:model="houseStreet" type="text" id="house-street" class="form-control-lg" placeholder="e.g. Unit 1203, San Miguel St." required />
                    <x-input-error field="houseStreet" />
                </div>

                {{-- SECTION: Resume --}}
                <div class="col-12 mt-5">
                    <h5 class="text-uppercase tracking-wider text-secondary fw-bold small mb-3">Professional Documents</h5>

                    @if (!$applicantResumeFile)
                        {{-- Show Upload Box only if no file is selected --}}
                        <label for="resume" class="w-100">
                            <input wire:model="applicantResumeFile" type="file" accept=".pdf,.doc,.docx" id="resume" class="d-none" required />
                            <div class="upload-box d-flex flex-column justify-content-center align-items-center p-4 border border-2 border-dashed rounded-4 bg-light text-center" style="cursor: pointer; min-height: 150px; border-color: #dee2e6 !important;">
                                <i class="bi bi-file-earmark-pdf fs-1 text-primary mb-2"></i>
                                <span class="fw-bold">Click to upload Resume</span>
                                <span class="text-muted small">PDF, DOC, or DOCX (Max 2MB)</span>
                            </div>
                        </label>
                    @else
                        {{-- Show File Info and Remove Button if file exists --}}
                        <div class="alert alert-info py-3 px-4 rounded-4 d-flex align-items-center justify-content-between shadow-sm border-0" style="background-color: #e3f2fd;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Resume Attached</div>
                                    <div class="text-muted small">{{ $applicantResumeFile->getClientOriginalName() }}</div>
                                </div>
                            </div>
                            <button type="button" wire:click="removeResume" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                <i class="bi bi-trash me-1"></i> Remove
                            </button>
                        </div>
                    @endif

                    <x-input-error field="applicantResumeFile" />

                    {{-- Uploading Progress State --}}
                    <div wire:loading wire:target="applicantResumeFile" class="mt-2 text-primary small">
                        <div class="spinner-border spinner-border-sm me-2" role="status"></div> 
                        Uploading file...
                    </div>
                </div>

                {{-- SECTION: Terms & Submission --}}
                <div class="col-12 mt-5 border-top pt-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreed-to-terms" wire:model="agreedToTerms">
                        <label class="form-check-label ms-2" for="agreed-to-terms">
                            I agree to the <a href="javascript:void(0)" wire:click="$toggle('showTerms')" class="text-primary text-decoration-none fw-bold">terms and conditions</a>.
                        </label>
                    </div>
                    @error('agreedToTerms') <p class="text-danger small">{{ $message }}</p> @enderror

                    {{-- Dynamic Terms Display --}}
                    @if($showTerms)
                        <div class="bg-light p-4 rounded-3 border mb-4 shadow-sm animate__animated animate__fadeInUp" style="max-height: 250px; overflow-y: auto;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold mb-0">Privacy Statement & Terms</h6>
                                <button type="button" wire:click="$set('showTerms', false)" class="btn-close small"></button>
                            </div>
                            <p class="small text-muted mb-2">
                                At Jetlouge Travel, we are dedicated to protecting the privacy and personal data of all individuals... (your full text here)
                            </p>
                            <p class="small text-muted mb-0">
                                We do not share your information with third parties without your explicit consent... (your full text here)
                            </p>
                        </div>
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm" style="background-color: #213A5C; border: none;">
                            <span wire:loading.remove wire:target="submitApplication">Submit Application</span>
                            <span wire:loading wire:target="submitApplication">
                                <span class="spinner-border spinner-border-sm me-2"></span>Processing...
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

