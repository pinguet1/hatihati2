<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupExpenseController;
use App\Http\Controllers\GroupUserController;
use App\Models\Expense;
use App\Models\Group;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::post('/expenses/{group}', [ExpenseController::class, 'store']);

Route::get('group/expenses/{expense}', [GroupExpenseController::class, 'show']);

Route::post('group/expenses/{expense}/payments/split', [GroupExpenseController::class, 'store']);

Route::get('payments/{payment}', function (Payment $payment) {

    return view('payments.show', ['payment'=>$payment]);

});

Route::post('payments/{payment}/mark-as-paid', function(Payment $payment, Request $request) {

    $path = $request->file('proof_of_payment')->store('payments');

    $payment->update([
        'is_paid'=>true,
        'proof_of_payment' => $path
    ]);

    return redirect()->back();
});
