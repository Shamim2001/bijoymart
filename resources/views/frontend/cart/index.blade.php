@extends('frontend.components.layout')

@section('title')
    Cart Show
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
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    @if (Session::has('message'))
                        <div class="alert alert-danger text-center">{{ Session::get('message') }}</div>
                    @endif

                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cart_items as $item)

                                    <tr class="product-row">
                                        <td class="product-col">
                                            <figure class="product-image-container">
                                                <a href="{{ route('product', $item->attributes->slug) }}"
                                                    class="product-image">
                                                    <img src="{{ asset('product_photo/' . $item->attributes->thumbnail) }}"
                                                        alt="product" style="height: 120px">
                                                </a>
                                            </figure>
                                            <h5 class="product-title">
                                                <a
                                                    href="{{ route('product', $item->attributes->slug) }}">{{ $item->name }}</a>
                                                <p
                                                    style="margin-bottom: -40px; padding-top: 20px; font-size: 12px; font-weight: 400;">
                                                    <span class="mr-5"> Size:
                                                        {{ $item->attributes->size ? $item->attributes->size : '' }}</span>
                                                    <span>
                                                        Color:
                                                        {{ $item->attributes->color ? $item->attributes->color : '' }}</span>
                                                </p>
                                            </h5>

                                        </td>
                                        <td>&#2547; {{ $item->price }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->id) }}" method="post"
                                                id="item-{{ $item->id }}" class="my-auto">
                                                @csrf
                                                <input class="vertical-quantity form-control" type="text"
                                                    value="{{ $item->quantity }}" name="quantity">
                                            </form>
                                        </td>
                                        <td>&#2547; {{ $item->quantity * $item->price }}</td>
                                    </tr>
                                    <tr class="product-action-row">
                                        <td colspan="4" class="clearfix pb-0">
                                            <div class="float-left">
                                                <a href="#" class="btn-move">Move to Wishlist</a>
                                            </div><!-- End .float-left -->

                                            <div class="float-right d-flex">
                                                {{-- <a href="#" title="Edit product" class="btn-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a> --}}
                                                {{-- <a href="#" title="Remove product" class="btn-remove"><span class="sr-only">Remove</span></a> --}}
                                                {{-- <a href="{{ route('cart.remove', $item->id) }}">Remove Item</a> --}}
                                                <div style="height: 40px; margin-bottom: 10px">
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm py-2 m-2"
                                                        onclick="document.querySelector('#item-{{ $item->id }}').submit()">Update</button>
                                                </div>
                                                <div style="height: 40px; margin-bottom: 10px">
                                                    {{-- <form action="{{ route('cart.remove', $item->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary btn-sm py-2 m-2">Remove</button>
                                            </form> --}}
                                                    <a href="{{ route('cart.remove', $item->id) }}"
                                                        class="btn btn-outline-secondary btn-sm py-2 m-2">Remove</a>
                                                </div>
                                            </div><!-- End .float-right -->
                                        </td>
                                    </tr>


                                @endforeach
                                {{-- <tr class="product-row">
                                <td class="product-col">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/product-3.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <h2 class="product-title">
                                        <a href="product.html">Computer Mouse</a>
                                    </h2>
                                </td>
                                <td>$8.90</td>
                                <td>
                                    <input class="vertical-quantity form-control" type="text">
                                </td>
                                <td>$8.90</td>
                            </tr>
                            <tr class="product-action-row">
                                <td colspan="4" class="clearfix">
                                    <div class="float-left">
                                        <a href="#" class="btn-move">Move to Wishlist</a>
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="#" title="Edit product" class="btn-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                                        <a href="#" title="Remove product" class="btn-remove"><span class="sr-only">Remove</span></a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr> --}}

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4" class="clearfix">
                                        <div class="float-left">
                                            <a href="{{ route('index') }}" class="btn btn-outline-secondary">Continue
                                                Shopping</a>
                                        </div><!-- End .float-left -->

                                        <div class="float-right">
                                            <a href="{{ route('cart.remove-all') }}"
                                                class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                            {{-- <a href="#" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a> --}}
                                        </div><!-- End .float-right -->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- End .cart-table-container -->
                    {{-- <div class="cart-discount">
                        <h4>Apply Discount Code</h4>
                        <form action="#">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"
                                    required>
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                                </div>
                            </div><!-- End .input-group -->
                        </form>
                    </div><!-- End .cart-discount --> --}}
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3 class="border-bottom pb-2 mb-4">Summary</h3>

                        {{-- <h4>
                            <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button"
                                aria-expanded="false" aria-controls="total-estimate-section">Estimate Shipping and Tax</a>
                        </h4>

                        <div class="collapse" id="total-estimate-section">
                            <form action="#">
                                <div class="form-group form-group-sm">
                                    <label>Country</label>
                                    <div class="select-custom">
                                        <select class="form-control form-control-sm">
                                            <option value="USA">United States</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="China">China</option>
                                            <option value="Germany">Germany</option>
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .form-group -->

                                <div class="form-group form-group-sm">
                                    <label>State/Province</label>
                                    <div class="select-custom">
                                        <select class="form-control form-control-sm">
                                            <option value="CA">California</option>
                                            <option value="TX">Texas</option>
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .form-group -->

                                <div class="form-group form-group-sm">
                                    <label>Zip/Postal Code</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div><!-- End .form-group -->

                                <div class="form-group form-group-custom-control">
                                    <label>Flat Way</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="flat-rate">
                                        <label class="custom-control-label" for="flat-rate">Fixed $5.00</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-group -->

                                <div class="form-group form-group-custom-control">
                                    <label>Best Rate</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="best-rate">
                                        <label class="custom-control-label" for="best-rate">Table Rate $15.00</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-group -->
                            </form>
                        </div><!-- End #total-estimate-section --> --}}

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>&#2547; {{ Cart::getSubTotal() }}</td>
                                </tr>

                                <tr>
                                    <td>Estimated Delivery Charge <br> <span style="font-size:12px">(Inside Dhaka
                                            City)</span>
                                    </td>
                                    <td>&#2547; 60</td>
                                </tr>
                                <tr>
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm py-1"
                                                placeholder="Enter discount code" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary py-1" type="submit">Apply</button>
                                            </div>
                                        </div><!-- End .input-group -->
                                    </form>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Order Total</td>
                                    <td>&#2547; {{ Cart::getSubTotal() + 60 }}</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="{{ route('customer.checkout') }}" class="btn btn-block btn-sm btn-primary">Go to
                                Checkout</a>
                            <a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a>
                        </div><!-- End .checkout-methods -->
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->


@endsection
