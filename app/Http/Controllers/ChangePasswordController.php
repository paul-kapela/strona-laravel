<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordChanged;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change()
    {
        return view('auth.passwords.change');
    }

    public function new()
    {
        $user = auth()->user();

        $data = request()->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($data['new_password'])
        ]);

        Notification::send($user, new PasswordChanged());

        return redirect(route('users.show', $user))->with(['password_changed' => 1]);
    }
}
