@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview and quick insights')
@section('breadcrumbs', 'Dashboard')

<div @class('pt-2')>
    <div @class('row g-3 mb-3')>
        @foreach ($statusCounts as $status => $count)
            <div @class('col-3')>
                <div @class('card p-3 shadow-sm border-0 h-100')>
                    {{-- Icon --}}
                    <div @class('mb-2')>
                        @switch($status)
                            @case('requisitions')
                                <i @class('bi bi-hourglass-split text-warning fs-3')></i>
                                @break
                            @case('jobs')
                                <i @class('bi bi-check-circle-fill text-success fs-3')></i>
                                @break
                        @endswitch
                    </div>

                    <div @class('ps-2')>
                        {{-- Count --}}
                        <div @class('fw-semi fs-4')>
                            {{ $count }}
                        </div>

                        {{-- Label --}}
                        <div @class('text-muted small')>
                            {{ $status }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
