<?php

namespace App\Http\Controllers\Backend;

use App\Models\Withdrawal;
use SSLCommerz\SSLCommerz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{
    public function index()
    {
        // Withdrawal request list
        $withdrawals = Withdrawal::latest()->paginate(10);

        return view('admin.pages.withdraw.index', compact('withdrawals'));
    }

    public function edit($id)
    {

        $withdraw = Withdrawal::findOrFail($id);

        return view('admin.pages.withdraw.edit', compact('withdraw'));
    }

    public function approveWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->update(['status' => 'approved']);

        // Initiate payment via SSLCommerz
        // $sslcommerz = new SSLCommerz();

        $paymentData = [
            'store_id' => config('sslcommerz.store_id'),
            'store_password' => config('sslcommerz.store_password'),
            'total_amount' => $withdrawal->amount,
            'currency' => 'BDT',
            'tran_id' => uniqid(), // Unique transaction ID
            'success_url' => route('admin.withdraw.success', $withdrawal->id),
            'fail_url' => route('admin.withdraw.fail', $withdrawal->id),
            'cancel_url' => route('admin.withdraw.cancel', $withdrawal->id),
            'cus_name' => $withdrawal->customer->name,
            'cus_email' => $withdrawal->customer->email,
            'cus_phone' => $withdrawal->customer->phone,
        ];
        // dd($paymentData);

        // $sslcommerz->initiatePayment($paymentData);
    }


    public function withdrawSuccess(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->update([
            'status' => 'completed',
            'transaction_id' => $request->tran_id
        ]);

        return "Withdrawal Successful!";
        // $sslcommerz = new SSLCommerz();
        // $validation = $sslcommerz->validatePayment($request->all());

        // if ($validation) {
        //     $transactionId = $request->input('tran_id');
        //     $withdrawal = Withdrawal::where('transaction_id', $transactionId)->first();

        //     if ($withdrawal) {
        //         $withdrawal->update(['status' => 'paid']);
        //         return response()->json(['status' => 'success']);
        //     }
        // }

        // return response()->json(['status' => 'failed']);
    }
}
