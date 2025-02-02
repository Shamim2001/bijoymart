@extends('frontend.components.layout')

@section('title')
    Blog
@endsection

@push('css')
    <style>
        .post-body {
            margin-left: 0px !important;
        }
    </style>
@endpush


@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <main class="main">

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
                {{-- {{ Breadcrumbs::render('about') }} --}}
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog-section row">

                        @foreach ($blogContents as $item)
                            <div class="col-md-6 col-lg-4">
                                <article class="post">
                                    <div class="post-media" style="width: 100%;">
                                        <a href="">
                                            <img src="{{ asset('') . $item->image }}" alt="Post" width="100%">
                                        </a>
                                        <div class="post-date">
                                            <span class="day">26</span>
                                            <span class="month">Feb</span>
                                        </div>
                                    </div><!-- End .post-media -->

                                    <div class="post-body">
                                        <h2 class="post-title">
                                            <a href="">{{ $item->title }}</a>
                                        </h2>
                                        <div class="post-content">
                                            <p>
                                                {!! Str::words($item->description, 20, '...') !!}
                                            </p>
                                        </div><!-- End .post-content -->
                                        <a href="" class="post-comment">0 Comments</a>
                                    </div><!-- End .post-body -->
                                </article><!-- End .post -->
                            </div>
                        @endforeach

                    </div>
                    <div class="mt-4 d-flex justify-content-center paginate">
                        {{ $blogContents->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div><!-- End .col-lg-9 -->


                <div class="col-lg-3">
                    <div class="sidebar-toggle custom-sidebar-toggle">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <div class="sidebar-overlay"></div>
                    <aside class="sidebar mobile-sidebar">
                        <div class="pin-wrapper" style="height: 634.156px;">
                            <div class="sidebar-wrapper" data-sticky-sidebar-options="{&quot;offsetTop&quot;: 72}" style="border-bottom: 0px none rgb(119, 119, 119); width: 280px; position: absolute; top: 253.813px;">
                                <div class="widget widget-categories">
                                    <h4 class="widget-title">Blog Categories</h4>

                                    <ul class="list">
                                        <li><a href="{{ route('store.blog') }}">All</a></li>
                                        @foreach ($blogCategories as $bcategory)
                                            <li><a href="{{ route('store.blog.single', $bcategory->slug) }}">{{ $bcategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget -->

                                <div class="widget widget-post">
                                    <h4 class="widget-title">Recent Posts</h4>

                                    <ul class="simple-post-list">
                                        @foreach ($blogContents->take(3) as $item)
                                            <li>
                                                <div class="post-media">
                                                    <a href="single.html">
                                                        <img src="{{ asset('') . $item->image }}" alt="Post">
                                                    </a>
                                                </div><!-- End .post-media -->
                                                <div class="post-info">{{ $item->title }}</a>
                                                    <div class="post-meta">{{ $item->created_at->format('F d, Y') }}</div>
                                                    <!-- End .post-meta -->
                                                </div><!-- End .post-info -->
                                            </li>
                                        @endforeach


                                    </ul>
                                </div><!-- End .widget -->

                                {{-- <div class="widget">
                                    <h4 class="widget-title">Tags</h4>

                                    <div class="tagcloud">
                                        <a href="#">ARTICLES</a>
                                        <a href="#">CHAT</a>
                                    </div><!-- End .tagcloud -->
                                </div><!-- End .widget --> --}}
                            </div>
                        </div><!-- End .sidebar-wrapper -->
                    </aside><!-- End .col-lg-3 -->
                </div>
            </div><!-- End .row -->
        </div>
    </main><!-- End .main -->
@endsection
