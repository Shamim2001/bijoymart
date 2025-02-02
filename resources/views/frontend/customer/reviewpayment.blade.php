@extends('frontend.components.layout')

@section('title')
    Review and Payment
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
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <ul class="checkout-progress-bar">
                <li>
                    <span>Shipping</span>
                </li>
                <li class="active">
                    <span>Review &amp; Payments</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-8">


                    <div class="col-lg-12">
                        <div class="checkout-info-box">
                            <h3 class="step-title">Ship To:
                                <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                            </h3>

                            <address>
                                {{ $shipping->name }} <br>
                                {{ $shipping->address }}<br>
                                {{ $shipping->phone }}
                            </address>
                        </div><!-- End .checkout-info-box -->
                    </div>
                    <div style="height: 50px"></div>
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Payment Method</h2>
                        </li>
                    </ul>
                    <form action="{{ route('customer.store.review.payment') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group mb-4 pr-5">
                                <input type="radio" name="payment_type" id="cash_payment" value="cash" required>
                                <label for="cash_payment">Cash Payment</label>
                            </div><!-- End .form-group -->
                            <div class="form-group mb-4">
                                <input type="radio" name="payment_type" id="online_payment" value="online" required>
                                <label for="online_payment">Online Payment</label>
                            </div><!-- End .form-group -->
                        </div>
                        <span>
                            <div class="text-danger"> @error('payment_type')
                                    {{ $message }}
                                @enderror
                            </div>
                        </span>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout-steps-action text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">PLACE ORDER</button>
                                </div><!-- End .checkout-steps-action -->
                            </div><!-- End .col-lg-8 -->
                        </div><!-- End .row -->
                    </form>


                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3>Summary</h3>

                        <h4>
                            <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">{{ \Cart::content()->count() }}
                                products
                                in Cart</a>
                        </h4>

                        <div class="collapse show" id="order-cart-section" style="max-height: 200px; overflow: scroll">
                            <table class="table table-mini-cart">
                                <tbody>
                                    @foreach (\Cart::content() as $item)
                                        <tr>
                                            <td class="product-col">
                                                <figure class="product-image-container">
                                                    <a href="product.html" class="product-image">
                                                        <img src="{{ asset('product_photo/' . $item->attributes->thumbnail) }}" alt="product">
                                                    </a>
                                                </figure>
                                                <div>
                                                    <h2 class="product-title" style="font-size: 12px;">
                                                        <a href="product.html">{{ $item->name }}</a>
                                                    </h2>

                                                    <span class="product-qty" style="font-size: 12px;">Qty:{{ $item->quantity }}</span>
                                                </div>
                                            </td>
                                            <td class="price-col" style="font-size: 12px;">&#2547;
                                                {{ $item->price }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- End #order-cart-section -->
                        <h4 class="font-weight-normal" style="font-size: 13px">
                            <div class="d-flex justify-content-between py-3">
                                <span>Sub Total</span>
                                <span>&#2547; {{ Cart::getSubTotal() }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-3">
                                <span>Estimated Delivery Charge <br>
                                    <small>(Inside Dhaka City)</small></span>
                                <span>&#2547; 60</span>
                            </div>
                        </h4>
                        <h4>
                            <div class="d-flex justify-content-between pt-3 h4">
                                <span>Order Total</span>
                                <span>&#2547; {{ Cart::getSubTotal() + 60 }}</span>
                            </div>
                        </h4>

                    </div><!-- End .order-summary -->

                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->


        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
