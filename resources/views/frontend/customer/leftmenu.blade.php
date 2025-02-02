<aside class="sidebar col-lg-3">
    <div class="widget widget-dashboard">
        <h3 class="widget-title">My Account</h3>

        <ul class="list">
            <li class="active"><a href="{{ route('customer.myaccount') }}">Account Dashboard</a></li>
            {{-- <li><a href="#">Account Information</a></li> --}}
            {{-- <li><a href="{{ route('customer.addressbook') }}">Address Book</a></li> --}}

            <li><a href="{{ route('customer.myorder', $customer->phone) }}">My Orders</a></li>

            {{-- <li><a href="{{ route('customer.myorder',['phone' => $customer->phone]) }}">My Orders</a></li> --}}

            {{-- <li><a href="{{ route('customer.myorder') }}">My Orders</a></li> --}}
            {{-- <li><a href="#">My Product Reviews</a></li> --}}


            {{-- <li><a href="{{ route('customer.wishlist',['hashedPhone' => $hashedPhone]) }}">My Wishlist</a></li> --}}
            <li><a href="{{ route('customer.wishlist',$customer->phone) }}">My Wishlist</a></li>



            <li><a href="#">My Point</a></li>
        </ul>
    </div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->
