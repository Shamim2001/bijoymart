@if ($loadproducts->isEmpty())
    <div    class = "text-center">
    <button class = "btn btn-outline-dark">No More Products</button>
    </div>

@else

    <div class = "row">
        @foreach ($loadproducts as $item)
            <div class = "col-6 col-sm-4 col-md-3">
            <div class = "product-default inner-quickview inner-icon" style = "box-shadow: 0px 0px 16px -2px #ddd;">
                    <figure>
                        <a   href = "{{ route('product', $item->slug) }}">
                        <img src  = "{{ asset('product_photo/' . $item->thumbnail) }}">
                        </a>
                        <div class = "label-group">
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            @if ($item->special_price_from != '')
                                @if ($item->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $item->special_price_to)
                                    <div class = "product-label label-sale">
                                        {{ number_format((float) ((($item->selling_price - $item->special_price) / $item->selling_price) * 100), 2) }}
                                    </div>
                                @endif
                            @endif
                        </div>
                            {{-- <div class="btn-icon-group">
                                <button type        = "submit" class         = "btn-icon btn-add-cart" data-toggle = "modal"
                                        data-target = "#addCartModal1" value = "{{ $item->id }}"><i
                                        class       = "icon-shopping-cart"></i></button>
                            </div>
                            <a href  = "{{ route('product.quickview', $item->slug) }}" class = "btn-quickview"
                               title = "Quick View">Quick View</a> --}}

                    </figure>
                    <div class = "product-details" style = "padding: 0px 5px;">
                        {{-- <div class="category-wrap">
                            <div class = "category-list">
                            <a   href  = "category.html" class = "product-category">category</a>
                            </div>
                            <a href = "#" class = "btn-icon-wish"><i class = "icon-heart"></i></a>
                        </div> --}}
                        <h2 class = "product-title" style = "font-size: 13px">
                        <a  href  = "{{ route('product', $item->slug) }}">{{ $item->name }}</a>
                        </h2>
                        <div  class = "ratings-container">
                        <div  class = "product-ratings">
                        <span class = "ratings" style = "width:100%"></span><!-- End .ratings -->
                        <span class = "tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class = "price-box">
                            @if ($item->special_price != '' && $item->special_price != 0)
                                @if ($item->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $item->special_price_to)
                                        <span style = "font-size: 13px" class = "product-price">&#2547;
                                        {{ $item->special_price }}</span>
                                        <span style = "font-size: 13px; color:red" class = "old-price">&#2547;
                                            {{ $item->selling_price }}</span>
                                @else
                                    <span style = "font-size: 13px" class = "">&#2547; {{ $item->selling_price }}</span>
                                @endif
                            @else
                                <span style = "font-size: 13px" class = "">&#2547; {{ $item->selling_price }}</span>
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
    <div class = "text-center">
    <a   href  = "" class = "btn btn-outline-dark py-4 mx-auto" data-id = {{ $last_id }} id = "load-more">Show More</a>
    </div>

    <!-- End .row -->
@endif
