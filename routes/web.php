<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return redirect('/');
});


Route::get('/', function () {
    return view('home');
});
