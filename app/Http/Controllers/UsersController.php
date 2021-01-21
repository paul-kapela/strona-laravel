<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\EmailChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->belongsToRoles('admin'))
            abort(401);

        $users = \App\User::all();

        return view('users.index', compact('users'));
    }

    public function show(\App\User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(\App\User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(\App\User $updatedUser)
    {
        $user = auth()->user();
        $userModel = User::findOrFail($user->id);

        $this->authorize('update', $user);

        $data = request()->validate([
            'username' => ['string', 'max:30'],
            'email' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'regex:/[0-9]{3} [0-9]{3} [0-9]{3}/'],
            'skype' => ['nullable', 'string', 'max:32'],
            'email_show' => ['nullable', 'boolean'],
            'phone_show' => ['nullable', 'boolean'],
            'skype_show' => ['nullable', 'boolean'],
        ]);

        $data['email_show'] = isset($data['email_show']) ? '1' : '0';
        $data['phone_show'] = isset($data['phone_show']) ? '1' : '0';
        $data['skype_show'] = isset($data['skype_show']) ? '1' : '0';

        $emailChangeAttemped = false;

        if ($user->email != $data['email'])
        {
            $newEmail = $data['email'];

            Notification::send($user, new EmailChange($user, $newEmail));

            $emailChangeAttemped = true;
        }

        unset($data['email']);

        $userModel->fill($data);
        $userModel->save();

        if ($emailChangeAttemped)
        {
            return redirect(route('users.show', $user))->with(['email_changed' => $newEmail]);
        }
        
        return redirect(route('users.show', $user));
    }
}

