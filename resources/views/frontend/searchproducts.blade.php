@extends('frontend.components.layout')

@section('title')
    Search
@endsection

@section('content')
    <div class="container mb-2">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Search Result</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-9">
                <hr class="m-0">
                <div class="row">
                    @if ($products->count() == 0)
                        <div class="col-12 text-center my-5">
                            <h4 class="py-5">No Product Found!</h4>
                        </div>
                    @endif
                    @foreach ($products as $item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('product', $item->slug) }}">
                                        <img src="{{ asset('product_photo/' . $item->thumbnail) }}">
                                    </a>
                                    <div class="label-group">
                                        {{-- <div class="product-label label-hot">HOT</div> --}}
                                        @if ($item->special_price_from != '')
                                            @if ($item->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $item->special_price_to)
                                                <div class="product-label label-sale">
                                                    {{ number_format((float) ((($item->selling_price - $item->special_price) / $item->selling_price) * 100), 2) }}
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="btn-icon-group">
                                        <button type="submit" class="btn-icon btn-add-cart" data-toggle="modal"
                                            data-target="#addCartModal1" value="{{ $item->id }}"><i
                                                class="icon-shopping-cart"></i></button>
                                    </div>
                                    <a href="{{ route('product.quickview', $item->slug) }}" class="btn-quickview"
                                        title="Quick View">Quick View</a>

                                </figure>
                                <div class="product-details">

                                    <h2 class="product-title">
                                        <a href="{{ route('product', $item->slug) }}">{{ $item->name }}</a>
                                    </h2>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        @if ($item->special_price != '' && $item->special_price != 0)
                                            @if ($item->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $item->special_price_to)
                                                <span style="font-size: 13px" class="old-price">&#2547;
                                                    {{ $item->selling_price }}</span>
                                                <span style="font-size: 13px" class="product-price">&#2547;
                                                    {{ $item->special_price }}</span>
                                            @else
                                                <span style="font-size: 13px" class="">&#2547;
                                                    {{ $item->selling_price }}</span>
                                            @endif
                                        @else
                                            <span style="font-size: 13px" class="">&#2547;
                                                {{ $item->selling_price }}</span>
                                        @endif
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div><!-- End .col-sm-4 -->
                        @php
                            $last_id = $item->id;
                        @endphp
                    @endforeach

                </div>
                <div class="row justify-content-end">
                    {{ $products->links() }}
                </div>

                <hr class="mt-1 mb-4">

                <div class="feature-boxes-container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-box px-sm-3 feature-box-simple text-center">
                                <i class="icon-earphones-alt"></i>

                                <div class="feature-box-content">
                                    <h3 class="m-b-1">Customer Support</h3>
                                    <h5 class="m-b-3">Need Assistance?</h5>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna,
                                        et dapib.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box px-sm-3 feature-box-simple text-center">
                                <i class="icon-credit-card"></i>

                                <div class="feature-box-content">
                                    <h3 class="m-b-1">Secured Payment</h3>
                                    <h5 class="m-b-3">Safe & Fast</h5>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna,
                                        et dapib.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box px-sm-3 feature-box-simple text-center">
                                <i class="icon-action-undo"></i>

                                <div class="feature-box-content">
                                    <h3 class="m-b-1">Returns</h3>
                                    <h5 class="m-b-3">Easy & Free</h5>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna,
                                        et dapib.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .feature-boxes-container -->
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
                <div class="side-menu-wrapper text-uppercase mb-2 d-none d-lg-block">
                    <h2 class="side-menu-title bg-gray ls-n-25">Browse Categories</h2>

                    <nav class="side-nav">
                        {!! frontendCategories($menucategories) !!}
                    </nav>
                </div><!-- End .side-menu-container -->

                <div class="widget widget-banners px-5 pb-3 text-center">
                    <div class="owl-carousel owl-theme">
                        <div class="banner d-flex flex-column align-items-center">
                            <h3
                                class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase">
                                <em class="pt-3 ls-0">Sale</em>Many Item
                            </h3>
                            <h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
                        </div><!-- End .banner -->

                        <div class="banner d-flex flex-column align-items-center">
                            <h3
                                class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase">
                                <em class="pt-3 ls-0">Sale</em>Many Item
                            </h3>
                            <h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
                        </div><!-- End .banner -->

                        <div class="banner d-flex flex-column align-items-center">
                            <h3
                                class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase">
                                <em class="pt-3 ls-0">Sale</em>Many Item
                            </h3>
                            <h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
                        </div><!-- End .banner -->
                    </div><!-- End .banner-slider -->
                </div><!-- End .widget -->

                <div class="widget widget-testimonials">
                    <div class="owl-carousel owl-theme dots-left">
                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/clients/client-1.jpg') }}" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">john Smith</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div><!-- End .testimonial-owner -->

                            <blockquote class="ml-4 pr-0">
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.</p>
                            </blockquote>
                        </div><!-- End .testimonial -->

                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/clients/client-2.jpg') }}" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">Dae Smith</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div><!-- End .testimonial-owner -->

                            <blockquote class="ml-4 pr-0">
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.</p>
                            </blockquote>
                        </div><!-- End .testimonial -->

                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/clients/client-3.jpg') }}" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">John Doe</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div><!-- End .testimonial-owner -->

                            <blockquote class="ml-4 pr-0">
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.</p>
                            </blockquote>
                        </div><!-- End .testimonial -->
                    </div><!-- End .testimonials-slider -->
                </div><!-- End .widget -->

                <div class="widget widget-posts post-date-in-media">
                    <div class="owl-carousel owl-theme dots-left dots-m-0"
                        data-owl-options="{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            'margin': 20
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }">
                        <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="{{ asset('frontend/assets/images/blog/home/post-1.jpg') }}" alt="Post">
                                </a>
                                <div class="post-date">
                                    <span class="day">29</span>
                                    <span class="month">Jun</span>
                                </div><!-- End .post-date -->
                            </div><!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title m-b-2">
                                    <a href="single.html">Fashion Trends</a>
                                </h2>

                                <div class="post-content">
                                    <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad
                                        litora
                                        torquent per conubia nostra, per incep tos himens.</p>

                                    <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                                </div><!-- End .post-content -->
                            </div><!-- End .post-body -->
                        </article>

                        <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="{{ asset('frontend/assets/images/blog/home/post-2.jpg') }}" alt="Post">
                                </a>
                                <div class="post-date">
                                    <span class="day">29</span>
                                    <span class="month">Jun</span>
                                </div><!-- End .post-date -->
                            </div><!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title m-b-2">
                                    <a href="single.html">Fashion Trends</a>
                                </h2>

                                <div class="post-content">
                                    <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad
                                        litora
                                        torquent per conubia nostra, per incep tos himens.</p>

                                    <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                                </div><!-- End .post-content -->
                            </div><!-- End .post-body -->
                        </article>

                        <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="{{ asset('frontend/assets/images/blog/home/post-3.jpg') }}" alt="Post">
                                </a>
                                <div class="post-date">
                                    <span class="day">29</span>
                                    <span class="month">Jun</span>
                                </div><!-- End .post-date -->
                            </div><!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title m-b-2">
                                    <a href="single.html">Fashion Trends</a>
                                </h2>

                                <div class="post-content">
                                    <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad
                                        litora
                                        torquent per conubia nostra, per incep tos himens.</p>

                                    <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                                </div><!-- End .post-content -->
                            </div><!-- End .post-body -->
                        </article>
                    </div><!-- End .posts-slider -->
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->


@endsection
