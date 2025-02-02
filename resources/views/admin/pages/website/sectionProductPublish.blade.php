@extends('admin.layouts.app')
@section('title')
    All Products
@endsection
@push('css')
    <style>
        .form-check-input {
            height: 1.3em;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">All Products</h6>
        </div>
        <div>
            {{-- <a class="btn btn-dark" href="{{ route('admin.product.create') }}"><i class="fadeIn animated bx bx-plus"></i> Add New</a> --}}
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
                                    <th style="width: 65px">Photo</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    @foreach ($sections as $sec)
                                        <th>{{ $sec->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ singlePhoto(json_decode($product->thumbnail)) }}" alt="" style="width: 60px"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        @foreach ($sections as $sec)
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="{{ $sec->id }}" value="yes" type="checkbox" id="updateStatus{{ $product->id }}" data-id="{{ $product->id }}" {{ getSectionProductStatus($sec->id, $product->id) }}>
                                                </div>
                                            </td>
                                        @endforeach

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    {{-- <button type="button" id="updateSelected" class="btn btn-primary mt-3">Update Selected</button> --}}
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
                var secId = $(this).attr('name'); // Get dynamic ID of the checkbox
                var itemId = $(this).data('id'); // Optionally send an item ID (or other data)

                $.ajax({
                    url: '{{ route('admin.section.product.update.status') }}', // URL to your route
                    type: 'POST',
                    data: {
                        status: isChecked, // Send checked status
                        secId: secId,
                        pid: itemId // Optionally send item ID
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

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#example').DataTable();

            // Handle Select All Checkbox
            $('#selectAll').on('click', function() {
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"].select-row', rows).prop('checked', this.checked);
            });

            // Handle Row Checkbox Selection
            $('#example tbody').on('change', '.select-row', function() {
                if (!this.checked) {
                    var el = $('#selectAll').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });

            // // Handle Update Button Click (AJAX Request)
            // $('#updateSelected').on('click', function() {
            //     var selectedIds = [];
            //     // Get all selected checkboxes
            //     $('.select-row:checked').each(function() {
            //         selectedIds.push($(this).val());
            //     });

            //     if (selectedIds.length === 0) {
            //         toastr.warning('No rows selected!');
            //         return;
            //     }

            //     // Send AJAX request with selected IDs
            //     $.ajax({
            //         url: '{{ route('admin.product.review') }}', // Update with your route
            //         type: 'POST',
            //         data: {
            //             ids: selectedIds
            //         },
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 toastr.success('Selected rows updated successfully!');
            //             } else {
            //                 toastr.error('Failed to update selected rows.');
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             toastr.error('An error occurred: ' + xhr.responseText);
            //         }
            //     });
            // });
        });
    </script>
@endpush
