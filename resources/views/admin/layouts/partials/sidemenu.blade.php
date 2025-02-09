<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <img src="{{ asset('frontend/assets/images/logo2.png') }}" alt="Bijoy Mart Logo" style="height: 65px;margin-left:40px">
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (Auth::user()->user_type === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
                {{-- <ul>
                    <li> <a href="index.html"><i class="bi bi-arrow-right-short"></i>eCommerce</a>
                    </li>
                    <li> <a href="index2.html"><i class="bi bi-arrow-right-short"></i>Sales</a>
                    </li>
                    <li> <a href="index3.html"><i class="bi bi-arrow-right-short"></i>Analytics</a>
                    </li>
                    <li> <a href="index4.html"><i class="bi bi-arrow-right-short"></i>Project Management</a>
                    </li>
                    <li> <a href="index5.html"><i class="bi bi-arrow-right-short"></i>CMS Dashboard</a>
                    </li>
                </ul> --}}
            </li>
            <hr>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Products</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.product.create') }}"><i class="bi bi-arrow-right-short"></i>Add New Products</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.index') }}"><i class="bi bi-arrow-right-short"></i>All Products</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.seller.product') }}"><i class="bi bi-arrow-right-short"></i>Seller Products</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.index') }}"><i class="bi bi-arrow-right-short"></i>All Category</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.brand.index') }}"><i class="bi bi-arrow-right-short"></i>All Brand</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.color.index') }}"><i class="bi bi-arrow-right-short"></i>All Color</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.review') }}"><i class="bi bi-arrow-right-short"></i>Products Reviews</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Orders</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.order.allOrders') }}"><i class="bi bi-arrow-right-short"></i>All Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.pendingOrder') }}"><i class="bi bi-arrow-right-short"></i>Pending Order</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.approvedOrder') }}"><i class="bi bi-arrow-right-short"></i>Approved Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.shippingOrder') }}"><i class="bi bi-arrow-right-short"></i>Shipping Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.deliveredOrder') }}"><i class="bi bi-arrow-right-short"></i>Delivered Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.cancelledOrder') }}"><i class="bi bi-arrow-right-short"></i>Cancelled Orders</a>
                    </li>







                    {{-- <li>
                        <a href="{{ route('admin.order.inHouseOrders') }}"><i class="bi bi-arrow-right-short"></i>Inhouse Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.sellerOrders') }}"><i class="bi bi-arrow-right-short"></i>Seller Orders</a>
                    </li> --}}
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Sellers</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.seller.allSeller') }}"><i class="bi bi-arrow-right-short"></i>All Seller</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seller.payout') }}"><i class="bi bi-arrow-right-short"></i>Payouts</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seller.payoutRequest') }}"><i class="bi bi-arrow-right-short"></i>Payout Request</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seller.sellerCommission') }}"><i class="bi bi-arrow-right-short"></i>Seller Commission</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Reports</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.report.productStock') }}"><i class="bi bi-arrow-right-short"></i>Products Stock</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.productSale') }}"><i class="bi bi-arrow-right-short"></i>Products Sale</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.productWishlist') }}"><i class="bi bi-arrow-right-short"></i>Products Wishlist</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.lowStockProduct') }}"><i class="bi bi-arrow-right-short"></i>Low Stock Products</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Website Setup</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.website.info') }}"><i class="bi bi-arrow-right-short"></i>website Info</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.home.homeSlider.index') }}"><i class="bi bi-arrow-right-short"></i>Home Slider</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.home.banner.index') }}"><i class="bi bi-arrow-right-short"></i>Banner Upload</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.home.singleBanner.index') }}"><i class="bi bi-arrow-right-short"></i>Single Upload</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.home.section.index') }}"><i class="bi bi-arrow-right-short"></i>Home Scroll Sections</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('admin.home.newSection.index') }}"><i class="bi bi-arrow-right-short"></i>Home 3 Sections</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('admin.section.product') }}"><i class="bi bi-arrow-right-short"></i>Products Publish in Section</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Blog System</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.blogCategory.index') }}"><i class="bi bi-arrow-right-short"></i>Blog Category</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.blogContent.index') }}"><i class="bi bi-arrow-right-short"></i>All Posts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Administration</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.settings.index') }}"><i class="bi bi-arrow-right-short"></i>All Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.clientReview.index') }}"><i class="bi bi-arrow-right-short"></i>Client Reviews</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-door"></i>
                    </div>
                    <div class="menu-title">Staff Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('admin.staff.index') }}"><i class="bi bi-arrow-right-short"></i>All Staff</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.staff.index') }}"><i class="bi bi-arrow-right-short"></i>Staff Permission</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.withdraw.index') }}"><i class="bi bi-arrow-right-short"></i>Withdraw Manage</a>
            </li>
        @elseif (Auth::user()->user_type === 'staff')
            <li>
                <a href="{{ route('admin.order.allOrders') }}"><i class="bi bi-arrow-right-short"></i>All Orders</a>
            </li>
            <li>
                <a href="{{ route('admin.order.pendingOrder') }}"><i class="bi bi-arrow-right-short"></i>Pending Order</a>
            </li>
            <li>
                <a href="{{ route('admin.order.approvedOrder') }}"><i class="bi bi-arrow-right-short"></i>Approved Orders</a>
            </li>
            <li>
                <a href="{{ route('admin.order.shippingOrder') }}"><i class="bi bi-arrow-right-short"></i>Shipping Orders</a>
            </li>
            <li>
                <a href="{{ route('admin.order.deliveredOrder') }}"><i class="bi bi-arrow-right-short"></i>Delivered Orders</a>
            </li>
            <li>
                <a href="{{ route('admin.order.cancelledOrder') }}"><i class="bi bi-arrow-right-short"></i>Cancelled Orders</a>
            </li>
        @else
            <p>Unauthorized User Type</p>
        @endif
    </ul>
    <!--end navigation-->
</aside>
