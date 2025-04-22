@extends('app')

@section('page')
    <!-- offer-section -->
    <div class="offer-section offer-section1">
        <h2>We offer you the <span class="support">best support</span></h2>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-md-0 mb-3">
                    <img style="max-width:200px;" src="{{asset('/assets/storage/Image1.png')}}" alt="image1">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-md-0 mb-3">
                    <img style="max-width:200px;" src="{{asset('/assets/storage/Image2.jpg')}}" alt="image2">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-md-0 mb-3">
                    <img style="max-width:200px;" src="{{asset('/assets/storage/Image3.jpg')}}" alt="image3">
                </div>
            </div>
        </div>
    </div>
    <!-- Popup-Section -->
    <div class="offer-section popup-section position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mb-lg-0 mb-md-0 mb-3">
                    <h2 data-aos="fade-up">Welcome to Carer Compass</h2>
                    <p>
                        Welcome to Carer Compass, your trusted solution for flexible,
                        long-term or short-term childcare when you need it most. Whether
                        you’re running errands, attending appointments, or just need a little
                        time to yourself, we’re here to give you peace of mind. Our friendly
                        and experienced carers provide a safe, caring space where
                        children can play, learn, and develop on their natural curiosity —
                        even for just a few hours. With convenient drop-in options and a
                        warm, welcoming environment, we’re here to make your day a little
                        easier and your child’s day a lot more fun!
                    </p>
                    <div class="popup-btn">
                        <a href="about.html">About us</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-lg-0 mb-md-0 mb-3 text-center">
                    <img style="width:600px;" src="{{asset('/assets/storage/Image4.jpg')}}" alt="image4">
                </div>

            </div>
        </div>
    </div>
    <!-- Service-Offer-Section -->
    <div class="service-offer-section service-offer-section2 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="service-offer-content" data-aos="fade-up">
                        <h2>Advice for parents</h2>
                        <p>Unsure on what to bring?</p>
                    </div>
                    <div class="service-inner">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <h4>Change of clothes (weather-appropriate)</h4>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <img style="max-width: 200px" src="{{asset('assets/storage/Image5.jpg')}}" alt="">
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <h4>Comfort
                                    items
                                    (if needed)
                                </h4>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <img style="max-width: 200px" src="{{asset('assets/storage/Image6.jpg')}}" alt="">
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <h4>Any
                                    necessary
                                    medications
                                </h4>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <img style="max-width: 200px" src="{{asset('assets/storage/Image7.jpg')}}" alt="">
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <h4>Snacks or
                                    special
                                    dietary needs</h4>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-5">
                                <img style="max-width: 200px" src="{{asset('assets/storage/Image8.jpg')}}" alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="w-lg-50" style="color:black" >
        Additionally these can be discussed and agreed
        with the carer prior to your booking. Don’t forget
        to bring big smiles and lots of energy!
    </h5>
@endsection

@section('hero')
    <!-- Search Start -->
    <div class="banner-container-comming-soon" style="padding-bottom: 200px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-md-0 mb-4">
                    <h2>Carer Compass</h2>
                    <h4 class="subscribe-text">Find Your Post Code!</h4>
                    <form action="/search" method="GET" class="input-group mb-3 input-field-form">
                        <input style="text-transform: uppercase" type="text" class="form-control input-form-input"
                               placeholder="Enter your post Code..." name="q" maxlength="3" required>
                        <div class="input-group-append form-button">
                            <button type="submit" class="btn btn-form-section">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->
@endsection
