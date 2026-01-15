<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Group;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store (Group $group)
    {
        request()->validate([
            'description'=> 'required',
            'amount'=>'required',
        ]);

        Expense::create([
            'description' =>request('description'),
            'amount' => request('amount'),
            'user_id' => auth()->id(),
            'group_id' => $group->id
        ]);

        return redirect()->back();
    }
}
