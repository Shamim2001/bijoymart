<a href="" class="dropdown-toggle dropdown-arrow" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
    <i class="icon-shopping-cart"></i>
    <span class="cart-count badge-circle">{{ \Cart::content()->count() }}</span>
</a>
<div class="dropdown-menu">

    <div class="dropdownmenu-wrapper">
        <div class="dropdown-cart-header">
            <span>{{ \Cart::content()->count() }} Items</span>

            <a href="{{ route('cart.show') }}" class="float-right">View Cart</a>
        </div><!-- End .dropdown-cart-header -->

        <div class="dropdown-cart-products" style="max-height: 200px; overflow: scroll">

            @foreach (\Cart::content()->toArray() as $cartitem)
                <div class="product">
                    <div class="product-details">
                        <h4 class="product-title">
                            <a href="{{ route('product', $cartitem['options']['slug']) }}">{{ $cartitem['name'] }}</a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{ $cartitem['qty'] }}</span>
                            x {{ $cartitem['price'] }}
                        </span>
                    </div><!-- End .product-details -->

                    <figure class="product-image-container">
                        <a href="{{ route('product', $cartitem['options']['slug']) }}" class="product-image">
                            <img src="{{ singlePhoto(json_decode($cartitem['options']['thumbnail'])) }}" alt="product" style="height: 60px; object-fit: cover">
                        </a>
                        <a href="{{ route('cart.remove', $cartitem['id']) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                    </figure>
                </div><!-- End .product -->
            @endforeach
        </div><!-- End .cart-product -->

        <div class="dropdown-cart-total">
            <span>Total</span>

            <span class="cart-total-price float-right">&#2547;
                {{ Cart::subtotal() }}</span>
        </div><!-- End .dropdown-cart-total -->

        {{-- <div class="dropdown-cart-action"> --}}
        {{-- <a href="{{ route('customer.checkout') }}" class="btn btn-dark btn-block">Checkout</a> --}}
        <div class="d-grid">
            <a href="{{ route('customer.checkout') }}" class="btn btn-dark py-4">Checkout</a>
        </div><!-- End .dropdown-cart-total -->
        {{-- </div><!-- End .dropdown-cart-total --> --}}
    </div><!-- End .dropdownmenu-wrapper -->
</div><!-- End .dropdown-menu -->
