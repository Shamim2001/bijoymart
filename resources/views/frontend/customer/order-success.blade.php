@extends('frontend.components.layout')

@section('title')
    Order Success
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
                    <li class="breadcrumb-item active" aria-current="page">Order Success</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="message-box">
                        <div class="success-container text-center">
                            <div>
                                <i style="font-size: 75px;color: #00df00;" class="fas fa-check-circle"></i>
                            </div>
                            <h1 class="monserrat-font text-secondary">Thank you for your order</h1>

                            <div class="confirm-green-box p-3">
                                <h5>ORDER CONFIRMATION</h5>
                                <p>Your order <span class="text-success">#{{ $orderNo }}</span> has been successful!</p>
                                <p>Thank you for choosing Bijoy Mart. You will shortly receive a Phone call from Bijoy Mart.</p>
                            </div>

                            <br>
                            <a href="/" class="btn btn-secondary">Back to shop</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-6"></div><!-- margin -->
        </div>
    </main><!-- End .main -->
@endsection
