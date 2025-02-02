@extends('frontend.components.layout')

@section('title')
    Login
@endsection
@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    {{-- @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    @endif --}}
    <div class="container">
        <div class="row justify-content-center mt-4 mb-3">
            <div class="col-md-8 d-flex justify-content-lg-between border-bottom pb-2">
                <h4 class="m-0">Customer Login</h4>
                <h6 class="m-0 pt-2">New member? <a href="{{ route('customer.register') }}">Register</a> here</h6>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            @if (session('login_error'))
                <div class="col-md-8 alert alert-danger }}">{{ session('login_error') }}</div>
            @endif
        </div>

        <form action="{{ route('customer.login') }}" method="POST">
            @csrf
            <div class="row justify-content-center mb-5">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_email">Phone Number or Email</label>
                        <input type="text" class="form-control" name="phone_email" id="phone_email" placeholder="Phone/Email" value="{{ old('phone_email') }}" style="height: 16px">
                        @error('phone_email')
                            <span class="text-danger" style="font-size: 12px"> {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password" style="height: 16px">
                        @error('password')
                            <span class="text-danger" style="font-size: 12px"> {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <a href="javascript:">Forget Password?</a>
                </div>
                <div class="col-md-4">
                    <div class="mb-1">
                        <label for=""></label>
                        <input type="submit" name="submit" value="Sign In" class="btn btn-warning w-100">
                    </div>
                    {{-- <p class="mb-1 text-center small">or login with</p>
                    <div class="mb-1">
                        <a href="javascript:;" class="btn btn-primary btn-sm w-100">Facebook</a>
                    </div>
                    <div class="mb-1">
                        <a href="javascript:;" class="btn btn-danger btn-sm w-100">Google</a>
                    </div> --}}
                </div>

        </form>
    </div>
@endsection
