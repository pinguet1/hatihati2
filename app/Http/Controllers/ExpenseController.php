<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store ()
    {
        request()->validate([
            'description'=> 'required',
            'amount'=>'required',
        ]);

        Expense::create([
            'description' =>request('description'),
            'amount' => request('amount'),
            'paid_by' => auth()->id()
        ]);

        return redirect()->back();
    }
}
