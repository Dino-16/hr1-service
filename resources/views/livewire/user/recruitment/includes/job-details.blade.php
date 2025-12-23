@if($showModal && $jobDetail)
<div
    class="modal fade show d-block"
    tabindex="-1"
    style="background: rgba(15,35,85,.6);"
>
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header bg-white border-bottom px-4 py-4">
                <div class="w-100">
                    <h4 class="fw-bold mb-1">
                        {{ $jobDetail->position }}
                    </h4>
                </div>
                <button
                    type="button"
                    class="btn-close"
                    wire:click="closeModal"
                ></button>
            </div>
            <div class="modal-body bg-light px-4 py-4">
                <div class="bg-white border rounded p-4 mb-4">
                    <h6 class="fw-semibold mb-3">
                        Job Settings
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Employment Type</label>
                            <select class="form-select" wire:model="type">
                                <option value="On-Site">On-Site</option>
                                <option value="Remote">Remote</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Work Arrangement</label>
                            <select class="form-select" wire:model="arrangement">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                            @error('arrangement')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-white border rounded p-4 mb-4">
                    <h6 class="fw-semibold mb-2">Job Description</h6>
                    <p class="mb-0 text-secondary">
                        {{ $jobDetail->description }}
                    </p>
                </div>
                <div class="bg-white border rounded p-4">
                    <h6 class="fw-semibold mb-2">Qualifications</h6>
                    <p class="mb-0 text-secondary">
                        {{ $jobDetail->qualifications }}
                    </p>
                </div>
            </div>
            <div class="modal-footer bg-white border-top px-4 py-3">
                <button
                    type="button"
                    class="btn btn-outline-secondary px-4"
                    wire:click="closeModal"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    class="btn btn-primary px-4"
                    wire:click="publishJob"
                >
                    <i class="bi bi-check-circle me-1"></i>
                    Activate
                </button>
            </div>
        </div>
    </div>
</div>
@endif
