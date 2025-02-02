<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function allOrders()
    {
        // $orderdetails = OrderDetails::all();
        $orders = Order::with('OrderDetails')->get();
        $colorMap = [
            1 => 'Green',
            2 => 'blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'merun',
        ];
        // dd($orders);
        return view('admin.pages.orders.allorders', compact('orders','colorMap'));
    }

    public function editstatus($id) {
        // Fetch the order with the given ID and its details
        $order = Order::with('OrderDetails')->findOrFail($id);

        // Color map definition
        $colorMap = [
            1 => 'Green',
            2 => 'Blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'Maroon',
        ];

        // dd($order);
        // dd($order->delivery_status);
        // Pass the specific order and color map to the view
        return view('admin.pages.orders.editstatus', compact('order', 'colorMap'));
    }


    public function updateStatus(Request $request, $id)
    {
        // Find the order
        $order = Order::findOrFail($id);

        // Validate the request
        $request->validate([
            'delivery_status' => 'required',
        ]);

        // Update the delivery_status
        $updated = $order->update([
            'delivery_status' => $request->input('delivery_status'),
        ]);

        // Debug if the update worked
        if ($updated) {
            // Refresh the order instance
            $order = $order->fresh(); // Get a new instance from the database
            // dd($order->delivery_status);
        } else {
            dd('Update failed');
        }

        // Redirect back with a success message
        return redirect()->route('admin.order.allOrders')->with('success', 'Delivery status updated successfully!');
    }


    public function pendingOrder() {
        $orders = Order::with('OrderDetails')
        ->where('delivery_status', 'Pending') // Filter orders with 'Pending' status
        ->get();

        $colorMap = [
            1 => 'Green',
            2 => 'Blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'Merun',
        ];

        return view('admin.pages.orders.pendingorder', compact('orders', 'colorMap'));
    }


    public function approvedOrder() {
        $orders = Order::with('OrderDetails')
        ->where('delivery_status', 'Approved') // Filter orders with 'Pending' status
        ->get();

        $colorMap = [
            1 => 'Green',
            2 => 'Blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'Merun',
        ];

        return view('admin.pages.orders.approvedorder', compact('orders', 'colorMap'));
    }


    public function shippingOrder() {
        $orders = Order::with('OrderDetails')
        ->where('delivery_status', 'Shipping') // Filter orders with 'Pending' status
        ->get();

        $colorMap = [
            1 => 'Green',
            2 => 'Blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'Merun',
        ];

        return view('admin.pages.orders.shippingorder', compact('orders', 'colorMap'));
    }

    public function deliveredOrder() {
        $orders = Order::with('OrderDetails')
        ->where('delivery_status', 'Delivered') // Filter orders with 'Pending' status
        ->get();

        $colorMap = [
            1 => 'Green',
            2 => 'Blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'Merun',
        ];

        return view('admin.pages.orders.deliveredorder', compact('orders', 'colorMap'));
    }

    public function cancelledOrder() {
        $orders = Order::with('OrderDetails')
        ->where('delivery_status', 'Cancelled') // Filter orders with 'Pending' status
        ->get();

        $colorMap = [
            1 => 'Green',
            2 => 'Blue',
            3 => 'Black',
            4 => 'DarkSalmon',
            5 => 'LightSalmon',
            6 => 'Crimson',
            7 => 'Red',
            8 => 'FireBrick',
            9 => 'DarkRed',
            10 => 'Pink',
            11 => 'Navy Blue',
            12 => 'Merun',
        ];

        return view('admin.pages.orders.cancelledorder', compact('orders', 'colorMap'));
    }










    public function inHouseOrders() {}
    public function sellerOrders() {}
}
