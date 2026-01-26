<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Group;
use App\Models\Payment;
use Illuminate\Http\Request;

class GroupExpenseController extends Controller
{
    public function show (Expense $expense)
    {
        $group = Group::whereAttachedTo(auth()->user())->get();
        $expenses = Expense::whereBelongsTo($group)->get();

        return view('expenses.show',
            ['expenses'=>$expenses,
                'expense'=>$expense]);
    }

    public function store (Expense $expense)
    {
        $selectedUsersID = request('users');

        $splitAmount = $expense->amount/count($selectedUsersID);

        foreach ($selectedUsersID as $userID)
            Payment::create([
                'split_amount' => $splitAmount,
                'is_paid' => false,
                'user_id' => $userID,
                'expense_id' => $expense->id
            ]);

        return redirect()->back();
    }
}
