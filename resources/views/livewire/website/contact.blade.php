<div>

    {{-- Hero Section --}}
    <div @class('d-flex align-items-center justify-content-center flex-column p-3 vh-100')
    style="background: url({{ asset('images/contact.jpg') }}) no-repeat center center / cover ;">
        <h1 @class('display-1 text-center fw-semibold text-white  fade-section')>Get in Touch with  us for more information and updates</h1>
        <div @class('w-50 text-center text-white')>
            <h3 @class('display-6 pb-5 fade-section')>should you have any questions? we're happy to serve you</h3>
            <a @class('btn btn-primary btn-lg fade-section') href="#contactUs">Contact Us</a>
        </div>
    </div>

   {{-- Feature --}}
    <div @class('row')>

        {{-- Feature icon-1 --}}
        <div @class('col-md-3')>
            <div @class('d-flex align-items-center justify-content-center flex-column')>
                <div @class('bg-primary-subtle rounded-circle p-4 mb-3')>
                    <img src="{{ asset('images/icon-1.png') }}" height="60" width="60" alt="">
                </div>
                <div @class('px-3')>
                    <h3>Office Hours:</h3>
                    <p @class('m-0')>Monday - Friday</p>
                    <p>9:00 AM - 6:00 PM (PHT)</p>
                </div>
            </div>
        </div>

        {{-- Feature 2 --}}
        <div @class('col-md-3')>
            <div @class('d-flex align-items-center justify-content-center flex-column')>
                <div @class('bg-primary-subtle rounded-circle p-4 mb-3')>
                    <img src="{{ asset('images/icon-2.png') }}" height="60" width="60" alt="">
                </div>
                <div @class('px-3')>
                    <h3>Phone:</h3>
                    <p @class('m-0')>+639214365879</p>
                    <p>+639532438743</p>
                </div>
            </div>
        </div>

        {{-- Feature 3--}}
        <div @class('col-md-3')>
            <div @class('d-flex align-items-center justify-content-center flex-column') >
                <div @class('bg-primary-subtle rounded-circle p-4 mb-3')>
                    <img src="{{ asset('images/icon-3.png') }}" height="60" width="60" alt="">
                </div>
                <div @class('px-3')>
                    <h3>Location:</h3>
                    <p @class('m-0')>143 Metro Manila</p>
                    <p>Quezon City</p>
                </div>
            </div>
        </div>

        {{-- Feature 4 --}}
        <div @class('col-md-3')>
            <div @class('d-flex align-items-center justify-content-center flex-column')>
                <div @class('bg-primary-subtle rounded-circle p-4 mb-3')>
                    <img src="{{ asset('images/icon-4.png') }}" height="60" width="60" alt="">
                </div>
                <div @class('px-3')>
                    <h3 >Email:</h3>
                    <p @class('m-0')>jetlouge@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Cotact Form--}}
    <div @class('row  p-5') id="contactUs">
        <div @class('col-md-6 p-5')>
            <h2 @class('text-primary mb-3')>Contact Us</h2>
            <div @class('border rounded p-5')>
                <form>
                    <div @class('mb-3')>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input type="email" id="email" />
                    </div>
                    <div @class('mb-3')>
                        <x-input-label for="message" :value="__('Message')" />
                        <textarea @class('form-control') rows="3" cols="3" id="message"></textarea>
                    </div>
                    <x-button-primary>Submit</x-button-primary>
                </form>
            </div>
        </div>
        <div @class('col-md-6 p-3')>
            <div>
                <img src="{{ asset('images/img-6.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
