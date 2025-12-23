@section('page-title', 'Job Posting')
@section('page-subtitle', 'Manage job post')
@section('breadcrumbs', 'job posting')

<div @class('pt-2')>
    <div @class('row')>
        <div @class('col-md-8')>
            <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
                <h3>All Posted Jobs</h3>
                <p @class('text-secondary mb-0')>
                    Overview of posted jobs
                </p>
            </div>
            <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
                <table @class('table')>
                    <thead>
                        <tr @class('bg-dark')>
                            <th @class('text-secondary')>Position</th>
                            <th @class('text-secondary')>Posted Date</th>
                            <th @class('text-secondary')>Expiration Date</th>
                            <th @class('text-secondary')>Status</th>
                            <th @class('text-secondary')>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            @if($job->status === 'Active')
                                <tr wire:key="{{ $job->id }}">
                                    <td>{{ $job->position }}</td>
                                    <td>{{ $job->created_at }}</td>
                                    <td>{{ $job->updated_at }}</td>
                                    <td>{{ $job->status }}</td>
                                    <td><button>Deactivate</button></td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="7" @class('text-center text-muted')>
                                    No Active Jobs.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $jobs->links() }}
            </div>
        </div>
        <div @class('col-md-4')>
            <div @class('col-12')>
                <div @class('card shadow-sm mb-3')>
                    <div @class('card-header fw-bold bg-white')>
                        <h3 @class(' mb-0 py-3')>Accepted Requisitions</h3>
                    </div>  

                    <div @class('card-body')>
                        @forelse($requisitions as $req)
                            <p @class('mb-1 fw-semibold')>
                                <i @class('bi bi-check-circle me-2')></i>
                                {{ $req->position }}
                            </p>
                        @empty
                            <p @class('text-muted fst-italic')>
                                No accepted requisitions available.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div @class('col-md-12')>
            <div @class('card')>
                <div @class('card-header bg-white')>
                    <h3 @class('mb-0 py-3')>Lists of Jobs</h3>
                </div>
                <div @class('card-body')>
                    @foreach ($jobs as $job)
                        @if($job->status === 'Inactive')
                            <div @class('d-flex justify-content-between align-items-center')>
                                <p @class('mb-1 fw-semibold')>
                                    <i @class('bi bi-suitcase-lg me-2')></i>
                                    {{ $job->position }}
                                </p>
                                <button
                                    @class('btn btn-primary btn-sm')
                                    wire:click="showJobDetails({{ $job->id }})"
                                >
                                    <i @class('bi bi-pencil-square')></i>
                                </button>
                            </div>
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('livewire.user.recruitment.includes.job-details');
</div>