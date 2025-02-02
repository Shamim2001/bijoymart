@extends('frontend.components.layout')

@section('title')
    All Products
@endsection
@push('css')
    <style>
        .add-wishlist{
            padding: 0;
        }
        .add-wishlist:before{
            content: '';
            font-size: 1.2rem;
            display: block;
        }
    </style>
@endpush

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <main class="main">
        {{-- <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('{{ asset('frontend/assets/images/banners/banner-top.jpg') }}');">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                            <h3 class="ml-lg-5 mb-2 ls-10">Electronic<br>Deals</h3>
                            <a href="#" class="ml-lg-5 btn btn-dark btn-black ls-10">Get Yours!</a>
                        </div>
                        <div class="pl-lg-5 col-md-4 offset-md-0 offset-1 pt-4">
                            <div class="coupon-sale-content">
                                <h4 class="m-b-2 coupon-sale-text bg-white ls-10 text-transform-none">Exclusive COUPON</h4>
                                <h5 class="mb-2 coupon-sale-text d-block ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-dark">$100</b> OFF</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item"><a href="#">Men</a></li>
                    <li class="breadcrumb-item active" aria-current="page">aaa</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-9 main-content">
                    <nav class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-item toolbox-sort">
                                <label>Sort By: </label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control">
                                        <option value="menu_order" selected="selected">Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by newness</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </div><!-- End .select-custom -->


                            </div><!-- End .toolbox-item -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>Show: </label>

                                <div class="select-custom">
                                    <select name="count" class="form-control">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .toolbox-item -->

                            <div class="toolbox-item layout-modes">
                                <a href="#" class="layout-btn btn-grid active" title="Grid">
                                    <i class="icon-mode-grid"></i>
                                </a>
                                <a href="#" class="layout-btn btn-list" title="List">
                                    <i class="icon-mode-list"></i>
                                </a>
                            </div><!-- End .layout-modes -->
                        </div><!-- End .toolbox-right -->
                    </nav>
                    {{-- <a href="{{ $category['0'] }}" id="cat_id"></a> --}}

                    <!-- Start Product show -->
                    <div class="showproduct">
                        <div class = "row row-cols-2 row-cols-md-3 row-cols-lg-4">
                            @forelse ($products as $product)
                                <div class="col">
                                    <div class="card px-1 d-flex flex-column align-items-center product-item my-3">
                                        <a href="{{ route('product', $product->slug) }}">
                                            <div class="product"> <img src="{{ singlePhoto(json_decode($product->thumbnail)) }}" alt="">
                                                <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                    {{-- <a href="{{ route('product', $product->slug) }}">
                                                        <li class="icon"><span class="fas fa-search"></span></li>
                                                    </a> --}}

                                                    <a href="" class="add-wishlist" data-id = "{{ $product->id }}">
                                                        <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                    </a>


                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <li class="icon"><span class="fas fa-eye"></span></li>
                                                    </a>

                                                </ul>
                                            </div>
                                            {{-- <div class="tag bg-red">sale</div> --}}
                                            <div class="card-title pt-4 pb-1">{{ $product->name }}</div>
                                            <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                            <div class="price">
                                                @if (productPrice($product->id) < $product->selling_price)
                                                    <span><del class="price">&#2547; {{ $product->selling_price }}</del></span>
                                                @endif
                                                <span class="text-success">&#2547; {{ number_format(productPrice($product->id), 2) }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            @empty
                            @endforelse

                        </div>

                    </div>
                    <!-- End product Show -->

                    <div class="mt-4 d-flex justify-content-center paginate">
                        {{-- {{ $products->links() }} --}}
                        {{ $products->links('vendor.pagination.bootstrap-5') }}
                    </div>

                    {{-- <nav>
                        <ul class="pagination">
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">«</span>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="{{ '/productByCategory?' . $queryString }}&page=2">2</a></li>
                            <li class="page-item">
                                <a class="page-link" href="{{ '/productByCategory?' . $queryString }}&page=2" rel="next">»</a>
                            </li>
                        </ul>
                    </nav> --}}

                    {{-- <nav class = "toolbox toolbox-pagination">
                        <div class = "toolbox-item toolbox-show">
                            <label>Show: </label>

                            <div class = "select-custom">
                                <select name  = "count" class = "form-control">
                                    <option value = "12">12</option>
                                    <option value = "24">24</option>
                                    <option value = "36">36</option>
                                </select>
                            </div><!-- End .select-custom -->
                        </div><!-- End .toolbox-item -->

                        <ul class = "pagination toolbox-item">
                            <li class = "page-item disabled">
                                <a class = "page-link page-link-btn" href = "#"><i class = "icon-angle-left"></i></a>
                            </li>
                            <li class = "page-item active">
                                <a class = "page-link" href = "#">1 <span class = "sr-only">(current)</span></a>
                            </li>
                            <li class = "page-item"><a class           = "page-link" href = "#">2</a></li>
                            <li class = "page-item"><a class           = "page-link" href = "#">3</a></li>
                            <li class = "page-item"><a class           = "page-link" href = "#">4</a></li>
                            <li class = "page-item"><a class           = "page-link" href = "#">5</a></li>
                            <li class = "page-item"><span class        = "page-link">...</span></li>
                            <li class = "page-item">
                                <a class = "page-link page-link-btn" href = "#"><i class     = "icon-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav> --}}
                </div><!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-bs-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="false" aria-controls="widget-body-2" class="collapsed">Categories</a>
                            </h3>

                            <div class="collapse {{ $slug2 == 'subcategory' ? 'show' : '' }}" id="widget-body-2">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @php
                                            $total = 0;
                                            foreach ($categories as $key => $cate) {
                                                $total += $cate->productCount->count();
                                            }
                                        @endphp
                                        <li><a href="{{ route('product.bycategory', $slug) }}">All Categories ({{ $total }})</a></li>
                                        @foreach ($categories as $cate)
                                            <li><a href="{{ route('product.bycategory', [$slug, 'subcategory', $cate->slug]) }}">{{ $cate->name }} ({{ $cate->productCount->count() }})</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->


                        {{-- <div class="widget">
                            <h3 class="widget-title">
                                <a data-bs-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="false" aria-controls="widget-body-3" class="collapsed">Price</a>
                            </h3>

                            <div class="collapse {{ $slug2 == 'price' ? 'show' : '' }}" id="widget-body-3">
                                <div class="widget-body">
                                    <form action="#">
                                        <div class="price-slider-wrapper">
                                            <div id="price-slider"></div><!-- End #price-slider -->
                                        </div><!-- End .price-slider-wrapper -->

                                        <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                            <button type="submit" class="btn btn-primary">Filter</button>

                                            <div class="filter-price-text">
                                                Price:
                                                <span id="filter-price-range"></span>
                                            </div><!-- End .filter-price-text -->
                                        </div><!-- End .filter-price-action -->
                                    </form>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget --> --}}

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-bs-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="false" aria-controls="widget-body-4" class="collapsed">Size</a>
                            </h3>

                            <div class="collapse {{ $slug2 == 'size' ? 'show' : '' }}" id="widget-body-4">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach ($sizes as $size)
                                            <li><a href="{{ route('product.bycategory', [$slug, 'size', $size]) }}">{{ $size }}
                                                    {{-- ({{ $size->products->count() }}) --}}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-bs-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="false" aria-controls="widget-body-5" class="collapsed">Brand</a>
                            </h3>

                            <div class="collapse {{ $slug2 == 'brand' ? 'show' : '' }}" id="widget-body-5">
                                <div class="widget-body">
                                    <ul class="cat-list">

                                        @foreach ($brands as $brand)
                                            <li><a href="{{ route('product.bycategory', [$slug, 'brand', $brand->slug]) }}">{{ $brand->name }}
                                                    ({{ $brand->products->count() }})
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-featured">
                            <h3 class="widget-title">Featured</h3>

                            <div class="widget-body">
                                <div class="owl-carousel widget-featured-products">
                                    {{-- @php($sl = 1)
                                    @foreach ($featured as $fitem)
                                        @if ($sl % 3 == 1)
                                            <div class="featured-col">
                                        @endif
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('product', $fitem->slug) }}">
                                                    <img src="{{ asset('product_photo/' . $fitem->thumbnail) }}">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h2 class="product-title" style = "font-size: 13px">
                                                    <a href="{{ route('product', $fitem->slug) }}">{{ $fitem->name }}</a>
                                                </h2>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div><!-- End .product-ratings -->
                                                </div><!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price" style = "font-size: 13px">{{ $fitem->selling_price }}</span>
                                                </div><!-- End .price-box -->
                                            </div><!-- End .product-details -->
                                        </div>
                                        @if ($sl % 3 == 0 || $sl == count($featured))
                                </div><!-- End .featured-col -->
                                @endif
                                @php($sl++)
                                @endforeach --}}
                                </div><!-- End .widget-featured-slider -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .widget -->

                    </div><!-- End .sidebar-wrapper -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-3"></div><!-- margin -->
    </main><!-- End .main -->
@endsection


@push('js')
        <script>
            var swiper = new Swiper(".mySwiper", {
                autoplay: true, // Disabling autoplay
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


            var swiper = new Swiper(".mySwiperSecure", {
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
