<div class="product-single-container product-single-default product-quick-view">
    <div class="row row-sparse">
        <div class="col-lg-6 product-single-gallery">
            <div class="product-slider-container">
                <div class="product-single-carousel owl-carousel owl-theme">
                    @foreach ($images as $prod)
                    <div class="product-item">
                        <img class="product-single-image" src="{{ asset('product_photo/'. $prod) }}" data-zoom-image="{{ asset('product_photo/'. $prod) }}"/>
                    </div>
                    @endforeach
                </div>
                <!-- End .product-single-carousel -->
            </div>
            <div class="prod-thumbnail owl-dots" id='carousel-custom-dots'>
                @foreach ($images as $prod)
                <div class="owl-dot">
                    <img src="{{ asset('product_photo/'. $prod) }}" />
                </div>
                @endforeach

            </div>
        </div><!-- End .product-single-gallery -->

        <div class="col-lg-6 product-single-details">
            <h1 class="product-title">{{ $product->name }}</h1>

            <div class="ratings-container">
                <div class="product-ratings">
                    <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                </div><!-- End .product-ratings -->

                <a href="#" class="rating-link">( 6 Reviews )</a>
            </div><!-- End .product-container -->

            <div class="price-box">
                @if($product->special_price_from != "")
                    @if ($product->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $product->special_price_to)
                    <span class = "old-price">BDT {{ $product->selling_price }}</span>
                    <span class = "product-price">BDT {{ $product->special_price }}</span>
                    @else
                    <span class = "">BDT {{ $product->selling_price }}</span>
                    @endif
                @endif
            </div><!-- End .price-box -->

            <div class="product-desc">
                {!! $product->description !!}
            </div><!-- End .product-desc -->

            <div class="product-filters-container">
                <div class="product-single-filter">
                    <label>Colors:</label>
                    <ul class="config-swatch-list">
                        @foreach (json_decode($product->color) as $key => $value)
                        <li class="active">
                            <a href="#" style="background-color: #{{ colorCode($value) }};"></a>
                        </li>
                        @endforeach
                    </ul>
                </div><!-- End .product-single-filter -->
            </div><!-- End .product-filters-container -->

            <hr class="divider">

            <div class="product-action">
                <div class="product-single-qty">
                    <input class="horizontal-quantity form-control" type="text">
                </div><!-- End .product-single-qty -->

                <a href="https://www.portotheme.com/html/porto_ecommerce/demo_6/ajax/cart.html" class="btn btn-dark add-cart" title="Add to Cart">Add to Cart</a>
            </div><!-- End .product-action -->

            <hr class="divider">

            <div class="product-single-share">
                <label class="sr-only">Share:</label>

                <!-- www.addthis.com share plugin-->
                <div class="addthis_inline_share_toolbox"></div>

                <a href="#" class="add-wishlist" title="Add to Wishlist">Add to Wishlist</a>
            </div><!-- End .product single-share -->
        </div><!-- End .product-single-details -->
    </div><!-- End .row -->
</div><!-- End .product-single-container -->

<script src="{{ asset('frontend/assets/js/main.min.js') }}"></script>
