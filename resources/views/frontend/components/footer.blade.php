<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title">About Us</h4>
                        <img style="width: 160px" class="bg-white" src="{{ asset('frontend/assets/images/logo2.png') }}" alt="Logo" class="m-b-3">
                        <p class="m-b-4 pt-3" style="color: #e5e5e5">BijoyMart was born out of a simple belief-to make daily grocery shopping convenient, affordable, and hassle-free for all.</p>
                        {{-- <a href="#" class="btn btn-outline-danger btn-sm">Read More</a> --}}
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                    <div class="widget mb-2">
                        <h4 class="widget-title mb-1 pb-1">Contact Info</h4>
                        <ul class="contact-info m-b-4">
                            <li style="color: #e5e5e5">
                                <span class="contact-info-label">Address:</span>{{ $websiteInfo->address }}
                            </li>
                            <li style="color: #e5e5e5">
                                <span class="contact-info-label">Phone:</span><a href="tel:">{{ $websiteInfo->contact_no }}</a>
                            </li>
                            <li style="color: #e5e5e5">
                                <span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">{{ $websiteInfo->email }}</a>
                            </li>
                            {{-- <li style="color: #e5e5e5">
                                <span class="contact-info-label">Working Days/Hours:</span>
                                24/7 Hours
                            </li> --}}
                        </ul>
                        <div class="social-icons">
                            <a href="{{ $websiteInfo->facebook }}" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            <a href="{{ $websiteInfo->twitter }}" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            <a href="{{ $websiteInfo->linkedin }}" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                        </div><!-- End .social-icons -->
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>

                        <ul class="links" style="color: #e5e5e5">
                            <li><a href="#">Help & FAQs</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="{{ route('customer.checkout') }}">Shipping & Delivery</a></li>
                            <li><a href="">Orders History</a></li>
                            <li><a href="#">Advanced Search</a></li>
                            <li><a href="{{ route('customer.myaccount') }}">My Account</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="{{ route('store.aboutUs') }}">About Us</a></li>
                            <li><a href="#">Corporate Sales</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title">Popular Tags</h4>

                        <div class="tagcloud" style="color: #e5e5e5">
                            <a href="#">Bag</a>
                            <a href="#">Black</a>
                            <a href="#">Blue</a>
                            <a href="#">Clothes</a>
                            <a href="#">Fashion</a>
                            <a href="#">Hub</a>
                            <a href="#">Jean</a>
                            <a href="#">Shirt</a>
                            <a href="#">Skirt</a>
                            <a href="#">Sports</a>
                            <a href="#">Sweater</a>
                            <a href="#">Winter</a>
                        </div>
                        <div class="tagcloud" style="color: #e5e5e5">
                            <img src="{{ asset('frontend/assets/images/payment_partner1.png') }}" alt="">
                        </div>
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <p class="footer-copyright py-1 pr-4 mb-0 text-center text-light">Copyright @ {{ date('Y') }}. All Rights Reserved | Design and Developed By <a class="text-info" href="">Startuup Mind</a></p>

            {{-- <img src="{{ asset('frontend/assets/images/payments.png') }}" alt="payment methods" class="footer-payments py-3"> --}}
        </div>
    </div><!-- End .container -->
</footer><!-- End .footer -->
