<h2 class="mb-0">My Wishlist</h2>
<hr class="m-0 mb-2">
<table class="table table-borderless">
    <tbody>
        @foreach ($product as $item)
            <tr>
                <td style="width: 100px">
                    <a href="{{ route('product', $item->slug) }}">
                        <img src="{{ asset('product_photo/' . $item->thumbnail) }}" style="width: 80px">
                    </a>
                </td>
                <td><a href="{{ route('product', $item->slug) }}">{{ $item->name }}</a></td>
                <td>
                    @if ($item->special_price != '' && $item->special_price != 0)
                        @if ($item->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $item->special_price_to)
                            <span style="font-size: 13px" class="old-price text-danger">&#2547;
                                {{ $item->selling_price }}</span><br>
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
                </td>
                <td>
                    <button type="submit" class="btn-icon wishlist-cart" style="border: none; cursor: pointer;"
                        value="{{ $item->id }}"><i class="icon-shopping-cart"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
