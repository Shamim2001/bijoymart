@extends('frontend.components.layout')

@section('title')
    My Account
@endsection

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last dashboard-content">
                    <h2>My Dashboard</h2>


                    <div class="card d-none">
                        <div class="card-header">
                            Address Book
                            <a href="{{ route('customer.addressbook') }}" class="card-edit">Edit</a>
                        </div><!-- End .card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="">Default Billing Address</h4>
                                    @if ($c_d_address != null)
                                        {{ $c_d_address->full_name }}
                                    @endif
                                    <address>
                                        <span class="font-weight-bold">
                                            @if ($c_d_address != null)
                                                {{ $c_d_address->address }}
                                            @endif
                                        </span><br>
                                        <br><br>
                                        <a href="{{ route('customer.addressbook') }}">Change Address</a>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="">Default Shipping Address</h4>
                                    <address>
                                        <span class="font-weight-bold">
                                            @if ($c_s_address != null)
                                                {{ $c_s_address->full_name }}
                                            @endif
                                        </span><br>
                                        @if ($c_s_address != null)
                                            {{ $c_s_address->address }}
                                        @endif
                                        <br><br>
                                        <a href="{{ route('customer.addressbook') }}">Change Address</a>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="">Default Billing Address</h4>
                                    @if ($c_d_address != null)
                                        {{ $c_d_address->full_name }}
                                    @endif
                                    <address>
                                        <span class="font-weight-bold">
                                            @if ($c_d_address != null)
                                                {{ $c_d_address->address }}
                                            @endif
                                        </span><br>
                                        <br><br>
                                        <a href="{{ route('customer.addressbook') }}">Change Address</a>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="">Default Shipping Address</h4>
                                    <address>
                                        <span class="font-weight-bold">
                                            @if ($c_s_address != null)
                                                {{ $c_s_address->full_name }}
                                            @endif
                                        </span><br>
                                        @if ($c_s_address != null)
                                            {{ $c_s_address->address }}
                                        @endif
                                        <br><br>
                                        <a href="{{ route('customer.addressbook') }}">Change Address</a>
                                    </address>
                                </div>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .card -->

                    <div class="row">
                        <div class="col-md-6 d-none">
                            <div class="card">
                                <div class="card-header">
                                    TOtal order items
                                </div>

                                <div class="card-body">

                                    10

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-none">
                            <div class="card">
                                <div class="card-header">
                                    Total Wishlist items
                                </div><!-- End .card-header -->

                                <div class="card-body">

                                    15
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Contact Information
                                    {{-- <a href="#" class="card-edit">Edit</a> --}}
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    <p>
                                        {{ $customer->name }}<br>
                                        {{ $customer->email }}<br>
                                        {{ $customer->phone }}<br><br>
                                        {{-- <a href="#">Change Password</a> --}}
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Referral Information
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    @php
                                        $referralLink = route('customer.register', ['ref' => $customer->referral_code]);
                                    @endphp
                                    <p>Your referral code is: <strong>{{ $customer->referral_code }}</strong></p>
                                    Refferal Bonus: <strong>&#2547; {{ $customer->referral_balance }} </strong><br>

                                    <p>Share this referral link with your friends:</p>
                                    <a target="_blank" href="{{ $referralLink }}">{{ $referralLink }}</a>

                                    {{-- <input type="text" value="{{ $referralLink }}" readonly> --}}
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    newsletters
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    <p>
                                        @if ($customer->offer_mail != 0)
                                            You are currently subscribed to newsletter.
                                        @else
                                            You are currently not subscribed to any newsletter.
                                        @endif
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->


                </div><!-- End .col-lg-9 -->

                @include('frontend.customer.leftmenu')

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

@endsection
