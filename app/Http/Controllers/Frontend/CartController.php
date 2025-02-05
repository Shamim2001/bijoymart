<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use GrahamCampbell\ResultType\Result;
use App\Http\Controllers\Controller;
use App\Models\AllSetting;
use App\Models\Category;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_items = \Cart::getContent()->sort();
        return view('frontend.cart.index', compact('cart_items'));

        // return $cart_items;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $product = Product::find($request->productId);

        // new

        if ($product) {
            // Calculate the main price based on discount type
            if ($product->discount_type === 'flat') {
                $product->main_price = $product->selling_price - $product->discount_price;
            } elseif ($product->discount_type === 'percent') {
                $product->main_price = $product->selling_price - ($product->selling_price * ($product->discount_price / 100));
            } else {
                $product->main_price = $product->selling_price;
            }
        } else {
            // Product not found
            return abort(404, 'Product not found');
        }




        //end new
        if (count(json_decode($product->size)) > 0 && $request->size == '') {
            return response()->json([
                'status'    => 0,
                'message'   => 'The product size is required!'
            ]);
        }
        if (count(json_decode($product->color)) > 0 && $request->color == '') {
            return response()->json([
                'status'    => 0,
                'message'   => 'The product Color is required!'
            ]);
        }
        $price = productPrice($product->id);
        // $qty = collect($request->size)->crossJoin($request->color);

        if ($request->ajax()) {
            Cart::add(array(
                'id'      => $product->id,
                'name'    => $product->name,


                // 'price'   => $price,
                'price'   => $product->main_price,


                'qty'     => $request->qty,
                'weight'  => $product->weight,
                'options' => array(
                    'thumbnail' => $product->thumbnail,
                    'slug' => $product->slug,
                    'size' => $request->size,
                    'color' => $request->color,
                )
            ));
            return response()->json([
                'status'    => 1,
                'message'   => 'The product added successfully'
            ]);
        } else {
            Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,


                // 'price' => $price,
                'price'   => $product->main_price,


                'qty' => $request->qty,
                'weight' => $product->weight,
                'options' => array(
                    'thumbnail' => $product->thumbnail,
                    'slug' => $product->slug,
                    'size' => $request->size,
                    'color' => $request->color,
                )
            ));
            return redirect()->back();
        }
    }

    public function store_from_icon(Request $request)
    {




        if ($request->ajax()) {
            $product = Product::find($request->productId);

            if ($product) {
                // Calculate the main price based on discount type
                if ($product->discount_type === 'flat') {
                    $product->main_price = $product->selling_price - $product->discount_price;
                } elseif ($product->discount_type === 'percent') {
                    $product->main_price = $product->selling_price - ($product->selling_price * ($product->discount_price / 100));
                } else {
                    $product->main_price = $product->selling_price;
                }
            } else {
                // Product not found
                return abort(404, 'Product not found');
            }


            $price = productPrice($product->id);

            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,


                // 'price' => $price,
                'price' => $product->main_price,



                'qty' => 1,
                'weight' => $product->weight,
                'options' => array(
                    'thumbnail' => $product->thumbnail,
                    'slug' => $product->slug
                )
            ));
            return response()->json([
                'message' => 'Product added successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //just totally replace the quantity instead of incrementing or decrementing
        // \Cart::update($id, array(
        //     'quantity' => array(
        //         'relative' => false,
        //         'value' => $request->quantity,
        //     ),
        // ));
        Cart::update($request->rowId, $request->qty);
        // return redirect()->back();

        $item = Cart::get($request->rowId);
        return response()->json([
            'status'    => 1,
            'total' => $item->price * $item->qty,
            'subtotal' => number_format((float) str_replace(',', '', Cart::subtotal()), 2),
            'subtotalsum' => number_format((float) str_replace(',', '', Cart::subtotal()) + 100, 2),
            'message'   => 'The product updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function removeall()
    {
        Cart::clear();
        return redirect()->back();
    }

    public function load_cart_item()
    {
        return view('frontend.cart.load_cart_item');
    }

    public function orderStore(Request $request)
    {


        $request->validate([
            "payment_type" => "required|string",
            "name"         => "required|string",
            "phone"        => "required",
            "address"      => "required|string"
        ]);


        DB::beginTransaction();
        try {
            $setting = AllSetting::first();


            // $customerIds = Customer::pluck('id');
            // $customer = Customer::get()->toArray();
            // $customerId = Customer::where('id', $id)->value('id');

            // dd($customerIds);

            // dd(gettype( (int) $request->customer_id));
            // $customer = Customer::where('id', $request->customer_id)->first();
            $customer = Customer::find($request->customer_id);


            $deliveryCharge = $request->delivery_charge == 'inside' ? $setting->d_charge_inside_dhaka : $setting->d_charge_outside_dhaka;
            $orders = Order::get();
            $gtotal = (float) str_replace(',', '', Cart::subtotal());


            $order = Order::create([
                // "user_id"               => $customerIds,
                "user_id"               => Auth::check() ? Auth::id() : 1,
                "order_no"              => date('ymdHis') . rand(100, 999),
                "customer_name"         => $request->name,
                "customer_phone"        => $request->phone,
                "shipping_address"      => $request->address,
                "delivery_status"       => 'Pending',
                "payment_type"          => $request->payment_type,
                "payment_status"        => $request->payment_type == 'cash' ? 'Cash On Delivery' : 'Others',
                "grand_total"           => $gtotal,
                "delivery_charge"       => $deliveryCharge,
                "total"                 => $gtotal + $deliveryCharge,
                "discount"              => 0,
                "tracking_code"         => date('ymd') . $orders->count() + 1 . date('His'),
                "date"                  => date('Y-m-d'),
                "customer_id"           => $customer->id ?? null,
            ]);

            // dd($order->total);

            // Check if this user was referred
            if (!empty($customer->referral_by)) {
                // dd($customer->referral_by);
                $referrer = Customer::find( $customer->referral_by);
                // dd($referrer);
                if ($referrer) {
                    // Get the first 4 people referred by this referrer (in order)
                    $referredUsers = Customer::where('referral_by', $referrer->id)
                        ->orderBy('created_at', 'asc')
                        ->take(3)
                        ->get();

                    $totalReferred = $referredUsers->count();


                     // If at least 4 referred users exist, apply the commission percentage
                     if ($totalReferred >= 3) {

                        $totalCommission = round($order->total * 0.10); // 10% of total amount, rounded

                        // Calculate and round individual commissions
                        $commissions = [
                            // round($totalCommission * 0.05), // 5%
                            round($totalCommission * 0.15), // 15%
                            round($totalCommission * 0.30), // 30%
                            round($totalCommission * 0.50), // 50%
                        ];

                        // Additional 5% commission for the original referrer
                        $referrerCommission = round($totalCommission * 0.05); // 5% of total commission
                        $referrer->increment('referral_balance', $referrerCommission);

                        // Distribute commissions
                        $referredUsers[0]->increment('referral_balance', $commissions[0]); // 1st user
                        $referredUsers[1]->increment('referral_balance', $commissions[1]); // 2nd user
                        $referredUsers[2]->increment('referral_balance', $commissions[2]); // 3rd user
                        // $referredUsers[3]->increment('referral_balance', $commissions[3]); // 4th user


                    }
                }
            }

            // // Referral Commission Logic (if customer was referred)
            // if ($customer->referral_by) {
            //     $referrer = Customer::find($customer->referral_by);

            //     if ($referrer && $order->total >= 1000) {
            //         // Count how many people this referrer has referred
            //         $referralCount = Customer::where('referral_by', $referrer->id)->count();
            //         // dd($referralCount);
            //         if ($referralCount < 4) {
            //             // First 4 referred users get 100 TK commission
            //             $referrer->increment('referral_balance', 100);
            //         } elseif ($referralCount == 4) {
            //             // 5th referred user gets 50 TK commission
            //             $referrer->increment('referral_balance', 50);
            //         }
            //         // 6th and beyond get no commission
            //     }
            // }




            // dd(Auth::id());

            foreach (\Cart::content() as $product) {
                $pDetails = Product::find($product->id);
                OrderDetails::create([
                    "order_id"         => $order->id,
                    "seller_id"        => $pDetails->user_id,
                    "product_id"       => $product->id,
                    "product_name"     => $product->name,
                    "product_price"    => $pDetails->selling_price,
                    "sell_price"       => $product->price,
                    "product_discount" => productDiscount($product->id) * $product->qty,
                    "quantity"         => $product->qty,
                    "size"             => $product->options->size,
                    "color"            => $product->options->color,
                    "subtotal"         => $product->subtotal,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        \Cart::destroy();
        return redirect()->route('order.success', $order->order_no);
    }





    public function orderSuccess($orderNo)
    {
        return view('frontend.customer.order-success', compact('orderNo'));
    }
}
