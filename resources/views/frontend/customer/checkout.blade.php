@extends('frontend.components.layout')

@section('title')
    Checkout
@endsection
@push('css')
    <style>
        textarea.form-control {
            max-width: 100%;
            min-height: 112px;
        }

        input[type=text],
        textarea.form-control {
            font-size: 14px;
        }
    </style>
@endpush


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
                <li class="active">
                    <span>cart</span>
                </li>
                <li class="active">
                    <span>Shipping</span>
                </li>
                <li>
                    <span>Thank You</span>
                </li>
            </ul>

            <form action="{{ route('checkout.orderStore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Shipping Address</h2>
                            </li>
                        </ul>

                        <div class="row justify-content-center text-center">
                            @if (session('message'))
                                <div class="col-md-12 alert alert-danger }}">{{ session('message') }}</div>
                            @endif
                        </div>

                        <div class="row mb-5">

                            @if ($customer)
                                <div class="col-md-12">
                                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input type="text" readonly
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            id="name" placeholder="Your Name" value="{{ $customer->name }}" required
                                            style="height: 44px">
                                        @error('name')
                                            <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone Number *</label>
                                        <input type="text" readonly
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            id="phone" placeholder="11 Digit Number" value="{{ $customer->phone }}"
                                            required style="height: 44px">
                                        @error('phone')
                                            <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Your Name"
                                            value="{{ old('name') }}" required style="height: 44px">
                                        @error('name')
                                            <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone Number *</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" id="phone" placeholder="11 Digit Number"
                                            value="{{ old('phone') }}" required style="height: 44px">
                                        @error('phone')
                                            <div class="text-danger" style="font-size: 12px">
                                                {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address * (You can another number here) </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" cols="30" rows="4"
                                        placeholder="Adderess" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-danger" style="font-size: 12px">
                                            {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <h2 class="step-title">Payment Methods</h2>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_type" value="cash"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <h6>Cash On Delivery</h6>
                                    </label>
                                </div>
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_type" value="bKash" id="flexRadioDefault1" style="margin-top: 16px">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <img src="{{ asset('frontend/assets/images/bkash.png') }}" alt="" style="height: 40px">
                                    </label>
                                </div> --}}
                            </div>
                        </div>
                    </div><!-- End .col-lg-8 -->

                    <div class="col-lg-6">
                        <div class="order-summary">
                            <h3>Summary</h3>
                            <h4>
                                <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button"
                                    aria-expanded="false"
                                    aria-controls="order-cart-section">{{ \Cart::content()->count() }}
                                    products in Cart</a>
                            </h4>
                            <div class="collapse show" id="order-cart-section"
                                style="max-height: 500px; overflow: scroll">
                                <table class="table table-mini-cart">
                                    <tbody>
                                        @foreach (\Cart::content() as $item)
                                            <tr>
                                                <td class="product-col" style="width: 75px;">
                                                    <figure class="product-image-container">
                                                        <a href="{{ route('product', $item->options->slug) }}"
                                                            class="product-image">
                                                            <img src="{{ singlePhoto(json_decode($item->options->thumbnail)) }}"
                                                                alt="product">
                                                        </a>
                                                    </figure>
                                                </td>
                                                <td>
                                                    <p class="product-title cartItem"
                                                        style="font-size: 12px; text-align:start">
                                                        <a
                                                            href="{{ route('product', $item->options->slug) }}">{{ $item->name }}</a>
                                                    </p>
                                                    <span class="product-qty" style="font-size: 12px;">Price:
                                                        {{ $item->price }}</span>
                                                    <span class="product-qty" style="font-size: 12px;">Size:
                                                        {{ $item->options->size }}</span>
                                                    <span class="product-qty d-flex" style="font-size: 12px;">Color: <div
                                                            class="ms-2"
                                                            style="height: 15px;width: 15px;background-color:{{ $item->options->color == '' ? '' : colorCode($item->options->color) }}">
                                                        </div></span>
                                                </td>
                                                <td>
                                                    <div class = "d-flex me-3">
                                                        {{-- <button id="qtyminus" style="background: #fff8f800;border: 1px solid #e7e7e7;cursor: pointer;height: 27px;" type="submit">
                                                            <i style="padding:6px 5px" class = "fa fa-minus" aria-hidden = "true"></i>
                                                        </button> --}}

                                                        <input type="number"
                                                            style="font-size:14px;text-align:center;height:35px;width:70px;margin-bottom: 0px;padding:0px"
                                                            id="quantity"
                                                            oninput="updateCart(this.value, '{{ $item->rowId }}')"
                                                            class="form-control" name="quantity"
                                                            value="{{ $item->qty }}" min="1">

                                                        {{-- <button id="qtyplus" style="background: #fff8f800;border: 1px solid #e7e7e7;cursor: pointer;height: 27px;" type="submit">
                                                            <i style="padding: 6px 5px" class="fa fa-plus" aria-hidden="true"></i>
                                                        </button> --}}

                                                    </div><!-- End .product-single-qty -->
                                                </td>
                                                <td class="price-col" style="font-size: 12px;">&#2547; <span
                                                        id="{{ $item->rowId }}">{{ $item->price * $item->qty }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('cart.remove', $item->rowId) }}"
                                                        style="font-size: 12px;padding:5px;color:red;font-weight:bold">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- End #order-cart-section -->
                            <h4 class="font-weight-normal" style="font-size: 13px">
                                <div class="d-flex justify-content-between py-3">
                                    <span>Sub Total</span>
                                    <span id="subtotal"> &#2547;{{ Cart::subtotal() }}</span>
                                    {{-- <span id="subtotal"> &#2547;{{ Cart::subtotal() }}</span> --}}
                                </div>
                                <div class="d-flex justify-content-between py-3">
                                    <span>Delivery Charge</span>
                                    <span id="dCharge">&#2547; {{ $setting->d_charge_inside_dhaka }}</span>
                                    {{-- <p>&#2547; <span id="dCharge">{{ $setting->d_charge_inside_dhaka }}</span></p> --}}
                                </div>
                                <div class="">
                                    <input class="form-check-input" type="radio" name="delivery_charge" value="inside"
                                        id="inside" checked onchange="updateDeliveryCharge();">
                                    <label class="form-check-label" for="inside"
                                        style="font-weight: normal;margin-right:15px">Inside Dhaka</label>
                                    <input class="form-check-input" type="radio" name="delivery_charge"
                                        value="outside" id="outside" onchange="updateDeliveryCharge();">
                                    <label class="form-check-label" for="outside" style="font-weight: normal">Outside
                                        Dhaka</label>
                                </div>

                            </h4>
                            <h4>
                                <div class="d-flex justify-content-between pt-3 h4">
                                    <span>Order Total</span>

                                    <span id="subtotalsum">&#2547;
                                        {{ number_format((float) str_replace(',', '', Cart::subtotal()) + 100.0, 2) }}</span>
                                    {{-- <p>&#2547; <span id="subtotalsum"> {{ number_format((float) str_replace(',', '', Cart::subtotal()) + 100.00, 2) }}</span></p> --}}
                                </div>
                            </h4>

                        </div><!-- End .order-summary -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-6 offset-lg-3 mt-4 text-center">
                        <p class="small">অর্ডারটি কনফার্ম করতে ফর্মটি সম্পুর্ণ পুরণ করে নিচের Place Order বাটনে ক্লিক
                            করুন।</p>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </div>
                    </div>
                </div><!-- End .row -->
            </form>


        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@push('js')
    <script>
        function updateCart(qty, rowId) {
            $.ajax({
                url: '{{ route('cart.update') }}', // Define this route in your routes file
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    qty: qty,
                    rowId: rowId
                },
                success: function(response) {
                    if (response.status == true) {
                        $("#" + rowId).html(response.total)

                        $("#subtotal").html('&#2547; ' + response.subtotal)
                        $("#subtotalsum").html('&#2547; ' + response.subtotalsum)
                        // $("#subtotal").html( + response.subtotal)
                        // $("#subtotalsum").html( + response.subtotalsum)

                        // alert('Cart updated successfully!');
                        location.reload(); // Reload the page to reflect changes
                    }
                },
                error: function() {
                    alert('Something went wrong, please try again.');
                }
            });
        }
    </script>
    <script>
        // function updateDeliveryCharge() {
        //     const sumTotal = {{ Cart::subtotal() }};
        //     // const insideCharge = {{ $setting->d_charge_inside_dhaka }};
        //     const insideCharge = 100;
        //     // const outsideCharge = {{ $setting->d_charge_outside_dhaka }};
        //     const outsideCharge = 150;
        //     const displayCharge = document.getElementById('dCharge');
        //     const deliveryChargeInput = document.getElementById('delivery_charge_value');
        //     console.log('hello') ;
        //     // Check which radio button is selected
        //     if (document.getElementById('inside').checked) {
        //         displayCharge.textContent = parseFloat(insideCharge).toFixed(2)
        //         console.log('hello') ;
        //         document.getElementById('subtotalsum').textContent = parseFloat(+sumTotal + +insideCharge).toFixed(2)
        //     } else if (document.getElementById('outside').checked) {
        //         displayCharge.textContent = parseFloat(outsideCharge).toFixed(2)
        //         document.getElementById('subtotalsum').textContent = parseFloat(+sumTotal + +outsideCharge).toFixed(2)
        //     }

        // }
    </script>
    <script>
        // new
        function updateDeliveryCharge() {
            // const sumTotal = {{ Cart::subtotal() }};
            const sumTotal1 = document.getElementById('subtotalsum').textContent;
            const parsePrice = sumTotal1.replace(/[^\d.-]/g, '');
            // const sumTotal = parseFloat(parsePrice);
            const sumTotal = {{ $item->price * $item->qty }};
            const insideCharge = {{ $setting->d_charge_inside_dhaka }};
            // const insideCharge = 100;
            const outsideCharge = {{ $setting->d_charge_outside_dhaka }};
            // const outsideCharge = 150;
            const displayCharge = document.getElementById('dCharge');
            const deliveryChargeInput = document.getElementById('delivery_charge_value');
            // console.log('hello') ;
            // Check which radio button is selected
            if (document.getElementById('inside').checked) {
                displayCharge.textContent = parseFloat(insideCharge).toFixed(2)
                console.log(sumTotal);
                document.getElementById('subtotalsum').textContent = parseFloat(+sumTotal + +insideCharge).toFixed(2)
            } else if (document.getElementById('outside').checked) {
                displayCharge.textContent = parseFloat(outsideCharge).toFixed(2)
                document.getElementById('subtotalsum').textContent = parseFloat(+sumTotal + +outsideCharge).toFixed(2)
            }

        }
    </script>

    {{-- <script>
        function updateDeliveryCharge1() {
            const subtotalWithCharge = document.getElementById('subtotalsum').textContent;
            console.log("Subtotal with Charge:", subtotalWithCharge);
        }
    </script>
    <script>
        function updateDeliveryCharge2() {
            const subtotalWithCharge = document.getElementById('subtotalsum').textContent;
            const parsePrice = subtotalWithCharge.replace(/[^\d.-]/g, '');
            const subtotalAsNumber = parseFloat(parsePrice);
            const update = subtotalAsNumber + 50;
            console.log(update);
        }
    </script> --}}
@endpush
