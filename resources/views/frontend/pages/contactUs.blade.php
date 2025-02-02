@extends('frontend.components.layout')

@section('title')
    Blog
@endsection


@section('topmenu')
    @include('frontend.components.topmenu')
@endsection
@push('css')
    <style>
        .form-control {
            height: 2rem;
        }

        .accordion-button {
            font-size: 16px;
            font-weight: bold
        }

        .contact-info p {
            margin-bottom: 0;
            margin-left: 0;
        }
    </style>
@endpush

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="demo4.html"><i class="icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Contact Us
                    </li>
                </ol>
            </div>
        </nav>

        <div class="container contact-us-container">
            <div class="contact-info">
                <div class="row">
                    <div class="col-12 mb-5">
                        <h2 class="ls-n-25 mb-1">Contact Info</h2>
                        {!! $websiteInfo->contact_info !!}
                    </div>

                    <div class="col">
                        <div class="row py-5" style="background: #f7f6f6">
                            <div class="col-sm-6 col-lg-3 py-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <i class="sicon-location-pin mb-2"></i>
                                    <h3 class="m-0">Address</h3>
                                    <h5 class="text-center">{{ $websiteInfo->address }}</h5>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3 py-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <i class="fa fa-mobile-alt mb-2"></i>
                                    <h3 class="m-0">Phone Number</h3>
                                    <h5 class="text-center">{{ $websiteInfo->contact_no }}</h5>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3 py-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <i class="far fa-envelope mb-2"></i>
                                    <h3 class="m-0">E-mail Address</h3>
                                    <h5 class="text-center">{{ $websiteInfo->email }}</h5>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3 py-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <i class="far fa-calendar-alt mb-2"></i>
                                    <h3 class="m-0">Working Days/Hours</h3>
                                    <h5 class="text-center">{{ $websiteInfo->working_hours }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-6 mb-2">Send Us a Message</h2>

                    <form class="mb-0" action="#">
                        <div class="mb-2">
                            {{-- <label class="mb-1" for="contact-name">Your Name <span class="required">*</span></label> --}}
                            <input type="text" class="form-control" id="contact-name" name="contact-name" placeholder="Your Name" required>
                        </div>

                        <div class="mb-2">
                            {{-- <label class="mb-1" for="contact-email">Your E-mail <span class="required">*</span></label> --}}
                            <input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="Your E-mail" required>
                        </div>

                        <div class="mb-2">
                            {{-- <label class="mb-1" for="contact-message">Your Message <span class="required">*</span></label> --}}
                            <textarea cols="30" rows="1" id="contact-message" class="form-control" name="contact-message" placeholder="Your Message" required></textarea>
                        </div>

                        <div class="form-footer mb-0">
                            <button type="submit" class="btn btn-dark font-weight-normal">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6">
                    <h2 class="mt-6 mb-2">Frequently Asked Questions</h2>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Curabitur eget leo at velit imperdiet viaculis vitae?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Curabitur eget leo at velit imperdiet vague iaculis vitae?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Curabitur eget leo at velit imperdiet varius iaculis vitae?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Curabitur eget leo at velit imperdiet varius vitae iaculis vitae?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8"></div>
    </main>
@endsection
