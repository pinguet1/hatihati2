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

        $existingPayments = Payment::where('expense_id', $expense->id)->get();

        foreach ($existingPayments as $existingPayment) {
            if (
                ! in_array( $existingPayment->user_id, $selectedUsersID)
            ){
                $existingPayment->delete();
            }
        }

        foreach ($selectedUsersID as $userID)
        {
            //if user has splitamount in the same expense then do not give him another split amount
            $existingPayment = Payment::where('expense_id', $expense->id)->where('user_id', $userID)->first();

            if (! $existingPayment)
            {
                Payment::create([
                    'split_amount' => $splitAmount,
                    'is_paid' => false,
                    'user_id' => $userID,
                    'expense_id' => $expense->id
                ]);
            }
            else {
                $existingPayment->update([
                   'split_amount' => $splitAmount
                ]);
            }
        }

        return redirect()->back();
    }
}
