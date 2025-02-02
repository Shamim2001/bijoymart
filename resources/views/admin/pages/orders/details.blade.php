@extends('admin.layouts.app')
@section('title')
    Edit Order
@endsection


@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="mb-0 text-uppercase">Products details</h6>
        </div>
        <div>
            <a class="btn btn-dark" href=""><i class="fadeIn animated bx bx-plus"></i> Add New</a>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col">
            <div class="card">
                {{-- @foreach ($order as $product) --}}
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Order No</label>
                        <div class="col-sm-9">

                            <input type="text"  class="form-control" placeholder="Product name">
                            @error('order_name')
                                <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>product id</th>
                                    <th>product name</th>
                                    <th>Unit price</th>
                                    <th>Product Qty</th>
                                    {{-- <th>Customer</th> --}}
                                    {{-- <th>Seller</th> --}}
                                    <th>Subtotal</th>
                                    <th>Payment status</th>
                                    <th>Delivery Status</th>
                                    {{-- <th>Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="select-row" value="{{ $orderdetails->id }}"></td>
                                        <td>{{ $orderdetails->product_id }}</td>
                                        <td>{{ $orderdetails->product_name }}</td>
                                        <td>{{ $orderdetails->sell_price }}</td>
                                        <td>{{ $orderdetails->quantity }}</td>
                                        <td>{{ $orderdetails->subtotal }}</td>
                                        <td>{{ $orderdetails->payment_status }}</td>
                                        <td>{{ $orderdetails->delivery_status }}</td>
                                        {{-- <td>{{ $order->OrderDetails->count() }}</td>
                                        <td>{{ $order->customer_name }} <br>{{ $order->customer_phone }} <br>{{ $order->shipping_address }}</td>
                                        <td>{{ $order->seller_id }}</td>
                                        <td>&#2547; {{ $order->total }}</td>
                                        <td>{{ $order->delivery_status }}</td>

                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning px-1" title="view" href="#"><i class="fadeIn animated bx bx-show-alt"></i></a>
                                            <a class="btn btn-sm btn-success px-1" title="download" href="#"><i class="fadeIn animated bx bx-download"></i></a>
                                        </td> --}}
                                    </tr>

                            </tbody>

                        </table>
                    </div>

                </div>
                {{-- @endforeach --}}
            </div>
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

@endpush
