@extends('admin.layouts.app')
@section('title')
    All Products
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">All Products</h6>
        </div>
        <div>
            <a class="btn btn-dark" href="{{ route('admin.product.create') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Product</th>
                                    <th>Photo</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ singlePhoto(json_decode($product->thumbnail)) }}" alt="" style="width: 60px"></td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="is_free_shipping" value="yes" type="checkbox" id="updateStatus{{ $product->id }}" data-id="{{ $product->id }}" {{ $product->status == 'active' ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{ route('admin.product.edit', $product->id) }}"><i class="fadeIn animated bx bx-show-alt"></i></a>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.product.edit', $product->id) }}"><i class="fadeIn animated bx bx-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin.product.delete', $product->id) }}"><i class="fadeIn animated bx bx-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Add CSRF token to the headers for POST requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('.form-check-input').on('change', function() {
                var isChecked = $(this).is(':checked'); // Get checked status (true or false)
                // var checkboxId = $(this).attr('id'); // Get dynamic ID of the checkbox
                var itemId = $(this).data('id'); // Optionally send an item ID (or other data)

                $.ajax({
                    url: '{{ route('admin.product.update.status') }}', // URL to your route
                    type: 'POST',
                    data: {
                        status: isChecked, // Send checked status
                        id: itemId // Optionally send item ID
                    },

                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.warning(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
