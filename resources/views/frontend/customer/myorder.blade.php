@extends('frontend.components.layout')

@section('title')
    My Order
@endsection

@section('topmenu')
    @include('frontend.components.topmenu')
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Order</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                @include('frontend.customer.leftmenu')
                <div class="col-lg-9 order-lg-last dashboard-content">
                    {{-- <h2>My Order</h2> --}}
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Order No</th>
                                                    <th>Tracking Code</th>
                                                    <th>Date</th>
                                                    <th>Customer info</th>
                                                    <th>Payment</th>
                                                    <th>Payment Status</th>
                                                    <th>Total</th>
                                                    <th>Delivery Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    @if ($order->customer_phone === $customer->phone)
                                                        <tr>
                                                            <td>{{ $order->order_no }}</td>
                                                            <td>{{ $order->tracking_code }}</td>
                                                            <td>{{ $order->date }}</td>
                                                            <td>{{ $order->customer_name }} <br>
                                                                {{ $order->customer_phone }} <br>
                                                                {{ $order->shipping_address }}
                                                            </td>
                                                            <td>{{ $order->payment_type }}</td>
                                                            <td>{{ $order->payment_status }}</td>
                                                            <td>{{ $order->total }}</>
                                                            <td>{{ $order->delivery_status }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    {{-- <button type="button" id="updateSelected" class="btn btn-primary mt-3">Update Selected</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

@endsection
