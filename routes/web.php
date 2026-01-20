<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupUserController;
use App\Models\Expense;
use App\Models\Group;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return redirect ('/');
});

Route::get('/signin/mich', function () {
    auth()->login(User::find(2));
    return redirect ('/');
});

Route::get('/', [GroupController::class, 'index']);
Route::post('/groups', [GroupController::class, 'store']);
Route::get('group/{group}', [GroupController::class, 'show']);
Route::get('/groups/create', [GroupController::class,'create']);
Route::post('/group/{group}/people', [GroupUserController::class,'create']);

Route::post('/expenses/{group}', [\App\Http\Controllers\ExpenseController::class, 'store']);

Route::get('group/expenses/{expense}', function (Expense $expense) {

    $group = Group::whereAttachedTo(auth()->user())->get();
    $expenses = Expense::whereBelongsTo($group)->get();

    //dd($expenses);
    return view('expenses.show',
        ['expenses'=>$expenses,
            'expense'=>$expense]);
});

Route::post('group/expenses/{expense}/payments/split', function (Expense $expense){

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
});

Route::get('payments/{payment}', function (Payment $payment) {

    return view('payments.show', ['payment'=>$payment]);

});

Route::post('payments/{payment}/mark-as-paid', function(Payment $payment) {
    if (request('proof_of_payment')) {
        request('proof_of_payment')->store('payments');
    }

    $payment->update([
        'is_paid'=>true
    ]);

    return redirect()->back();
});
