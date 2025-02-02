@extends('frontend.components.layout')

@section('title')
    Product
@endsection
@push('css')
    <style>
        .form-check-input:checked[type=radio] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        }
    </style>
@endpush

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')

    <main class = "main">
        <div class = "container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class = "breadcrumb">
                    <li class = "breadcrumb-item"><a href = "{{ route('index') }}"><i class = "icon-home"></i></a></li>
                    <li class = "breadcrumb-item"><a href = "#">Product</a></li>
                    <li class = "breadcrumb-item"><a href = "#">odit-doloribus</a></li>
                </ol>
            </nav>

            {{-- {{ Breadcrumbs::render('product', $product) }} --}}


            <div class = "product-single-container product-single-default">
                <div class = "row">
                    <div class = "col-md-5 product-single-gallery">
                        <div class = "product-slider-container">
                            <div class = "product-single-carousel owl-carousel owl-theme">
                                @foreach ($images as $item)
                                    <div class = "product-item" style = "border: 1px solid #ddd;">
                                        <img class = "product-single-image" src = "{{ singlePhoto([$item]) }}" data-zoom-image = "{{ singlePhoto([$item]) }}" />
                                    </div>
                                @endforeach

                            </div>
                            <!-- End .product-single-carousel -->
                            <span class = "prod-full-screen">
                                <i class = "icon-plus"></i>
                            </span>
                        </div>
                        <div class = "prod-thumbnail owl-dots" id = 'carousel-custom-dots'>
                            @foreach ($images as $item)
                                <div class = "owl-dot">
                                    <img src = "{{ singlePhoto([$item]) }}" style = "max-width: 120px" />
                                </div>
                            @endforeach
                        </div>
                    </div><!-- End .product-single-gallery -->

                    <div class = "col-md-7 product-single-details pl-5">
                        <h4 class = "product-title" style = "font-weight: 500; font-size: 22px;">{{ $product->name }}</h4>

                        <div class = "ratings-container">
                            <div class = "product-ratings">
                                <span class = "ratings" style = "width:{{ $avg_rating * 20 }}%"></span><!-- End .ratings -->
                            </div><!-- End .product-ratings -->
                            <a href = "#" class = "rating-link">( {{ $reviews->count() }} Reviews )</a>
                        </div><!-- End .ratings-container -->

                        <hr class = "short-divider">

                        <div class = "price-box">
                            {{-- @if ($product->discount_price > 0)
                                @if ($product->discount_from <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $product->discount_to)
                                    <span style = "font-size: 22px" class = "old-price">&#2547; {{ $product->selling_price }}</span>
                                    <span style = "font-size: 22px" class = "product-price">&#2547; @if ($product->discount_type == 'flat')
                                            {{ number_format($product->selling_price - $product->discount_price, 2) }}
                                        @else
                                            {{ number_format($product->selling_price - ($product->discount_price * $product->selling_price) / 100, 2) }} <span class="text-danger" style="font-size: 13px">(- {{ $product->discount_price }}%)</span>
                                        @endif
                                    </span>
                                @else
                                    <span style = "font-size: 22px" class = "">&#2547; {{ $product->selling_price }}</span>
                                @endif
                            @else
                            @endif --}}




                            {{-- @if (productPrice($product->id) < $product->selling_price)
                                <span style = "font-size: 22px" class = "old-price">&#2547; {{ $product->selling_price }}</span>
                            @endif --}}

                            @if ($product->main_price < $product->selling_price)
                                <span style = "font-size: 22px" class = "old-price">&#2547; {{ $product->selling_price }}</span>
                            @endif
                            {{-- <span style = "font-size: 22px" class = "">&#2547; {{ number_format(productPrice($product->id), 2) }}</span> --}}
                            <span style = "font-size: 22px" class = "">&#2547; {{ number_format($product->main_price) }}</span>






                            {{-- new --}}


                        </div><!-- End .price-box -->

                        <div class="product-desc">
                            <p class="small lh-sm">{!! $product->description !!}</p>
                        </div><!-- End .product-desc -->

                        @if ($product->sku_code)
                            <div class="product-sku">
                                <p class="small lh-sm">SKU: {{ $product->sku_code }}</p>
                            </div><!-- End .product-desc -->
                        @endif
                        @if (count(json_decode($product->size)))
                            <div class = "product-filters-container">
                                <div class = "product-single-filter mb-2 d-flex">
                                    <label>Sizes : <strong id="size-name" style="display: none"></strong></label>
                                    <ul class="config-size-list">
                                        @foreach (json_decode($product->size) as $key => $value)
                                            {{-- <li class="size-item" data-value="{{ $value }}"><a href="javascript:">{{ $value }}</a></li> --}}
                                            {{-- <div class="form-check form-check-inline">
                                                <input style="height: 14px;width: 14px;border-radius:50%" class="form-check-input me-1" type="checkbox" id="{{ $value }}" name="size" value="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">{{ $value }}</label>
                                            </div> --}}
                                            <div class="form-check form-check-inline">
                                                <input style="height: 14px;width: 14px;border-radius:50%" class="form-check-input me-1" type="radio" id="{{ $value }}" name="size" value="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div><!-- End .product-single-filter -->
                            </div><!-- End .product-filters-container -->
                        @endif
                        @if (count(json_decode($product->color)) > 0)
                            <div class = "product-filters-container">
                                <div class = "product-single-filter mb-2 d-flex">
                                    <label>Color : </label>
                                    <ul class="config-size-list">
                                        @foreach (json_decode($product->color) as $key => $value)
                                            <div class="form-check form-check-inline" style="position: relative">
                                                <input style="height: 24px;width: 24px;border-radius: 50%;position: absolute;" class="form-check-input color me-1" type="radio" id="{{ $value }}" name="color" value="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">
                                                    <div style="height: 25px;width: 25px;background-color:{{ colorCode($value) }}"></div>
                                                </label>
                                            </div>
                                            {{-- <div class="form-check form-check-inline" style="position: relative">
                                                <input style="height: 24px;width: 24px;border-radius: 50%;position: absolute;" class="form-check-input color me-1" type="checkbox" id="{{ $value }}" name="color" value="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">
                                                    <div style="height:25px;width:25px;background-color:{{ colorCode($value) }}"></div>
                                                </label>
                                            </div> --}}
                                            {{-- <li class="color-item" data-value="{{ $value }}"><a href="javascript:" style="background-color: {{ colorCode($value) }}"></a></li> --}}
                                        @endforeach

                                    </ul>
                                </div><!-- End .product-single-filter -->
                            </div><!-- End .product-filters-container -->
                        @endif
                        <div>
                            <small class="fw-normal">AVAILABLE : </small>
                            @if ($product->quantity - $product->sell_quantity > 0)
                                <span class="text-success">inStock</span>
                            @else
                                <span class="text-danger">Stock out</span>
                            @endif
                        </div>

                        <hr class = "divider">

                        <div class = "product-action d-flex" style = "height: 47px;">
                            {{-- <div class="product-single-qty">
                                <input id="quantity" class="horizontal-quantity form-control" name="quantity" type="text" value = "1">
                            </div><!-- End .product-single-qty --> --}}


                            <div class = "d-flex me-3">
                                <button id = "qtyminus" style = "background: transparent;border: 1px solid #eee;cursor: pointer;" type = "submit">
                                    <i style = "padding: 10px 5px" class = "fa fa-minus" aria-hidden = "true"></i>
                                </button>

                                <input style = "font-size: 18px;text-align: center; height: 47px; width:66px" id = "quantity" class = "form-control" name = "quantity" type = "text" value = "1" max = "50" min = "1">

                                <button id = "qtyplus" style = "background: transparent;border: 1px solid #eee;cursor: pointer;" type = "submit">
                                    <i style = "padding: 10px 5px" class = "fa fa-plus" aria-hidden = "true"></i>
                                </button>

                            </div><!-- End .product-single-qty -->
                            <input type = "hidden" id = "id" name = "id" value = "{{ $product->id }}">

                            <a href="javascript:" id="add-to-cart" class="btn btn-dark add-cart icon-shopping-cart" title="Add to Cart">Add to Cart</a>
                        </div><!-- End .product-action -->
                        <div>
                            <a href="javascript:" id="order-now" class="btn btn-danger order-now" title="Order Now" style="width: 300px;padding: 14px;margin-top: 15px;">Order Now</a>
                        </div>

                        <hr class = "divider mb-1">

                        <div class = "product-single-share d-none">
                            <label class = "sr-only">Share:</label>

                            <div class = "social-icons mr-2">
                                <a href  = "#" class = "social-icon social-facebook icon-facebook" target      = "_blank" title = "Facebook"></a>
                                <a href  = "#" class = "social-icon social-twitter icon-twitter" target        = "_blank" title = "Twitter"></a>
                                <a href  = "#" class = "social-icon social-linkedin fab fa-linkedin-in" target = "_blank" title = "Linkedin"></a>
                                <a href  = "#" class = "social-icon social-gplus fab fa-google-plus-g" target  = "_blank" title = "Google +"></a>
                                <a href  = "#" class = "social-icon social-mail icon-mail-alt" target          = "_blank" title = "Mail"></a>
                            </div><!-- End .social-icons -->


                        </div><!-- End .product single-share -->
                        <a href = "" class = "add-wishlist" title = "Add to Wishlist" data-id = "{{ $product->id }}">Add to
                            Wishlist</a>
                    </div><!-- End .product-single-details -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            <div class = "product-single-tabs">
                <ul class = "nav nav-tabs" role  = "tablist">
                    <li class = "nav-item">
                        <a class = "nav-link active" id = "product-tab-desc" data-bs-toggle = "tab" href = "#product-desc-content" role  = "tab" aria-controls  = "product-desc-content" aria-selected = "true">Description</a>
                    </li>
                    {{-- <li class = "nav-item">
                        <a class = "nav-link" id = "product-tab-more-info" data-bs-toggle = "tab" href = "#product-more-info-content" role  = "tab" aria-controls = "product-more-info-content" aria-selected = "false">More Info</a>
                    </li> --}}
                    <li class = "nav-item">
                        <a class = "nav-link" id = "product-tab-reviews" data-bs-toggle = "tab" href = "#product-reviews-content" role  = "tab" aria-controls = "product-reviews-content" aria-selected = "false">Reviews
                            ({{ $reviews->count() }})</a>
                    </li>
                </ul>
                <div class = "tab-content">
                    <div class = "tab-pane fade show active" id = "product-desc-content" role = "tabpanel" aria-labelledby = "product-tab-desc">
                        <div class = "product-desc-content">
                            {!! $product->description !!}
                        </div><!-- End .product-desc-content -->
                    </div><!-- End .tab-pane -->

                    <div class = "tab-pane fade fade" id = "product-more-info-content" role = "tabpanel" aria-labelledby = "product-tab-more-info">
                        <div class = "product-desc-content">
                            <p>{!! $product->description !!}</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- End .tab-pane -->



                    <div class = "tab-pane fade" id = "product-reviews-content" role = "tabpanel" aria-labelledby = "product-tab-reviews">
                        <div class = "product-reviews-content">
                            <div class = "row">
                                <div class = "col-xl-7">
                                    <h2 class = "reviews-title">{{ $reviews->count() }} reviews for Product Long Name</h2>

                                    <ol class = "comment-list" id = "reload_review">
                                        @foreach ($reviews as $review)
                                            <li class = "comment-container">
                                                <div class = "comment-avatar">
                                                    <img src   = "{{ asset('product_photo/' . 'default_avator.png') }}" width = "65" height = "65" alt = "avatar" />
                                                </div><!-- End .comment-avatar-->

                                                <div class = "comment-box">
                                                    <div class = "ratings-container">
                                                        <div class = "product-ratings">
                                                            <span class = "ratings" style = "width:{{ $review->rating * 20 }}%"></span>
                                                            <!-- End .ratings -->
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .ratings-container -->

                                                    <div class = "comment-info mb-1">
                                                        <h4 class = "avatar-name">{{ $review->customer->name }}</h4> -
                                                        <span class = "comment-date">{{ date('F d, Y', strtotime($review->created_at)) }}</span>
                                                    </div><!-- End .comment-info -->

                                                    <div class = "comment-text">
                                                        <p>{{ $review->product_review }}</p>
                                                    </div><!-- End .comment-text -->
                                                </div><!-- End .comment-box -->
                                            </li><!-- comment-container -->
                                        @endforeach
                                    </ol><!-- End .comment-list -->
                                </div>

                                @if ($product_check)
                                    @if (session('customer_id') && $product_check->status == 'success')
                                        <div class  = "col-xl-5">
                                            <div class  = "add-product-review">
                                                <form action = "{{ route('productreview') }}" method = "POST" id     = "form-reviews">
                                                    @csrf
                                                    <h3 class = "review-title">Add a Review</h3>

                                                    <div class = "rating-form">
                                                        <label for   = "rating">Your rating *</label>
                                                        <span class = "rating-stars">
                                                            <a class = "star-1" href = "#">1</a>
                                                            <a class = "star-2" href = "#">2</a>
                                                            <a class = "star-3" href = "#">3</a>
                                                            <a class = "star-4" href = "#">4</a>
                                                            <a class = "star-5" href = "#">5</a>
                                                        </span>

                                                        <select name  = "rating" id = "rating" required = "" style = "display: none;">
                                                            <option value = "">Rate…</option>
                                                            <option value = "5">Perfect</option>
                                                            <option value = "4">Good</option>
                                                            <option value = "3">Average</option>
                                                            <option value = "2">Not that bad</option>
                                                            <option value = "1">Very poor</option>
                                                        </select>
                                                    </div>
                                                    <input type  = "hidden" name = "id" id = "p_id" value = "{{ $product->id }}">
                                                    <div class = "form-group">
                                                        <label>Your Review *</label>
                                                        <textarea cols  = "5" rows = "4" name = "message" class = "form-control form-control-sm" required></textarea>
                                                    </div><!-- End .form-group -->


                                                    <div class = "row">
                                                        <div class = "col-md-6 col-xl-12">
                                                            <div class = "form-group">
                                                                <label>Your Name: {{ session('customer_name') }}</label>
                                                            </div><!-- End .form-group -->
                                                        </div>
                                                    </div>

                                                    <input type = "submit" class = "btn btn-dark ls-n-15 mt-2" value = "submit">

                                                </form>
                                            </div><!-- End .add-product-review -->
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div><!-- End .product-reviews-content -->
                    </div><!-- End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-single-tabs -->

            <section class="py-3">
                <div class="auto-container">
                    <div class="container my-5">
                        <h4 class="fw-bold m-0">Related Products</h4>
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($relproducts as $rproduct)
                                    <div class="swiper-slide">
                                        <div class="card col d-flex flex-column align-items-center product-item my-3">
                                            <a href="{{ route('product', $rproduct->slug) }}">
                                                <div class="product"> <img src="{{ singlePhoto(json_decode($rproduct->thumbnail)) }}" alt="{{ $rproduct->slug }}">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        {{-- <a href="{{ route('product', $rproduct->slug) }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a> --}}
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="{{ route('product', $rproduct->slug) }}">
                                                            <li class="icon"><span class="fas fa-eye"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">{{ $rproduct->name }}</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price">
                                                    <span><del class="price">&#2547; {{ number_format($rproduct->selling_price) }}</del></span>
                                                    @php
                                                        $mainPrice = $rproduct->selling_price - $rproduct->discount_price;
                                                        $persentance = $rproduct->discount_price * $rproduct->selling_price;
                                                        $price = $persentance / 100;
                                                    @endphp
                                                    {{-- <p>Main Price: {{ $rproduct->discount_type === 'flat' ? $mainPrice : $price  }}</p> --}}
                                                    <span class="text-success">{{ $mainPrice }}</span>



                                                    {{-- @if($rproduct->discount_type === 'flat')
                                                        @php
                                                            $mainPrice = $rproduct->selling_price - $rproduct->discount_price;
                                                        @endphp
                                                        <p>Main Price: {{ $mainPrice }}</p>
                                                    @else
                                                        <p>Main Price: {{ $rproduct->selling_price }}</p>
                                                    @endif --}}


                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                            <!-- Add Navigation -->
                            {{-- <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div> --}}
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- End .container -->
    </main><!-- End .main -->
@endsection
@push('js')
    <script>
        var swiper = new Swiper(".mySwiper", {
            autoplay: false, // Disabling autoplay
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            // autoplay: {
            //     delay: 3000, // 3 seconds delay between slides
            //     disableOnInteraction: false, // Keeps autoplay active even when user interacts
            // },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                540: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                900: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                1100: {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
                1200: {
                    slidesPerView: 6,
                    spaceBetween: 10,
                },
            },
        });
    </script>
@endpush
