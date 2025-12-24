<div class="container-fluid py-4">
    <div class="row">
        
        {{-- LEFT SIDE: Applicant List --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Applicants</h5>
                </div>
                <div class="list-group list-group-flush" style="max-height: 80vh; overflow-y: auto;">
                    @foreach($applications as $app)
                        <button wire:click="selectApplication({{ $app->id }})" 
                            {{-- Corrected the variable to $selectedId --}}
                            class="list-group-item list-group-item-action border-0 p-3 {{ $selectedId == $app->id ? 'bg-light border-start border-primary border-4' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $app->first_name }} {{ $app->last_name }}</h6>
                                    {{-- Use the string column now --}}
                                    <small class="text-muted">{{ $app->applied_position }}</small> 
                                </div>
                                @if($app->filteredResume)
                                    <span class="badge rounded-pill {{ $app->filteredResume->rating_score >= 80 ? 'bg-success' : ($app->filteredResume->rating_score >= 50 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ $app->filteredResume->rating_score }}%
                                    </span>
                                @else
                                    <span class="spinner-border spinner-border-sm text-secondary"></span>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </div>
                <div class="card-footer bg-white">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: Detailed View --}}
        <div class="col-md-8">
            @if($this->selectedApplication)
                @php $app = $this->selectedApplication; @endphp
                <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
                    <div class="card-body p-4">
                        
                        {{-- Header with Rating --}}
                        <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
                            <div>
                                <h2 class="fw-bold mb-1">{{ $app->first_name }} {{ $app->last_name }}</h2>
                                {{-- Show applied position in detail header --}}
                                <p class="text-primary fw-semibold mb-1">{{ $app->applied_position }}</p>
                                <p class="text-muted"><i class="bi bi-envelope me-2"></i>{{ $app->email }} | <i class="bi bi-geo-alt me-2"></i>{{ $app->city }}</p>
                            </div>
                            @if($app->filteredResume)
                                <div class="text-center">
                                    <div class="h2 fw-bold text-primary mb-0">{{ $app->filteredResume->rating_score }}%</div>
                                    <span class="badge bg-light text-primary border border-primary">{{ $app->filteredResume->qualification_status }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            {{-- Personal Data --}}
                            <div class="col-md-4 border-end">
                                <h6 class="text-uppercase fw-bold small text-secondary">AI Profile Extraction</h6>
                                <p class="mb-1"><strong>Age:</strong> {{ $app->filteredResume->age ?? 'N/A' }}</p>
                                <p class="mb-1"><strong>Gender:</strong> {{ $app->filteredResume->gender ?? 'N/A' }}</p>
                                
                                <h6 class="text-uppercase fw-bold small text-secondary mt-4">Skills</h6>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($app->filteredResume->skills ?? [] as $skill)
                                        <span class="badge bg-secondary rounded-pill">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Experience & Education --}}
                            <div class="col-md-8 px-4">
                                <h6 class="text-uppercase fw-bold small text-secondary">AI Summary</h6>
                                <p class="text-dark bg-light p-3 rounded-3">{{ $app->filteredResume->ai_summary ?? '' }}</p>

                                <h6 class="text-uppercase fw-bold small text-secondary mt-4">Extracted Experience</h6>
                                <ul class="list-unstyled">
                                    @foreach($app->filteredResume->experience ?? [] as $exp)
                                        <li class="mb-2">
                                            <i class="bi bi-briefcase text-primary me-2"></i>
                                            <strong>{{ $exp['title'] }}</strong> at {{ $exp['company'] }} <span class="text-muted">({{ $exp['years'] }})</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <h6 class="text-uppercase fw-bold small text-secondary mt-4">Education</h6>
                                <ul class="list-unstyled">
                                    @foreach($app->filteredResume->education ?? [] as $edu)
                                        <li class="mb-2">
                                            <i class="bi bi-book text-primary me-2"></i>
                                            <strong>{{ $edu['degree'] }}</strong> - {{ $edu['school'] }}
                                        </li>
                                    @endforeach
                                </ul>
                                
                                <a href="{{ Storage::url($app->resume_path) }}" target="_blank" class="btn btn-outline-dark btn-sm mt-4">
                                    <i class="bi bi-file-earmark-pdf"></i> View Original Resume
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center bg-white rounded-4 shadow-sm" style="height: 60vh;">
                    <i class="bi bi-person-badge fs-1 text-light"></i>
                    <p class="text-muted mt-3">Select an applicant to see the AI analysis</p>
                </div>
            @endif
        </div>

    </div>
</div>