<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return redirect('/');
});

Route::get('/groups/create', function () {
   return view ('groups.create');
});

Route::post('/groups', function () {
    //add group to the database
    \App\Models\Group::create([
        'name' => request()->validate
    ]);

    //attach group to group_user pivot table
    //redirect back to home
    return redirect ('/');
});
Route::get('/', function () {
    return view('home');
});
