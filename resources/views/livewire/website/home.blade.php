<div>
    {{-- Hero Section --}}
    <div @class('hero-section position-relative vh-100 d-flex align-items-center justify-content-center flex-column fade-section')>

        {{-- Background Video --}}
        <video @class('position-absolute top-0 start-0 w-100 h-100 object-fit-cover') autoplay muted loop playsinline>
            <source src="{{ asset('videos/hero-bg.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        {{-- Overlay (content stays above video) --}}
        <div @class('position-relative text-center text-white z-2 p-3 container')>
            <h1 @class('display-1 fw-semibold')>BUILD YOUR CAREER IN TRAVEL & TOURISM - GROW, EXPLORE, AND MAKE AN IMPACT</h1>
            <p @class('h5 fw-medium pb-3')>Join a workforce that travels the world, deliver unforgettable experiences, and builds real career opportunities</p>
            <a @class('btn btn-primary btn-lg') href="{{-- route('careers') --}}">View Careers</a>
        </div>

        {{-- Optional overlay for darkening video --}}
        <div @class('position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50')></div>
    </div>

    {{-- Intro Section --}}
    <div @class('row bg-white p-3  fade-section container')>
        <div @class('col-md-6 d-flex align-items-center justify-content-center')>
            <img src="{{ asset('images/img-1.png') }}" @class('img-fluid') alt="">
        </div>
        <div @class('col-md-6 d-flex align-items-center justify-content-center flex-column')>
            <h1 @class('text-primary text-center')>"Turning Dreams Into Careers"</h1>
            <h3>If you're chasing your dream role, we'll help you get there. If you're building your dream team, we'll help you find the right match. With smart search tools, trusted listings, and personalized suggestions, we make it simpler than ever to bring the right people together.</h3>
        </div>
    </div>

    {{-- Features Section --}}
    <div @class('row py-5 bg-body-tertiary d-flex align-items-center justify-content-center p-5 container fade-section') style="height: 80vh">
        {{-- Card 1 --}}
        <div @class('col-md-4')>
            <div @class('card p-3 shadow-sm')>
                <div @class('d-flex flex-column justify-content-center align-items-center')>
                    <img src="{{ asset('images/img-2.png') }}" alt="">
                    <h3>Global Impact</h3>
                    <p @class('text-center w-50')>Travel and tour companies strenghten economies and connect cultures and worldwide.</p>
                </div>
            </div>
        </div>

        {{-- Card 2 --}}
        <div @class('col-md-4')>
            <div @class('card p-3 shadow-sm')>
                <div @class('d-flex flex-column justify-content-center align-items-center')>
                    <img src="{{ asset('images/img-3.png') }}" alt="">
                    <h3>Accelerated Growth</h3>
                    <p @class('text-center w-50')>The tourism sectors drives accelerated growth by  expanding economic opportunities.</p>
                </div>
            </div>
        </div>

        {{-- Card 3 --}}
        <div @class('col-md-4')>
            <div @class('card p-3 shadow-sm')>
                <div @class('d-flex flex-column justify-content-center align-items-center')>
                    <img src="{{ asset('images/img-4.png') }}" alt="">
                    <h3>Teams and Communities</h3>
                    <p @class('text-center w-50')>Teams and communities drives development by uniting efforts and supporting mutual success.</p>
                </div>
            </div>
        </div>
    </div>
</div>
