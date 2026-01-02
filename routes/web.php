<?php

use App\Models\Group;
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

    request()->validate([
        'name'=>['required']
    ]);

    $group = \App\Models\Group::create([
        'name' => request('name')
    ]);

    //attach group to group_user pivot table

    Auth::user()->groups()->attach($group->id);

    //redirect back to home
    return redirect ('/');
});


Route::get('/', function () {


    $groups = Group::all();


    return view('home',['groups'=>$groups]);
});
