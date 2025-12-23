{{-- Sidebar --}}
<aside id="sidebar" @class('bg-white border-end p-3 shadow-sm')>

    {{-- Profile Section --}}
    <div @class('profile-section text-center')>
        {{-- 
        <img src="https://ui-avatars.com/api/?name={{ urlencode(substr(auth()->user()->name, 0, 1)) }}&size=150&background=0d6efd&color=fff"
            alt="Admin Profile" class="profile-img mb-2">
        <h6 @class('fw-semibold mb-1')>{{ auth()->user()->name }}</h6>
        <small @class('text-muted')>{{ auth()->user()->role }}</small>
         --}}
    </div>
   
    {{-- Navigation Menu --}}
    <ul @class('nav flex-column')>
        <li @class('nav-item')>
            <a href="{{ route('dashboard') }}"
                @class('nav-link text-dark ' . (request()->is('dashboard') ? 'active' : ''))>
                <i @class('bi bi-grid me-2')></i> Dashboard
            </a>
        </li>

        <li @class('nav-item')>
            <a href="#recruitmentMenu"
            role="button"
            aria-expanded="{{ (request()->is('requisitions') || request()->is('job-postings')) ? 'true' : 'false' }}"
            aria-controls="recruitmentMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-briefcase-fill me-2')></i> Recruitment</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>
            <div id="recruitmentMenu" @class('collapse ps-4 ' . ((request()->is('requisitions') || request()->is('job-postings')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('requisitions') }}"
                            @class('nav-link text-dark' . (request()->is('requisitions') ? 'active' : ''))>
                            <i @class('bi bi-file-earmark-plus me-2')></i> Requisition
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('job-lists') }}"
                            @class('nav-link text-dark' . (request()->is('job-lists') ? 'active' : ''))>
                            <i @class('bi bi-megaphone me-2')></i> Job Posting
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        {{--
        <li @class('nav-item')>
            <a href="#applicantsMenu"
            role="button"
            aria-expanded="{{ (request()->is('applications') || request()->is('filtered-resumes') || request()->is('candidates') || request()->is('interviews') || request()->is('request-rooms') || request()->is('offer-acceptance')) ? 'true' : 'false' }}"
            aria-controls="applicantsMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-people-fill me-2')></i> Applicants</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="applicantsMenu" @class('collapse ps-4 ' . ((request()->is('applications') || request()->is('filtered-resumes') || request()->is('candidates') || request()->is('interviews') || request()->is('request-rooms') || request()->is('offer-acceptance')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('applications') }}"
                            @class('nav-link text-dark' . (request()->is('applications') ? 'active' : ''))>
                            <i @class('bi bi-journal-text me-2')></i> Applications
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#recognitionMenu"
            role="button"
            aria-expanded="{{ (request()->is('shout-outs') || request()->is('shoutout-records')) ? 'true' : 'false' }}"
            aria-controls="recognitionMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-award-fill me-2')></i> Recognition</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="recognitionMenu" @class('collapse ps-4 ' . ((request()->is('shout-outs') || request()->is('shoutout-records')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('recognition') }}"
                        @class('nav-link text-dark'. (request()->is('shout-outs') ? 'active' : ''))>
                            <i @class('bi bi-megaphone me-2')></i> Give a Shoutout
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li @class('nav-item')>
            <a href="#applicantsMenu"
            role="button"
            aria-expanded="{{ (request()->is('applications') || request()->is('filtered-resumes') || request()->is('candidates') || request()->is('interviews') || request()->is('request-rooms') || request()->is('offer-acceptance')) ? 'true' : 'false' }}"
            aria-controls="applicantsMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-people-fill me-2')></i> Applicants</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="applicantsMenu" @class('collapse ps-4 ' . ((request()->is('applications') || request()->is('filtered-resumes') || request()->is('candidates') || request()->is('interviews') || request()->is('request-rooms') || request()->is('offer-acceptance')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('applications') }}"
                            @class('nav-link text-dark' . (request()->is('applications') ? 'active' : ''))>
                            <i @class('bi bi-journal-text me-2')></i> Applications
                        </a>
                    </li>

                    
                    <li @class('nav-item')>
                        <a href="{{ route('filtered-resumes') }}"
                            @class('nav-link text-dark' . (request()->is('filtered-resumes') ? 'active' : ''))>
                            <i @class('bi bi-funnel-fill me-2')></i> Filtered Applicants
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('candidates') }}"
                            @class('nav-link text-dark' . (request()->is('candidates') ? 'active' : ''))>
                            <i @class('bi bi-person-lines-fill me-2')></i> Candidates
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('request-rooms') }}"
                        @class('nav-link text-dark' . (request()->is('request-rooms') ? 'active' : ''))>
                            <i @class('bi bi-door-open me-2')></i> Request Room
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('interviews') }}"
                        @class('nav-link text-dark' . (request()->is('interviews') ? 'active' : ''))>
                            <i @class('bi bi-calendar-event me-2')></i> Interviews
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('offer-acceptance') }}"
                        @class('nav-link text-dark' . (request()->is('offer-acceptance') ? 'active' : ''))>
                            <i @class('bi bi-hand-thumbs-up me-2')></i> Offer Acceptance
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#onboardingMenu"
            role="button"
            aria-expanded="{{ (request()->is('new-hires') || request()->is('document-checklist') || request()->is('orientation-plan')) ? 'true' : 'false' }}"
            aria-controls="onboardingMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-person-badge-fill me-2')></i> Onboarding</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="onboardingMenu" @class('collapse ps-4 ' . ((request()->is('new-hires') || request()->is('document-checklist') || request()->is('orientation-plan')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('new-hires') }}"
                            @class('nav-link text-dark' . (request()->is('new-hires') ? 'active' : ''))>
                            <i @class('bi bi-person-plus-fill me-2')></i> New Hire
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('document-checklist') }}"
                            @class('nav-link text-dark' . (request()->is('document-checklist') ? 'active' : ''))>
                            <i @class('bi bi-check2-square me-2')></i> Document Checklist
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('orientation-plan') }}"
                            @class('nav-link text-dark'. (request()->is('orientation-plan') ? 'active' : ''))>
                            <i @class('bi bi-calendar-week me-2')></i> Orientation Plan
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#performanceMenu"
            role="button"
            aria-expanded="{{ (request()->is('new-hire-reviews') || request()->is('employee-evaluations') || request()->is('evaluation-form')) ? 'true' : 'false' }}"
            aria-controls="performanceMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-bar-chart-fill me-2')></i> Performance</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="performanceMenu" @class('collapse ps-4 ' . ((request()->is('new-hire-reviews') || request()->is('employee-evaluations') || request()->is('evaluation-form')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('new-hire-reviews') }}"
                            @class('nav-link text-dark' . (request()->is('new-hire-reviews') ? 'active' : ''))>
                            <i @class('bi bi-person-check-fill me-2')></i> New Hire Review
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('employee-evaluations') }}"
                            @class('nav-link text-dark' . (request()->is('employee-evaluations') ? 'active' : ''))>
                            <i @class('bi bi-clipboard-data-fill me-2')></i> Employee Evaluations
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('evaluation-form') }}"
                            @class('nav-link text-dark' . (request()->is('evaluation-form') ? 'active' : ''))>
                            <i @class('bi bi-file-earmark-bar-graph me-2')></i> Evaluation Forms
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#recognitionMenu"
            role="button"
            aria-expanded="{{ (request()->is('shout-outs') || request()->is('shoutout-records')) ? 'true' : 'false' }}"
            aria-controls="recognitionMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-award-fill me-2')></i> Recognition</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="recognitionMenu" @class('collapse ps-4 ' . ((request()->is('shout-outs') || request()->is('shoutout-records')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('shout-outs') }}"
                        @class('nav-link text-dark'. (request()->is('shout-outs') ? 'active' : ''))>
                            <i @class('bi bi-megaphone me-2')></i> Give a Shoutout
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('shoutout-records') }}" @class('nav-link text-dark'. (request()->is('shoutout-records') ? 'active' : ''))>
                            <i @class('bi bi-journal-richtext me-2')></i> Shoutout Records
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li @class('nav-item')>
            <a href="#settingMenu"
            role="button"
            aria-expanded="{{ (request()->is('user-logs') || request()->is('account')) ? 'true' : 'false' }}"
            aria-controls="settingMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-gear me-2')></i> Settings</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="settingMenu" @class('collapse ps-4 ' . ((request()->is('user-logs') || request()->is('account')) ? 'show' : ''))>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('user-logs') }}"
                        @class('nav-link text-dark' . (request()->is('user-logs') ? ' active' : ''))>
                            <i @class('bi bi-journal-text me-2')></i> User Logs
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('account') }}"
                        @class('nav-link text-dark' . (request()->is('account') ? ' active' : ''))>
                            <i @class('bi bi-shield-lock-fill me-2')></i> Account Settings
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <hr>

                <livewire:auth.logout />
        --}}

    </ul>

</aside>
