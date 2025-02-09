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



    // Withdraw via SSLCommerz
    public function processWithdrawal($id)
    {
        $withdrawal = Withdrawal::where('id', $id)->where('status', 'approved')->firstOrFail();
        $customer = $withdrawal->customer;

        $paymentData = [
            'total_amount' => $withdrawal->amount,
            'currency' => "BDT",
            'tran_id' => uniqid(),
            'cus_name' => $customer->name,
            'cus_email' => $customer->email,
            'cus_phone' => $customer->phone,
            'success_url' => route('withdraw.success', $withdrawal->id),
            'fail_url' => route('withdraw.fail', $withdrawal->id),
            'cancel_url' => route('withdraw.cancel', $withdrawal->id),
        ];

        return SslCommerz::makePayment($paymentData);
    }

    // SSLCommerz Success
    public function withdrawalSuccess($id, Request $request)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->update([
            'status' => 'completed',
            'transaction_id' => $request->tran_id
        ]);

        return "Withdrawal Successful!";
    }

    // SSLCommerz Fail
    public function withdrawalFail($id)
    {
        return "Withdrawal Failed!";
    }

    // SSLCommerz Cancel
    public function withdrawalCancel($id)
    {
        return "Withdrawal Cancelled!";
    }
}
