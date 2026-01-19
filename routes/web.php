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

Route::post('/payments', function (Payment $payment){

    request()->validate([
        'split_amount' => 'required'
    ]);

    Payment::create([
        'split_amount' => request('split_amount'),
        'is_paid' => request ('is_paid', false),
        'user_id' => $payment->user->id,
        'expense_id' => $payment->expense->id


    ]);
});
