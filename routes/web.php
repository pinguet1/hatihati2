<?php

use App\Http\Controllers\GroupController;
use App\Models\Expense;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return redirect ('/');
});

Route::get('/', [GroupController::class, 'index']);
Route::post('/groups', [GroupController::class, 'store']);
Route::get('group/{group}', [GroupController::class, 'show']);
Route::get('/groups/create', [GroupController::class,'create']);

Route::post('/expenses', function () {

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
});

