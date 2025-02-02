//size name show on select
$(document).on('click', '.size-item', function (e) {
    e.preventDefault();
    let val = $(this).attr('data-value');
    $('#size-name').html(val);
})

//color name show on select
$(document).on('click', '.color-item', function (e) {
    e.preventDefault();
    let val = $(this).attr('data-value');
    $('#color-name').html(val);
})



//QUICK VIEW MODAL LOADER

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).on('click', '.btn-quickview', function (e) {
        e.preventDefault();
        $('.bd-example-modal-lg').modal('show');

        let url = $(this).attr('href');
        $.ajax({
            url: url,
            data: {},
            method: 'post',
            success: function (data) {
                $('#quickviewcontent').html(data);
            }
        })
    })
})



//PRODUCT ITEMS INCREMENT AND DECREEMENT

$(document).on('click', '#qtyplus', function (e) {
    e.preventDefault();
    let val = $('#quantity').val();

    if (val) {
        $('#quantity').val(parseInt(val) + 1);
    } else {
        $('#quantity').val(1);
    }
})

$(document).on('click', '#qtyminus', function (e) {
    e.preventDefault();
    let val = $('#quantity').val();
    if (val > 0) {
        $('#quantity').val(parseInt(val) - 1);
    } else {
        $('#quantity').val(parseInt(val));
    }
})


// VALIDATION CHECK AND UPDATE CART ITEM FORM PRODUCT DETAILS PAGE

$(document).on('click', '#add-to-cart', function (e) {
    e.preventDefault();
    let qty = $('#quantity').val();
    if (qty == '' || qty == 0) {
        toastr.error('Quantity cannot be empty');
    }
    let productId = $('#id').val();
    let color = $('input[name="color"]:checked').val();
    let size = $('input[name="size"]:checked').val();
    // let size = $('#size-name').html();
    // if (size == '') {
    //     toastr.error('Select a Size');
    // }
    // let color = $('#color-name').html();
    // if (color == '') {
    //     toastr.error('Select a color');
    // }
    if (qty >= 0) {

        $.ajax({
            url: "/cart/add",
            method: "post",
            data: { qty: qty, productId: productId, size: size, color: color },
            success: function (result) {
                if (result.status === 1) {
                    load_cart_item();
                    toastr.success(result.message);
                } else if (result.status === 0) {
                    toastr.error(result.message);

                }
            }
        });
    }

})
$(document).on('click', '#order-now', function (e) {
    e.preventDefault();
    let qty = $('#quantity').val();
    if (qty == '' || qty == 0) {
        toastr.error('Quantity cannot be empty');
    }
    let productId = $('#id').val();
    // let size = $('#size-name').html();
    // if (size == '') {
    //     toastr.error('Select a Size');
    // }
    let color = $('input[name="color"]:checked').val();
    let size = $('input[name="size"]:checked').val();
    // if (color == '') {
    //     toastr.error('Select a color');
    // }
    // console.log(color, size); return


    data = { qty: qty, productId: productId, size: size, color: color },
        console.log(data);

    if (qty >= 0) {

        $.ajax({
            url: "/cart/add",
            method: "post",
            data: { qty: qty, productId: productId, size: size, color: color },
            success: function (result) {
                if (result.status === 1) {
                    // load_cart_item();
                    // toastr.success(result.message);
                    window.location.href = '/customer/checkout';
                } else if (result.status === 0) {
                    toastr.error(result.message);

                }
            }
        });
    }

})


// PRODUCT ADD FROM ICON OF THUMBNAIL CART

$(document).on('click', '.btn-add-cart', function (e) {
    e.preventDefault();
    let productId = $(this).val();

    $.ajax({
        url: '/cart/add/icon',
        method: 'post',
        data: { productId: productId },
        success: function (res) {
            load_cart_item();
            clear_wish_list();
            toastr.success(res.message);
        }
    });
})

function load_cart_item() {
    $.ajax({
        url: '/cart/load-cart-item',
        method: 'post',
        data: {},
        success: function (res) {
            $('#cart-reload').html(res);
        }
    });
}

// ............................................................................

//ADD PRODUCT FROM WISHLIST TO CART

$(document).on('click', '.wishlist-cart', function (e) {
    e.preventDefault();
    let productId = $(this).val();

    $.ajax({
        url: '/customer/add_wishlist_to_cart',
        method: 'post',
        data: { productId: productId },
        success: function (res) {
            load_cart_item();
            clear_wish_list();
            load_wishlist_item()
            toastr.success(res.message);
        }
    });
})

//CLEAR WISH LIST ON ADD TO CART
function clear_wish_list() {

    let productId = $('.wishlist-cart').val();
    $.ajax({
        url: '/customer/clearwishlist',
        method: 'post',
        data: { productId: productId },
        success: function (res) {
            // $('#cart-reload').html(res);
        }
    });
}

//LOAD WISHLIST AGAIN AFTER CLICK ON ADD TO CART IN WISHLIST PAGE.
function load_wishlist_item() {
    $.ajax({
        url: '/customer/load_wishlist_item',
        method: 'post',
        data: {},
        success: function (res) {
            $('#wishlist-reload').html(res);
        }
    });
}

// ...........................................................................

//ADD PRODUCT TO WISH LIST
$(document).on('click', '.add-wishlist', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');

    $.ajax({
        url: '/customer/addtolist',
        method: 'POST',
        data: { id: id },
        success: function (res) {
            if (res.status == 2) {
                toastr.info(res.message);
            } else if (res.status == 1) {
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        }
    });
})

$(document).ready(function () {

    $('.dynamic').on('change', function () {

        let value = $(this).val();
        let name = $(this).data('name');

        if (name == 'district') {
            $('#thana').html('<option value="">==Select Thana==</option>');
        }

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $.ajax({
            url: '/customer/data',
            method: 'POST',
            data: { value: value, name: name },
            success: function (result) {

                $('#' + name).html('<option value="">==Select ' + name + '==</option>');
                $.each(result, function (key, data) {
                    if (name == 'district') {
                        $('#district').append('<option value="' + data.district + '">' + data.district + '</option>');
                    } else {
                        $('#' + name).append('<option value="' + data.thana + '">' + data.thana + '</option>');
                    }
                })
            }
        })
    })

})

//CUSTOMER ADDRESS FORM
$(document).ready(function () {

    $('#shipping_button').on('click', function () {
        $('#default').hide();
        $('#shipping_address').show();
    })
    $('#billing_button').on('click', function () {
        $('#default').hide();
        $('#billing_address').show();
    })

})


//product search code

$(document).on('keyup', '#search_text', function (e) {

    let searchText = $(this).val();

    $.ajax({
        url: '/search-ajax',
        method: 'GET',
        data: { searchText: searchText },
        success: function (res) {
            // console.log(res);
            $('.search_result').html('');
            $.each(res, function (key, value) {
                $('.search_result').append('<li onclick="select(this)">' + value.name + '</li>');
            })
        }
    });
})

function select(element) {
    let text = $(element).text();
    $('#search_text').val(text);
}
//end product search code.


$(document).on('submit', '#form-reviews', function (e) {
    e.preventDefault();
    let p_id = $('#p_id').val();

    $.ajax({
        url: '/review/product',
        method: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.status == 1) {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);

            }
            reload_review(p_id)
        }
    })
})

function reload_review($id) {
    $.ajax({
        url: '/review/reload',
        method: 'get',
        data: { id: $id },
        success: function (res) {
            $('#reload_review').html(res);
        }
    });

}
