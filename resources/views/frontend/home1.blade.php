@extends('frontend.components.layout')

@section('title')
    Home1
@endsection

@section('content')
    <div class="container mb-2">

        {{-- {{ Breadcrumbs::render('home') }} --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                {{-- @foreach ($banners as $key => $banner) --}}
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('frontend/assets/images/slider/slide-') . $i + 1 . '.png' }}" class="d-block w-100" alt="...">
                                        {{-- <div class="carousel-caption d-none d-md-block">
                                        <img src="{{ asset($company_info->logo) }}" class="mb-2" style="width: 140px" alt="...">
                                        <h1>{{ $banner->banner_name }}</h1>
                                        <h5 class="lh-sm mb-4">{{ $banner->description }}</h5>
                                        <a href="#" class="btn btn-success">Read More</a>
                                    </div> --}}

                                    </div>
                                @endfor
                                {{-- @endforeach --}}
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        {{-- <div class="home-slider owl-carousel owl-theme owl-carousel-lazy mb-2" data-owl-options="{'loop': true,'dots': true, 'nav': false, 'autoplay': true }">
                            <div class="home-slide home-slide1 banner banner-md-vw banner-sm-vw">
                                <img class="owl-lazy slide-bg" src="{{ asset('frontend/assets/images/lazy.png') }}" data-src="{{ asset('frontend/assets/images/slider/slide-1.png') }}" alt="slider image">
                                <div class="banner-layer banner-layer-middle">
                                    <h4 class="text-white pb-4 mb-0">Find the Boundaries. Push Through!</h4>
                                    <h2 class="text-white mb-0">Summer Sale</h2>
                                    <h3 class="text-white text-uppercase m-b-3">70% Off</h3>
                                    <h5 class="text-white text-uppercase d-inline-block mb-0 ls-n-20 align-text-bottom">Starting
                                        At
                                        <b class="coupon-sale-text bg-secondary text-white d-inline-block">$<em class="align-text-top">199</em>99</b>
                                    </h5>
                                    <a href="category.html" class="btn btn-dark btn-md ls-10">Shop Now!</a>
                                </div><!-- End .banner-layer -->
                            </div><!-- End .home-slide -->

                            <div class="home-slide home-slide2 banner banner-md-vw banner-sm-vw">
                                <img class="owl-lazy slide-bg" src="{{ asset('frontend/assets/images/lazy.png') }}" data-src="{{ asset('frontend/assets/images/slider/slide-2.png') }}" alt="slider image">
                                <div class="banner-layer banner-layer-middle text-uppercase">
                                    <h4 class="m-b-2">Over 200 products with discounts</h4>
                                    <h2 class="m-b-3">Great Deals</h2>
                                    <h5 class="d-inline-block mb-0 align-top mr-5">Starting At <b>$<em>299</em>99</b></h5>
                                    <a href="category.html" class="btn btn-dark btn-md ls-10">Get Yours!</a>
                                </div><!-- End .banner-layer -->
                            </div><!-- End .home-slide -->

                            <div class="home-slide home-slide3 banner banner-md-vw banner-sm-vw">
                                <img class="owl-lazy slide-bg" data-src="{{ asset('frontend/assets/images/slider/slide-3.png') }}">
                                <div class="banner-layer banner-layer-middle text-uppercase">
                                    <h4 class="m-b-2">Up to 70% off</h4>
                                    <h2 class="m-b-3">New Arrivals</h2>
                                    <h5 class="d-inline-block mb-0 align-top mr-5">Starting At <b>$<em>299</em>99</b></h5>
                                    <a href="category.html" class="btn btn-dark btn-md ls-10">Get Yours!</a>
                                </div><!-- End .banner-layer -->
                            </div><!-- End .home-slide -->
                        </div><!-- End .home-slider --> --}}
                    </div>
                    <div class="sidebar-overlay"></div>
                    <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
                    <aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
                        <div class="side-menu-wrapper mb-2 d-none d-lg-block">
                            <h2 class="side-menu-title bg-gray ls-n-25">Browse Categories</h2>

                            <nav class="side-nav">
                                {!! frontendCategories($menucategories) !!}
                            </nav>
                        </div><!-- End .side-menu-container -->


                    </aside><!-- End .col-lg-3 -->
                </div>


                <section class="mb-2 py-2 bg-light">
                    <div class="auto-container">
                        <div class="container my-5">
                            <div class="swiper mySwiperSecure">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="col px-3">
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center px-3">
                                                    <i style="color: #4bc778;font-size: 3.5rem;" class="fas fa-money-check"></i>
                                                </div>
                                                <div class="small" style="width: 100px">100% Payment Secured</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="col px-3">
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center px-3">
                                                    <i style="color: #4bc778;font-size: 3.5rem;" class="fas fa-wallet"></i>
                                                </div>
                                                <div class="small" style="width: 100px">Support lots of Payments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="col px-3">
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center px-3">
                                                    <i style="color: #4bc778;font-size: 3.5rem;" class="fas fa-truck"></i>
                                                </div>
                                                <div class="small" style="width: 100px">Free Delivery</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="col px-3">
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center px-3">
                                                    <i style="color: #4bc778;font-size: 3.5rem;" class="fas fa-headset"></i>
                                                </div>
                                                <div class="small" style="width: 100px">24hours/7days Support</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="col px-3">
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center px-3">
                                                    <i style="color: #4bc778;font-size: 3.5rem;" class="fas fa-tag"></i>
                                                </div>
                                                <div class="small" style="width: 100px">Best Price Guaranteed</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="col px-3">
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center px-3">
                                                    <i style="color: #4bc778;font-size: 3.5rem;" class="fab fa-android"></i>
                                                </div>
                                                <div class="small" style="width: 100px">Mobile Apps Ready</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>






                <div id="search-content">


                    <div class="banners-container m-b-2 owl-carousel owl-theme" data-owl-options="{'dots': false,'margin': 20,'loop': false,'responsive': {'480': {'items': 2},'768': {'items': 3}}}">
                        <div class="banner banner1 banner-hover-shadow mb-2">
                            <figure>
                                <img src="{{ asset('frontend/assets/images/banners/banner-1.jpg') }}" alt="banner">
                            </figure>
                            <div class="banner-layer banner-layer-middle">
                                <h3 class="m-b-2">Porto Watches</h3>
                                <h4 class="m-b-4 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup>
                                </h4>
                                <a href="#" class="text-dark text-uppercase ls-10">Shop Now</a>
                            </div>
                        </div><!-- End .banner -->
                        <div class="banner banner2 text-uppercase banner-hover-shadow mb-2">
                            <figure>
                                <img src="{{ asset('frontend/assets/images/banners/banner-2.jpg') }}" alt="banner">
                            </figure>
                            <div class="banner-layer banner-layer-middle text-center pt-2">
                                <h3 class="m-b-1 ls-n-20">Deal Promos</h3>
                                <h4 class="m-b-4 text-body">Starting at $99</h4>
                                <a href="#" class="text-dark text-uppercase ls-10">Shop Now</a>
                            </div>
                        </div><!-- End .banner -->
                        <div class="banner banner3 banner-hover-shadow mb-2">
                            <figure>
                                <img src="{{ asset('frontend/assets/images/banners/banner-3.jpg') }}" alt="banner">
                            </figure>
                            <div class="banner-layer banner-layer-middle text-right">
                                <h3 class="m-b-2">Handbags</h3>
                                <h4 class="mb-3 pb-1 text-secondary text-uppercase">Starting at $99</h4>
                                <a href="#" class="text-dark text-uppercase ls-10">Shop Now</a>
                            </div>
                        </div><!-- End .banner -->
                    </div>


                    <section class="py-3">
                        <div class="auto-container">
                            <div class="container my-5">
                                <h4 class="fw-bold m-0">Deals of the day</h4>
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="swiper-slide">
                                                <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                    <div class="product"> <img src="{{ asset('frontend/siteimages/300x300/preview_' . rand(1, 30) . '.jpg') }}" alt="">
                                                        <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                            <a href="{{ route('product', 'product-slug') }}">
                                                                <li class="icon"><span class="fas fa-search"></span></li>
                                                            </a>
                                                            <a href="">
                                                                <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                            </a>
                                                            <a href="">
                                                                <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                            </a>
                                                        </ul>
                                                    </div>
                                                    {{-- <div class="tag bg-red">sale</div> --}}
                                                    <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                    <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                    <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                        <span class="text-success">&#2547; 60.0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
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


                    <section class="py-3">
                        <div class="auto-container">
                            <div class="container my-5">
                                <h4 class="fw-bold m-0">Best Rated Products</h4>
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @for ($i = 0; $i < 8; $i++)
                                            <div class="swiper-slide">
                                                <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                    <div class="product"> <img src="{{ asset('frontend/siteimages/300x300/preview_' . rand(1, 30) . '.jpg') }}" alt="">
                                                        <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                            <a href="{{ route('product', 'product-slug') }}">
                                                                <li class="icon"><span class="fas fa-search"></span></li>
                                                            </a>
                                                            <a href="">
                                                                <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                            </a>
                                                            <a href="">
                                                                <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                            </a>
                                                        </ul>
                                                    </div>
                                                    {{-- <div class="tag bg-red">sale</div> --}}
                                                    <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                    <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span>
                                                    </div>
                                                    <div>10 review</div>

                                                    <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                        <span class="text-success">&#2547; 60.0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
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


                    <section class="py-3">
                        <div class="auto-container">
                            <div class="container my-5">
                                <h4 class="fw-bold m-0">Featured Products</h4>
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @for ($i = 0; $i < 8; $i++)
                                            <div class="swiper-slide">
                                                <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                    <div class="product"> <img src="{{ asset('frontend/siteimages/300x300/preview_' . rand(1, 30) . '.jpg') }}" alt="">
                                                        <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                            <a href="{{ route('product', 'product-slug') }}">
                                                                <li class="icon"><span class="fas fa-search"></span></li>
                                                            </a>
                                                            <a href="">
                                                                <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                            </a>
                                                            <a href="">
                                                                <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                            </a>
                                                        </ul>
                                                    </div>
                                                    {{-- <div class="tag bg-red">sale</div> --}}
                                                    <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                    <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                    <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                        <span class="text-success">&#2547; 60.0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
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

                    <section class="my-3">
                        <div class="row">
                            <a href="" class="tokoo-banner-link">
                                <img src="{{ asset('frontend/siteimages/banner-0a.png') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                    </section>


                    <section class="">
                        <div class="container ninesection my-5">
                            <h4 class="fw-bold m-0">New Arrivals</h4>
                            <div class="row">
                                <!-- First Column (4 pieces of content) -->
                                <div class="col-6 col-lg-4">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/aacoffe-1-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/j1-1-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 d-none d-sm-block">
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/area-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/cam26-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Column (One big content) -->
                                <div class="col-md-4 d-none d-lg-block" style="margin-bottom:20px">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3">
                                        <div class="single_card border-bottom">
                                            <img src="{{ asset('frontend/siteimages/pamper-1-600x600.jpg') }}" alt="" style="width: 100%">
                                        </div>
                                        {{-- <div class="tag bg-red">sale</div> --}}
                                        <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                        <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                        <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                            <span class="text-success">&#2547; 60.0</span>
                                        </div>
                                        <div class="">
                                            <a href="#" class="btn btn-success px-5 py-3">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Third Column (4 pieces of content) -->
                                <div class="col-6 col-lg-4">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/j1-1-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/jbl-speaker-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 d-none d-sm-block">
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/panasonic-1-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                            <div class="card col d-flex flex-column align-items-center product-item my-3">
                                                <div class="product"> <img src="{{ asset('frontend/siteimages/w11-1-300x300.jpg') }}" alt="">
                                                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                                                        <a href="{{ route('product', 'product-slug') }}">
                                                            <li class="icon"><span class="fas fa-search"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                                                        </a>
                                                        <a href="">
                                                            <li class="icon"><span class="fas fa-shopping-bag"></span></li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                {{-- <div class="tag bg-red">sale</div> --}}
                                                <div class="card-title pt-4 pb-1">Winter Sweater</div>
                                                <div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>

                                                <div class="price"><span><del class="price">&#2547; 60.0</del></span>
                                                    <span class="text-success">&#2547; 60.0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="py-3">
                        <div class="container my-5">
                            <h4 class="fw-bold m-0">Shop by Categories</h4>
                            <div class="row row-cols-2 rol-cols-md-3 row-cols-lg-4 g-3">
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #f9dcd9;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/jerk-1-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Baby & Kids</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #e1e1e1;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/Untitled-2-1-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Apple Products</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #e1e1e1;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/aflash-1-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Flash Disk Drive</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #f9f8d9;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/lays_04a-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Snacks & Grocery</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #d5efe3;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/play-1-600x600.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Gaming Tools</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #f2e1d6;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/kitchenwear-1-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Kitchen Wears</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #e9c4cc;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/babycl-1-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark">Baby Clothes</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 col d-flex flex-column align-items-center product-item my-3" style="background-color: #b5cda9;">
                                        <div class="p-5">
                                            <img src="{{ asset('frontend/siteimages/png-cat/shoe-1-300x300.png') }}" alt="">
                                            <div class=" text-center text-uppercase pt-4 text-dark"> Sports Equipment</div>
                                            <div class="small text-center pb-1">{{ rand(1, 50) . ' products' }}</div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </section>









                    {{-- 

                    <!-- FEATURED PRODUCT SECTION -->
                    <h2 class="section-title ls-n-10 m-b-4">Featured Products</h2>
                    <div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
                        @foreach ($featured as $featureproduct)
                            <div class="product-default inner-quickview inner-icon" style = "box-shadow: 0px 0px 16px -2px #ddd;">
                                <figure class="mb-0">
                                    <a href="{{ route('product', $featureproduct->slug) }}">
                                        <img src="{{ asset('product_photo/' . $featureproduct->thumbnail) }}">
                                    </a>

                                    @if ($featureproduct->special_price != '' && $featureproduct->special_price != 0)
                                        @if ($featureproduct->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $featureproduct->special_price_to)
                                            <div class="label-group">
                                                <div class="product-label label-sale">
                                                    -{{ round((($featureproduct->selling_price - $featureproduct->special_price) / $featureproduct->selling_price) * 100, 2) }}
                                                    %</div>
                                            </div>
                                        @endif
                                    @endif
                                </figure>
                                <div class="product-details" style="padding: 0px 5px">
                                    <h2 class="product-title" style="height: 35px; line-height:1.1">
                                        <a href="{{ route('product', $featureproduct->slug) }}" style="font-size: 13px;white-space: normal;">
                                            {{ $featureproduct->name }}
                                        </a>
                                    </h2>
                                    <div class="price-box">
                                        @if ($featureproduct->special_price != '' && $featureproduct->special_price != 0)
                                            @if ($featureproduct->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $featureproduct->special_price_to)
                                                <span style="font-size: 13px;" class="product-price">&#2547;
                                                    {{ $featureproduct->special_price }}</span>
                                                <span style="font-size: 13px;color:red" class="old-price">&#2547;
                                                    {{ $featureproduct->selling_price }}</span>
                                            @else
                                                <span style="font-size: 13px;" class="">&#2547;
                                                    {{ $featureproduct->selling_price }}</span>
                                            @endif
                                        @else
                                            <span style="font-size: 13px;" class="">&#2547;
                                                {{ $featureproduct->selling_price }}</span>
                                        @endif
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        @endforeach
                    </div><!-- End .featured-proucts -->



                    <!-- Best-Selling-proucts -->
                    <h2 class="section-title ls-n-10 m-b-4">Best Selling Products</h2>
                    <div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
                        @foreach ($featured as $featureproduct)
                            <div class="product-default inner-quickview inner-icon" style = "box-shadow: 0px 0px 16px -2px #ddd;">
                                <figure class="mb-0">
                                    <a href="{{ route('product', $featureproduct->slug) }}">
                                        <img src="{{ asset('product_photo/' . $featureproduct->thumbnail) }}">
                                    </a>

                                    @if ($featureproduct->special_price != '' && $featureproduct->special_price != 0)
                                        @if ($featureproduct->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $featureproduct->special_price_to)
                                            <div class="label-group">
                                                <div class="product-label label-sale">
                                                    -{{ round((($featureproduct->selling_price - $featureproduct->special_price) / $featureproduct->selling_price) * 100, 2) }}
                                                    %</div>
                                            </div>
                                        @endif
                                    @endif
                                </figure>
                                <div class="product-details" style="padding: 0px 5px">
                                    <h2 class="product-title" style="height: 35px; line-height:1.1">
                                        <a href="{{ route('product', $featureproduct->slug) }}" style="font-size: 13px;white-space: normal;">
                                            {{ $featureproduct->name }}
                                        </a>
                                    </h2>
                                    <div class="price-box">
                                        @if ($featureproduct->special_price != '' && $featureproduct->special_price != 0)
                                            @if ($featureproduct->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $featureproduct->special_price_to)
                                                <span style="font-size: 13px;" class="product-price">&#2547;
                                                    {{ $featureproduct->special_price }}</span>
                                                <span style="font-size: 13px;color:red" class="old-price">&#2547;
                                                    {{ $featureproduct->selling_price }}</span>
                                            @else
                                                <span style="font-size: 13px;" class="">&#2547;
                                                    {{ $featureproduct->selling_price }}</span>
                                            @endif
                                        @else
                                            <span style="font-size: 13px;" class="">&#2547;
                                                {{ $featureproduct->selling_price }}</span>
                                        @endif
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        @endforeach
                    </div><!-- End Best-Selling-proucts -->

                    <!-- Latest-proucts -->
                    <h2 class="section-title ls-n-10 m-b-4">Latest Products</h2>
                    <div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
                        @foreach ($featured as $featureproduct)
                            <div class="product-default inner-quickview inner-icon" style = "box-shadow: 0px 0px 16px -2px #ddd;">
                                <figure class="mb-0">
                                    <a href="{{ route('product', $featureproduct->slug) }}">
                                        <img src="{{ asset('product_photo/' . $featureproduct->thumbnail) }}">
                                    </a>

                                    @if ($featureproduct->special_price != '' && $featureproduct->special_price != 0)
                                        @if ($featureproduct->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $featureproduct->special_price_to)
                                            <div class="label-group">
                                                <div class="product-label label-sale">
                                                    -{{ round((($featureproduct->selling_price - $featureproduct->special_price) / $featureproduct->selling_price) * 100, 2) }}
                                                    %</div>
                                            </div>
                                        @endif
                                    @endif
                                </figure>
                                <div class="product-details" style="padding: 0px 5px">
                                    <h2 class="product-title" style="height: 35px; line-height:1.1">
                                        <a href="{{ route('product', $featureproduct->slug) }}" style="font-size: 13px;white-space: normal;">
                                            {{ $featureproduct->name }}
                                        </a>
                                    </h2>
                                    <div class="price-box">
                                        @if ($featureproduct->special_price != '' && $featureproduct->special_price != 0)
                                            @if ($featureproduct->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $featureproduct->special_price_to)
                                                <span style="font-size: 13px;" class="product-price">&#2547;
                                                    {{ $featureproduct->special_price }}</span>
                                                <span style="font-size: 13px;color:red" class="old-price">&#2547;
                                                    {{ $featureproduct->selling_price }}</span>
                                            @else
                                                <span style="font-size: 13px;" class="">&#2547;
                                                    {{ $featureproduct->selling_price }}</span>
                                            @endif
                                        @else
                                            <span style="font-size: 13px;" class="">&#2547;
                                                {{ $featureproduct->selling_price }}</span>
                                        @endif
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        @endforeach
                    </div><!-- End .Latest-proucts -->
                </div> --}}




                    <hr class="mt-1 mb-4">

                    <div class="feature-boxes-container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="feature-box px-sm-3 feature-box-simple text-center">
                                    <i class="icon-earphones-alt"></i>

                                    <div class="feature-box-content">
                                        <h3 class="m-b-1">Customer Support</h3>
                                        <h5 class="m-b-3">Need Assistance?</h5>

                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p> --}}
                                    </div><!-- End .feature-box-content -->
                                </div><!-- End .feature-box -->
                            </div><!-- End .col-md-4 -->

                            <div class="col-md-4">
                                <div class="feature-box px-sm-3 feature-box-simple text-center">
                                    <i class="icon-credit-card"></i>

                                    <div class="feature-box-content">
                                        <h3 class="m-b-1">Secured Payment</h3>
                                        <h5 class="m-b-3">Safe & Fast</h5>

                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p> --}}
                                    </div><!-- End .feature-box-content -->
                                </div><!-- End .feature-box -->
                            </div><!-- End .col-md-4 -->

                            <div class="col-md-4">
                                <div class="feature-box px-sm-3 feature-box-simple text-center">
                                    <i class="icon-action-undo"></i>

                                    <div class="feature-box-content">
                                        <h3 class="m-b-1">Returns</h3>
                                        <h5 class="m-b-3">Easy & Free</h5>

                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna,
                                        et dapib.</p> --}}
                                    </div><!-- End .feature-box-content -->
                                </div><!-- End .feature-box -->
                            </div><!-- End .col-md-4 -->
                        </div><!-- End .row -->
                    </div><!-- End .feature-boxes-container -->
                </div><!-- End .col-lg-9 -->


            </div><!-- End .row -->
        </div><!-- End .container -->
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
