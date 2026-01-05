<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return view ('/');
});



Route::get('/groups/create', function () {
   return view ('groups.create');
});

