@foreach ($reviews as $review)

    <li class="comment-container">
        <div class="comment-avatar">
            <img src="" width="65" height="65" alt="avatar" />
        </div><!-- End .comment-avatar-->

        <div class="comment-box">
            <div class="ratings-container">
                <div class="product-ratings">
                    <span class="ratings" style="width:{{ $review->rating * 20 }}%"></span>
                    <!-- End .ratings -->
                </div><!-- End .product-ratings -->
            </div><!-- End .ratings-container -->

            <div class="comment-info mb-1">
                <h4 class="avatar-name">{{ $review->customer->name }}</h4> -
                <span class="comment-date">{{ date('F d, Y', strtotime($review->created_at)) }}</span>
            </div><!-- End .comment-info -->

            <div class="comment-text">
                <p>{{ $review->product_review }}</p>
            </div><!-- End .comment-text -->
        </div><!-- End .comment-box -->
    </li><!-- comment-container -->

@endforeach
