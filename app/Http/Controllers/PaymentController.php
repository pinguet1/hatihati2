<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create (Payment $payment)
    {
        return view('payments.show', ['payment'=>$payment]);
    }

    public function store (Payment $payment, Request $request)
    {
        $path = $request->file('proof_of_payment')->store('payments');

        $payment->update([
            'is_paid'=>true,
            'proof_of_payment' => $path
        ]);

        return redirect()->back();
    }
}
