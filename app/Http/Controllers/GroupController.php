<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Group;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {

        $groups = Group::whereAttachedTo(
            Auth::user())->get();

        $payments = Payment::whereBelongsTo(
            Auth::user())->get();

        return view('home', ['groups' => $groups,
            'payments' => $payments]);
    }

    public function create()
    {

        return view('groups.create');
    }

    public function store()
    {

        request()->validate([
            'name' => 'required'
        ]);

        $group = Group::create([
            'name' => request('name')
        ]);

        Auth::user()->groups()->attach($group->id);

        return redirect('/');
    }

    public function show(Group $group)
    {

        $users = User::whereAttachedTo($group)->get();

        $expenses = Expense::whereBelongsTo($group)->get();

        if ($users->doesntContain(Auth::user())) {
            abort(403);
        }


        return view('groups.show', [
            'group' => $group,
            'users' => $users,
            'expenses'=> $expenses]);

    }
}
