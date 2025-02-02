@extends('frontend.components.layout')

@section('title')
    Register
@endsection

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4 mb-3">
            <div class="col-md-8 d-flex justify-content-between border-bottom pb-2">
                <h4 class="m-0">Customer Register</h4>
                <h6 class="m-0 pt-2">Already member? <a href="{{ route('customer.login') }}">Login</a> here</h6>
            </div>

        </div>
        <div class="row justify-content-center text-center">
            @if (session('message'))
                <div class="col-md-8 alert alert-{{ session('type') }}">{{ session('message') }}</div>
            @endif
        </div>
        {{-- @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        @endif --}}

        <form action="{{ route('customer.register') }}" method="POST">
            @csrf
            <div class="row justify-content-center mb-5">
                <div class="col-md-4">
                    <input type="hidden" name="referral_by" value="{{ $referrerCode }}">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" style="height: 16px">
                        @error('name')
                            <span class="text-danger" style="font-size: 12px"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="11 Digit Number" value="{{ old('phone') }}" style="height: 16px">
                        @error('phone')
                            <span class="text-danger" style="font-size: 12px"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" style="height: 16px">
                        @error('password')
                            <span class="text-danger" style="font-size: 12px"> {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" style="height: 16px">
                        @error('email')
                            <span class="text-danger" style="font-size: 12px"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="check" id="check" value="1" checked>
                        <label for="check">I want to receive exclusive offers and promotions.</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Sign UP" class="btn w-100 btn-warning">
                    </div>
                    <label for="">By clicking “SIGN UP”, I agree to <a href="">Terms</a> of Use and <a href="">Privacy
                            Policy</a></label>
                </div>
            </div>
        </form>
    </div>
@endsection
