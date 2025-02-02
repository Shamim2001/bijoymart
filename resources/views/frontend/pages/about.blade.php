@extends('frontend.components.layout')

@section('title')
    Home
@endsection


@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
            {{-- {{ Breadcrumbs::render('about') }} --}}
        </div><!-- End .container -->
    </nav>


    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">OUR STORY</h2>
            {!! $websiteInfo->our_history !!}
        </div><!-- End .container -->
    </div><!-- End .about-section -->

    <div class="features-section bg-gray">
        <div class="container">
            <h2 class="subtitle">WHY CHOOSE US</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-shipped"></i>

                        <div class="feature-box-content">
                            <h3>Free Shipping</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industr in some form.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-us-dollar"></i>

                        <div class="feature-box-content">
                            <h3>100% Money Back Guarantee</h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-online-support"></i>

                        <div class="feature-box-content">
                            <h3>Online Support 24/7</h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .features-section -->

    <div class="testimonials-section">
        <div class="container">
            <h2 class="subtitle text-center">HAPPY CLIENTS</h2>

            <div class="testimonials-carousel owl-carousel owl-theme images-left" data-owl-options="{'lazyLoad': true,'autoHeight': true,'dots': false,'responsive': {
                                                                                '0': {
                                                                                    'items': 1
                                                                                },
                                                                                '992': {
                                                                                    'items': 2
                                                                                }
                                                                            }
                                                                        }">

                @foreach ($reviews as $review)
                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="{{ asset('') . $review->image }}" alt="client" style="border-radius: 50%">
                            </figure>

                            <div>
                                <h4 class="testimonial-title">{{ $review->name }}</h4>
                                <span>{{ $review->designation }}</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>{{ $review->review }}</p>
                        </blockquote>
                    </div><!-- End .testimonial -->
                @endforeach


            </div><!-- End .testimonials-slider -->
        </div><!-- End .container -->
    </div><!-- End .testimonials-section -->

    <div class="counters-section bg-gray">
        <div class="container">
            <div class="row py-4">
                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="200" data-speed="2000" data-refresh-interval="50">200</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">MILLION CUSTOMERS</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="1800" data-speed="2000" data-refresh-interval="50">1800</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">TEAM MEMBERS</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="24" data-speed="2000" data-refresh-interval="50">24</span><span>HR</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="265" data-speed="2000" data-refresh-interval="50">265</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="99" data-speed="2000" data-refresh-interval="50">99</span><span>%</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .counters-section -->
    </main><!-- End .main -->
@endsection
