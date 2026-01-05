<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/signin/angello', function () {
    auth()->login(User::find(1));
    return redirect ('/');
});

Route::get('/', function (){

    $groups = Group::whereAttachedTo(
        Auth::user())->get();

   return view ('home', ['groups' => $groups]) ;
});

Route::post('/groups', function  (){

    request()->validate([
       'name' => 'required'
    ]);

    $group = Group::create([
       'name' => request('name')
    ]);

    Auth::user()->groups()->attach($group->id);

    return redirect('/');
});

Route::get('group/{group}', function (Group $group){

    if ($group->users->doesntContain(Auth::user())) {
        abort(403);
    }

    return view('groups.show', ['group' => $group]);
});

Route::get('/groups/create', function () {
   return view ('groups.create');
});

