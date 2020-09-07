<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(\App\User $user)
    {
        return view('users.index', compact('user'));
    }

    public function edit(\App\User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(\App\User $user)
    {

    }
}