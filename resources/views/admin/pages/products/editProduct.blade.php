@extends('admin.layouts.app')
@section('title')
    Edit Products
@endsection

@section('content')
    <hr />
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <h6 class="mb-0 text-uppercase">Edit Product</h6>
                </div>
                <div>
                    <a class="btn btn-dark" href="{{ route('admin.product.index') }}"> All Products</a>
                </div>
            </div>
            <form id="myForm" action="{{ route('admin.product.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            {{-- <form id="myForm" action="" method="POST" enctype="multipart/form-data"> --}}
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <h6>Product Information</h6>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Product Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Product name" value="{{ $data->name }}" required>
                                            @error('name')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="single-select form-control" name="category" required>
                                                <option value="" selected>Select</option>
                                                {!! getCategory($categories, 2, $data->category_id) !!}
                                            </select>
                                            @error('category')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Brand <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="single-select form-control" name="brand" required>
                                                <option value="" selected>Select</option>
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->id }}" {{ $data->brand_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Model</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="model" class="form-control" placeholder="Model" value="{{ $data->model }}">
                                            @error('model')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Unit <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="single-select form-control" name="unit" required>
                                                <option value="" selected>Select Unit</option>
                                                <option value="Pcs" {{ $data->unit == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                                <option value="Kg" {{ $data->unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                                                <option value="Packet" {{ $data->unit == 'Packet' ? 'selected' : '' }}>Packet</option>
                                                <option value="Box" {{ $data->unit == 'Box' ? 'selected' : '' }}>Box</option>
                                                <option value="Cartoon" {{ $data->unit == 'Cartoon' ? 'selected' : '' }}>Cartoon</option>
                                                <option value="Dozzon" {{ $data->unit == 'Dozzon' ? 'selected' : '' }}>Dozzon</option>
                                            </select>
                                            {{-- <input type="text" name="unit" class="form-control" placeholder="Unit" value="{{ old('unit') }}" required> --}}
                                            @error('unit')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Weight (in Kg)</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="weight" class="form-control" placeholder="Weight" value="{{ $data->weight }}">
                                            @error('weight')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Minimum Purchase Qty <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="minimum_purchase_qty" class="form-control" placeholder="Minimum purchase qty" value="{{ $data->minimum_purchase_qty }}" required>
                                            @error('minimum_purchase_qty')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <h6>Product Image</h6>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Gallery Image (600x600)</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="gallery_images[]" class="form-control" multiple>
                                            <div>
                                                @foreach (json_decode($data->images) as $image)
                                                    <div class="d-inline-flex flex-column mt-2">
                                                        <label for="" class="text-danger">
                                                            <input id="{{ $image }}" type="checkbox" name="remove_images[]" value="{{ $image }}"><label class="ps-1" for="{{ $image }}">Remove</label>
                                                        </label>
                                                        <img class="m-0" src="{{ singlePhoto([$image]) }}" alt="" class="mt-2" style="width: 80px">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Thumbnail Image (300x300)</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="thumbnail" class="form-control">
                                            <img src="{{ singlePhoto(json_decode($data->thumbnail)) }}" alt="" class="mt-2" style="width: 80px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <h6>Product Variation</h6>
                                    <hr>
                                    <div id="product-details">
                                        @forelse ($data->ProductStock as $key => $variant)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <select id="color-select" class="single-select form-control" name="color[]">
                                                        <option value="" selected>Select Color</option>
                                                        @foreach ($colors as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $variant->color_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="single-select form-control" name="size[]">
                                                        <option value="" selected>Select Size</option>
                                                        <option value="Small" {{ $variant->size == 'Small' ? 'selected' : '' }}>Small</option>
                                                        <option value="Medium" {{ $variant->size == 'Medium' ? 'selected' : '' }}>Medium</option>
                                                        <option value="Large" {{ $variant->size == 'Large' ? 'selected' : '' }}>Large</option>
                                                        <option value="XL" {{ $variant->size == 'XL' ? 'selected' : '' }}>XL</option>
                                                        <option value="XXL" {{ $variant->size == 'XXL' ? 'selected' : '' }}>XXL</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="qty[]" class="form-control" placeholder="qty" value="{{ $variant->qty }}">
                                                </div>
                                                <div class="col-md-1">
                                                    @if ($key == 0)
                                                        <button type="button" class="btn btn-success" id="add-button">+</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger remove-button">-</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <select id="color-select" class="single-select form-control" name="color[]">
                                                        <option value="" selected>Select Color</option>
                                                        @foreach ($colors as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="single-select form-control" name="size[]">
                                                        <option value="" selected>Select Size</option>
                                                        <option value="Small">Small</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Large">Large</option>
                                                        <option value="XL">XL</option>
                                                        <option value="XXL">XXL</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="qty[]" class="form-control" placeholder="qty">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-success" id="add-button">+</button>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <h6>Product Price + Stock</h6>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Selling Price <span class="text-danger">*</span></label>
                                        <div class="col-sm-3">
                                            <input type="number" step="0.1" name="selling_price" class="form-control" value="{{ $data->selling_price }}" required>
                                            @error('selling_price')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label text-lg-end">Total Quantity <span class="text-danger">*</span></label>
                                        <div class="col-sm-3">
                                            <input type="number" step="0.1" name="quantity" class="form-control" value="{{ $data->quantity }}" required>
                                            @error('quantity')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Discount From</label>
                                        <div class="col-sm-3">
                                            <input type="datetime-local" name="discount_from" class="form-control" value="{{ $data->discount_from }}">
                                            @error('discount_from')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label text-end">Discount To</label>
                                        <div class="col-sm-3">
                                            <input type="datetime-local" name="discount_to" class="form-control" value="{{ $data->discount_to }}">
                                            @error('discount_to')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Discount Amount</label>
                                        <div class="col-sm-6">
                                            <input type="number" name="discount_price" class="form-control" value="{{ $data->discount_price }}">
                                            @error('discount_price')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="discount_type" class="form-select">
                                                <option value="flat" {{ $data->discount_type == 'flat' ? 'selected' : '' }}>Flat</option>
                                                <option value="percent" {{ $data->discount_type == 'percent' ? 'selected' : '' }}>Percent</option>
                                            </select>

                                            @error('discount_type')
                                                <p class="mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <h6>Product Description</h6>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div id="editor-container">
                                                {!! $data->description !!}
                                            </div>

                                            <!-- Hidden input to submit editor content -->
                                            <input type="hidden" name="description" id="content" value="" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Warranty</label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="warranty" id="inlineRadio1" value="1" {{ $data->warranty == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Active</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="warranty" id="inlineRadio2" value="0" {{ $data->warranty == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                            </div>
                                        </div>
                                        <label for="inputPhoneNo2" class="col-sm-2 col-form-label text-lg-end">Duration</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="warranty_duration" class="form-control" placeholder="6 Month/ 1 Year" value="{{ $data->warranty_duration }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">warranty Condition</label>
                                        <div class="col-sm-9">
                                            <div id="editor-container2">
                                                {!! $data->warranty_condition !!}
                                            </div>
                                            <input type="hidden" name="warranty_condition" id="content2" value="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="row mb-4">
                                        <label for="inputPhoneNo2" class="col-sm-6 col-form-label">Free Shipping</label>
                                        <div class="col-sm-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="is_free_shipping" value="yes" type="checkbox" id="flexSwitchCheckChecked" {{ $data->is_free_shipping == 'yes' ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputPhoneNo2" class="col-sm-6 col-form-label">Show Stock Qty</label>
                                        <div class="col-sm-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="show_stock_qty" value="yes" type="checkbox" id="flexSwitchCheckChecked" {{ $data->show_stock_qty == 'yes' ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputPhoneNo2" class="col-sm-6 col-form-label">Cash On Delivery</label>
                                        <div class="col-sm-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="cash_on_delivery" value="yes" type="checkbox" id="flexSwitchCheckChecked" {{ $data->cash_on_delivery == 'yes' ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-4">
                                        <label for="" class="col-sm-6 col-form-label">Low Stock Qty </label>
                                        <div class="col-sm-6">
                                            <input type="number" name="low_stock_qty" value="{{ $data->low_stock_qty }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-sm-6 col-form-label">Estimate Shipping Day </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="estimate_shipping_day" value="{{ $data->estimate_shipping_day }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" onclick="submitForm()" class="btn btn-dark px-5">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



@push('css')
    <!-- Include Quill CSS and JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <style>
        #editor-container,
        #editor-container2 {
            height: 200px;
        }
    </style>

    <style>
        .remove-button {
            cursor: pointer;
            color: rgb(255, 255, 255);
            font-weight: bold
        }
    </style>
@endpush
@push('js')
    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow', // Specify theme
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            }
        });
        var quill2 = new Quill('#editor-container2', {
            theme: 'snow', // Specify theme
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            }
        });

        function submitForm() {
            var content = quill.root.innerHTML;
            document.querySelector('#content').value = content;

            var content2 = quill2.root.innerHTML;
            document.querySelector('#content2').value = content2;
            var form = document.getElementById('myForm');

            if (form.checkValidity()) {
                // Form is valid, proceed with submission
                // document.getElementById('myForm').submit();
                form.submit();
            } else {
                // Optionally, show a custom alert or focus on the first invalid field
                alert('Please fill in all required fields.');
            }
        }
    </script>

    <!-- Script to add and remove rows dynamically -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add-button').click(function() {
                $('#product-details').append(`
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="single-select form-control" name="color[]">
                                <option value="" selected>Select Color</option>
                                @foreach ($colors as $item)
                                    <option value="{{ $item->code }}" style ="background:{{ $item->code }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="single-select form-control" name="size[]">
                                <option value="" selected>Select Size</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="qty[]" class="form-control" placeholder="qty">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-button">-</button>
                        </div>
                    </div>
                `);

                $(function() {
                    "use strict";

                    $('.single-select').select2({
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                    $('.multiple-select').select2({
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });


                });
            });


            // Remove the row when "remove" button is clicked
            $(document).on('click', '.remove-button', function() {
                $(this).closest('.row').remove();
            });
        });
    </script>
@endpush
