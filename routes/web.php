<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return redirect('/');
});

Route::post('/groups/create', function () {
    //add group to the database
    \App\Models\Group::create([
        'name' => request()->validate
    ]);
    //attach group to group_user pivot table
    //redirect back to home

});
Route::get('/', function () {
    return view('home');
});
