<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Division;
use App\Models\Shipping;
use App\Models\Wishlist;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomerController extends Controller
{
    public function login_form()
    {
        if (session('customer_id')) {
            return redirect()->route('customer.myaccount');
        } else {
            return view('frontend.customer.login');
        }
    }

    public function login(Request $request)
    {

        $request->validate([
            'phone_email'    => is_numeric($request->phone_email) ? 'required|numeric|digits:11' : 'required|email:rfc,dns',
            'password' => 'required|min:6|max:20'
        ]);

        $customer = Customer::where('phone', $request->phone_email)->orWhere('email', $request->phone_email)->first();

        if ($customer) {
            if (password_verify($request->password, $customer->password)) {
                $request->session()->put('customer_id', $customer->id);
                $request->session()->put('customer_name', $customer->name);
                return redirect()->route('customer.myaccount');
            } else {
                session()->flash('login_error', 'These Credentials do not match with records');
                return redirect()->back();
            }
        }
    }

    public function register_form(Request $request)
    {
        // Get referrer code from URL
        $referrerCode = $request->query('ref');
        if (session('customer_id')) {
            return redirect()->route('customer.myaccount');
        } else {
            return view('frontend.customer.register', compact('referrerCode'));
        }
    }

    public function register(Request $request)
    {
        // dd($request->check);
        $request->validate([
            'name'     => 'required|string|min:4|max:30|regex:/^[\pL\s\-]+$/u',
            'email'    => 'email:rfc,dns|unique:customers',
            'phone'    => 'required|numeric|unique:customers|digits:11',
            'password' => 'required|min:6|max:20'
        ]);
        try {
            $customer = Customer::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => bcrypt($request->password),
                'offer_mail' => $request->check ? $request->check : 0,
                'referral_code' => $this->generateReferCode($request->name),
                'referral_by' => $request->referral_by ? Customer::where('referral_code', $request->referral_by)->first()->id : null,
            ]);
            $data = [
                'name' => $customer->name,
                'email' => $customer->email,
            ];




            // Mail::to($customer->email)->send(new WelcomeMail($data));

            session()->flash('type', 'success');
            session()->flash('message', 'Registration Success');
        } catch (Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getmessage());
        }
        return redirect()->back();
    }

    // Function to generate affiliate codes
    function generateReferCode($name)
    {
        $namePart = strtoupper(Str::slug($name, ''));
        $randomPart = strtoupper(Str::random(5));
        return $namePart . $randomPart;
    }



    public function logout()
    {
        session()->forget('customer_id');
        session()->forget('customer_name');
        // \Cart::clear();
        return redirect()->route('customer.login');
    }



    public function myaccount()
    {
        $c_d_address = CustomerDetails::where([
            ['customer_id', session('customer_id')],
            ['billing_address', 1],
        ])->first();

        $c_s_address = CustomerDetails::where([
            ['customer_id', session('customer_id')],
            ['shipping_address', 1],
        ])->first();

        $customer = Customer::find(session('customer_id'));

        // $user = Auth::user(); // Get the currently authenticated user
        // $userId = $user->id;
        // return view('frontend.customer.myaccount', compact('c_d_address', 'c_s_address', 'customer','user'));


        return view('frontend.customer.myaccount', compact('c_d_address', 'c_s_address', 'customer'));
    }


    public function address_book()
    {
        $customer_address = CustomerDetails::where('customer_id', session('customer_id'))->get();
        $customer = Customer::find(session('customer_id'));
        return view('frontend.customer.addressbook', compact('customer_address', 'customer'));
    }



    public function addtolist(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->id;
            $customer_id = session('customer_id');
            if ($customer_id) {
                $customer_exist = Wishlist::where('customer_id', $customer_id)->first();
                if ($customer_exist) {
                    $product_id = Wishlist::where('product_id', $product_id)->first();
                    if ($product_id) {
                        return response()->json([
                            'status' => '2',
                            'message' => 'The product you added earlier',
                        ]);
                    } else {
                        Wishlist::create([
                            'customer_id' => session('customer_id'),
                            'product_id'  => $request->id,
                        ]);
                        return response()->json([
                            'status' => '1',
                            'message' => 'successfully Added in your Wish List',
                        ]);
                    }
                } else {
                    Wishlist::create([
                        'customer_id' => session('customer_id'),
                        'product_id'  => $request->id
                    ]);
                    return response()->json([
                        'status' => '1',
                        'message' => 'successfully Added in your Wish List'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => '0',
                    'message' => 'Please login First',
                ]);
            }
        }
    }


    // main
    public function wishlist($phone)
    {
        $wishlist = Wishlist::where('customer_id', session('customer_id'))->pluck('product_id');
        $product = Product::wherein('id', $wishlist)->get(['id', 'name', 'slug', 'selling_price','discount_price', 'thumbnail']);
        $customer = Customer::where('phone', $phone)->first();


        // dd($product);

        return view('frontend.customer.wishlist', compact('product','customer'));
    }

    public function add_wishlist_to_cart(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->productId);

            if ($product->special_price != '' && $product->special_price != 0) {
                if ($product->special_price_from <= date('Y-m-d') && date('Y-m-d') <= $product->special_price_to) {
                    $price = $product->special_price;
                } else {
                    $price = $product->selling_price;
                }
            } else {
                $price = $product->selling_price;
            }

            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' => 1,
                'attributes' => array(
                    'thumbnail' => $product->thumbnail,
                    'slug' => $product->slug
                )
            ));
            return response()->json([
                'message' => 'Product added successfully'
            ]);
        }
    }

    public function clearwishlist(Request $request)
    {
        Wishlist::where([
            ['customer_id', session('customer_id')],
            ['product_id', $request->productId],
        ])->delete();

        return back()->with('success', 'Product removed from wishlist');
    }



    public function load_wishlist_item(Request $request)
    {
        $wishlist = Wishlist::where('customer_id', session('customer_id'))->pluck('product_id');
        $product = Product::wherein('id', $wishlist)->get(['id', 'name', 'slug', 'selling_price', 'special_price', 'special_price_from', 'special_price_to', 'thumbnail']);
        return view('frontend.customer.reloadwishlist', compact('product'));
    }

    public function checkout()
    {
        $categories = Category::where('root', Category::categoryRoot)->get();
        $customer = Customer::find(session('customer_id'));

        if (Cart::content()->count() > 0) {
            return view('frontend.customer.checkout', compact('categories','customer'));
        } else {
            session()->flash('message', "Please Add prduct in your Cart then try again");
            return redirect()->back();
        }
    }

    public function shipping(Request $request)
    {
        $request->validate([
            "division" => 'required|string',
            "district" => "required|string",
            "thana"    => "required|string",
            "address"  => "required|string|min:10|max:255",
            "name"     => "required|string|min:6|max:40",
            "phone"    => "required|digits:11",
        ]);

        try {
            $shipping = Shipping::create([
                "name"     => $request->name,
                "phone"    => $request->phone,
                "division" => $request->division,
                "district" => $request->district,
                "thana"    => $request->thana,
                "address"  => $request->address
            ]);
            session()->put('shipping_id', $shipping->id);
            return redirect()->route('customer.review.payment');
        } catch (Exception $ex) {
            session()->flash('status', 'danger');
            session()->flash('message', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function review_payment()
    {
        $shipping = Shipping::find(session('shipping_id'));
        return view('frontend.customer.reviewpayment', compact('shipping'));
    }

    public function store_review_payment(Request $request)
    {
        $request->validate([
            "payment_type" => "required|string"
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                "order_no" => date('ymdhms') . rand(100, 999),
                "customer_id" => session('customer_id'),
                "shipping_id" => session('shipping_id'),
                "total"       => \Cart::getSubTotal()
            ]);

            foreach (\Cart::content() as $item) {
                OrderDetails::create([
                    "order_id"      => $order->id,
                    "product_id"    => $item->id,
                    "product_name"  => $item->name,
                    "product_price" => $item->price,
                    "quantity"      => $item->quantity,
                    // "size"          => $item->attributes->size,
                    // "color"         => $item->attributes->color,
                ]);
            }

            Payment::create([
                "order_id" => $order->id,
                "payment_type" => $request->payment_type,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        \Cart::clear();
        return redirect()->route('customer.myorder');
    }




    public function myorder($phone)
    {
        // Retrieve customer by phone number
        $customer = Customer::where('phone', $phone)->first();
        // $orders = Order::all();
        $orders = Order::orderByRaw("FIELD(delivery_status, 'Pending', 'Approved', 'Shipping' , 'Delivered' , 'Cancelled')")->get();

        // dd($orders);
        // Check if customer exists before accessing their phone
        if ($customer) {
            return view('frontend.customer.myorder', compact('customer','orders'));
        }
    }









    // main
    // public function myorder()
    // {

    //     $customer_id = session('customer_id');
    //     $orders = Order::with('order_details')->where('customer_id', $customer_id)->orderBy('id', 'desc')->get();

    //     #product preview
    //     $order_ids = Order::with('order_details')->where('customer_id', $customer_id)->pluck('id');
    //     $product_prev = OrderDetails::with('products', 'order')->whereIn('order_id', $order_ids)->get();
    //     dd($order_ids,$product_prev);

    //     return view('frontend.customer.myorder', compact('orders', 'product_prev'));
    // }







    public function address_form()
    {

        $division = Division::select('division')->get()->unique('division');

        return view('frontend.customer.address', compact('division'));
    }

    public function data(Request $request)
    {
        if ($request->name == 'district') {
            $data = Division::select('district')->where('division', $request->value)->get()->unique('district');
        } else {
            $data = Division::select('thana')->where('district', $request->value)->get()->unique('thana');
        }
        return $data;
    }

    public function save_address(Request $request)
    {


        $request->validate([
            "division"     => 'required|string',
            "district"     => "required|string",
            "thana"        => "required|string",
            "address"      => "required|string|min:10|max:255",
            "name"         => "required|string|min:6|max:40",
            "phone"        => "required|digits:11",
        ]);

        $cus_address = count(CustomerDetails::where('customer_id', session('customer_id'))->get());
        if ($cus_address < 3) {
            try {
                CustomerDetails::create([
                    "customer_id"      => session('customer_id'),
                    "full_name"        => $request->name,
                    "division"         => $request->division,
                    "district"         => $request->district,
                    "thana"            => $request->thana,
                    "address"          => $request->address,
                    "phone"            => $request->phone,
                ]);
                session()->flash('status', 'success');
                session()->flash('message', 'Address added Successfully');
                return redirect()->route('customer.addressbook');
            } catch (Exception $ex) {
                session()->flash('status', 'danger');
                session()->flash('message', $ex->getMessage());
                return redirect()->back();
            }
        } else {
            session()->flash('status', 'danger');
            session()->flash('message', 'Sorry! You already added 3 address');
            return redirect()->back();
        }
    }

    public function default_address(Request $request)
    {

        // dd($request->all());
        if ($request->address == 'shipping_address') {
            $request->validate([
                'address' => 'required|string',
                's_address' => 'required|numeric'
            ]);
            $check_active = CustomerDetails::where('customer_id', session('customer_id'))->where('shipping_address', 1)->first();
            if ($check_active) {
                $check_active->shipping_address = 0;
                $check_active->update();

                try {
                    $c_s_address = CustomerDetails::find($request->s_address);
                    $c_s_address->shipping_address = 1;
                    $c_s_address->update();

                    return redirect()->back();
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                try {
                    $c_s_address = CustomerDetails::find($request->s_address);
                    $c_s_address->shipping_address = 1;
                    $c_s_address->update();

                    return redirect()->back();
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        } else {
            $request->validate([
                'address' => 'required|string',
                'b_address' => 'required|numeric'
            ]);
            $check_active = CustomerDetails::where('customer_id', session('customer_id'))->where('billing_address', 1)->first();
            if ($check_active) {
                $check_active->billing_address = 0;
                $check_active->update();

                try {
                    $c_b_address = CustomerDetails::find($request->b_address);
                    $c_b_address->billing_address = 1;
                    $c_b_address->update();

                    return redirect()->back();
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                try {
                    $c_b_address = CustomerDetails::find($request->b_address);
                    $c_b_address->billing_address = 1;
                    $c_b_address->update();

                    return redirect()->back();
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
    }
}
