<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index () {

        $groups = Group::whereAttachedTo(
            Auth::user())->get();

        return view ('home', ['groups' => $groups]);
    }

    public function create () {

        return view ('groups.create');
    }

    public function store () {

        request()->validate([
            'name' => 'required'
        ]);

        $group = Group::create([
            'name' => request('name')
        ]);

        Auth::user()->groups()->attach($group->id);

        return redirect('/');
    }

    public function show (Group $group) {

        if ($group->users->doesntContain(Auth::user())) {
            abort(403);
        }

        $users = User::whereAttachedTo($group)->get();

        return view('groups.show', [
            'group' => $group,
            'users'=> $users]);

    }

    public function addUser (Group $group) {

        if ($group -> users -> doesntContain(Auth::user())) {
            abort(403);
        }

        $user = User::where('email', request('email'))->first();

        if (!$user) {
            $user = User::create([
                'email' => request('email'),
            ]);
        }

        $group->users()->syncWithoutDetaching($user);

        return redirect()->back();

        }
}
