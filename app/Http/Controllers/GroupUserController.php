<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupUserController extends Controller
{
    public function create(Group $group)
    {
        if ($group -> users -> doesntContain(Auth::user())) {
            abort(403);
        }

        $user = User::where('email', request('email'))->first();

        if (! $user) {
            $user = User::create([
                'email' => request('email'),
            ]);
        }

        $group->users()->syncWithoutDetaching($user);

        return redirect()->back();

    }
}
