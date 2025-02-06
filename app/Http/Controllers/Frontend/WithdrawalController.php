<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function withdrawal(Customer $customer)
    {
        return view('frontend.customer.withdrawal', compact('customer'));
    }

    public function requestWithdrawal(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        $customer = Customer::find($request->customer_id);



        if ($customer->referral_balance < $request->amount) {
            return back()->with('error', 'Insufficient balance!');
        }

        // Deduct balance & create withdrawal request
        $customer->decrement('referral_balance', $request->amount);

        Withdrawal::create([
            'customer_id' => $customer->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Withdrawal request submitted successfully!');
    }
}
