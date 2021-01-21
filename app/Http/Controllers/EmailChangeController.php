<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmailChangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed:consume');
    }

    public function verify()
    {
        $user = User::findOrFail(request('user'));

        $oldEmail = $user->email;

        $data = request()->validate([
            'newEmail' => ['required', 'email', 'max:254', 'unique:users']
        ]);

        $newEmail = $data['newEmail'];

        $user->update([
            'email' => $newEmail
        ]);

        Notification::send($user, new EmailChanged($oldEmail, $newEmail));

        return response()->view('users.email.change_succeeded');
    }
}
