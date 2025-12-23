<div>
    {{-- Hero Section --}}
    <div @class('d-flex align-items-center justify-content-center flex-column p-3 vh-100')
     style="background: url('{{ asset('images/img-7.jpg') }}') no-repeat center center/cover;">
        <h1 @class('display-1 text-center fw-semibold text-primary fade-section')>About Us</h1>
        <div @class('w-50 text-center')>
            <h3 @class('display-6  pb-5 text-white fade-section')>At Jetlouge Travels, we believe a career is more than a job, it's a journey. And every journey deserves the right direction.</h3>
            <a @class('btn btn-primary btn-lg fade-section') href="#learnMore">Learn More</a>
        </div>
    </div>

    {{-- Intro Section --}}
    <div @class('row bg-primary-subtle p-5')>
        <div @class('col-md-6 d-flex align-items-center justify-content-center flex-column')>
            <p @class('h5 text-center fw-medium pb-3')>We started with a simple mission: to make the hiring process more human, more efficient, and more rewarding for everyone. Too often, talented people struggle to find the right opportunity, while great companies miss out on exceptional candidates. We set out to change that.</p>
        </div>
        <div @class('col-md-6 d-flex align-items-center justify-content-center')>
            <img src="{{ asset('images/img-5.png') }}" @class('img-fluid') alt="">
        </div>
    </div>

    {{-- Features Section --}}
    <div @class('d-flex flex-column align-items-center jutify-content-center fade-section gap-3 py-5') id="learnMore">
        {{-- Card 1 --}}
        <div @class('card p-3 shadow-sm w-50')>
            <h3>Our Approach</h3>
            <p>We combine intelligent technology with a personal touch, making sure every experience—whether you're applying or hiring—is simple, transparent, and meaningful.</p>
        </div>
        {{-- Card 2 --}}
        <div @class('card p-3 shadow-sm w-50')>
            <h3>Our Promise</h3>
            <p>Whether you're taking your first step into the job market, chasing a fresh challenge, or building a dream team, Jetlouge Travels is here to help you reach your goals.</p>
        </div>
        {{-- Card 3 --}}
        <div @class('card p-3 shadow-sm w-50')>
            <h3>Our Passion</h3>
            <p>Travel isn't just about getting from one place to another, it's about the moments you'll remember forever. At Jetlouge Travels, we're driven by a love for exploration, culture, and connection. Every trip we plan is crafted with care, ensuring you don't just see a destination, you trully experience it.</p>
        </div>
    </div>
</div>
