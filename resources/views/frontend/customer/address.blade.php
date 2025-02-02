@extends('frontend.components.layout')

@section('title')
    Address
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
                    @if (session('message'))
                        <div class="text-center alert alert-{{ session('status') }}">{{ session('message') }}</div>
                    @endif
                    <div class="row justify-content-center mb-3">

                        <div class="col-md-12 d-flex justify-content-lg-between border-bottom pb-2">

                            <h4 class="m-0">Customer Address</h4>
                            {{-- <h6 class="m-0 pt-2">New member? <a href="{{ route('customer.register') }}">Register</a> here
                            </h6> --}}
                        </div>
                    </div>
                    <div class="row justify-content-center text-center">
                        @if (session('login_error'))
                            <div class="col-md-12 alert alert-danger }}">{{ session('login_error') }}</div>
                        @endif
                    </div>

                    <form action="{{ route('customer.address') }}" method="POST">
                        @csrf
                        <div class="row justify-content-center mb-5">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="division">Division</label>
                                    <select name="division" id="division"
                                        class="form-control dynamic @error('division') is-invalid @enderror"
                                        data-name="district" value="{{ old('division') }}"
                                        style="height: 44px;padding: 10px;">
                                        <option value="">==Select Division==</option>
                                        @foreach ($division as $div)
                                            <option value="{{ $div->division }}">{{ $div->division }}</option>
                                        @endforeach
                                    </select>
                                    <span>@error('division') <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <select name="district" id="district"
                                        class="form-control dynamic @error('district') is-invalid @enderror"
                                        data-name="thana" style="height: 44px;padding: 10px;">
                                        <option value="">==Select District==</option>
                                    </select>
                                    <span>@error('district') <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="thana">Thana</label>
                                    <select name="thana" id="thana"
                                        class="form-control @error('thana') is-invalid @enderror"
                                        value="{{ old('thana') }}" style="height: 44px;padding: 10px;">
                                        <option value="">==Select Thana==</option>
                                    </select>
                                    <span>@error('thana') <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" id="address" placeholder="Your Address"
                                        value="{{ old('address') }}" style="height: 16px">
                                    <span>@error('address') <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                        id="name" placeholder="Your Name" value="{{ old('name') }}" style="height: 16px">
                                    <span>@error('name') <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Phone Number *</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" placeholder="11 Digit Number" value="{{ old('phone') }}"
                                        style="height: 16px">
                                    <span>@error('phone') <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror</span>
                                </div>
                                {{-- <div class="form-group">
                                    <input type="checkbox" name="shipping_address" id="shipping_address" value="yes">
                                    <label for="shipping_address">My Shipping Address</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="billing_address" id="billing_address" value="yes">
                                    <label for="billing_address">My Billing Address</label>
                                </div> --}}
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Save Address"
                                        class="btn btn-block btn-primary">
                                </div>
                            </div>

                        </div>
                    </form>

                </div><!-- End .col-lg-9 -->

                @include('frontend.customer.leftmenu')

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

@endsection
