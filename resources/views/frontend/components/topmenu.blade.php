<div class="container">
    <nav class="main-nav w-100">
        <ul class="menu" style="border-top: 1px solid #eee;">
            <li class="active">
                <a class="" href="{{ route('index') }}">Home</a>
            </li>
            <li>
                <a class="" href="#">Category</a>
                {!! headerCategories($menucategories) !!}
            </li>
            <li><a class="" href="{{ route('store.blog') }}">Blog</a></li>
            <li><a class="" href="{{ route('store.aboutUs') }}">About Us</a></li>
            <li><a class="" href="{{ route('store.contactUs') }}">Contact Us</a></li>
            {{-- <li class="float-right"><a href="" target="_blank">Buy Porto!<span class="tip tip-new tip-top">New</span></a></li> --}}
            {{-- <li class="float-right"><a class="" href="#">Special Offer!</a></li> --}}
        </ul>
    </nav>
</div><!-- End .container -->
