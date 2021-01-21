<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $currentUser = auth()->user();

        $assignment = request('assignment');
        $subject = request('subject');
        $grade = request('grade');
        $user = request('user');

        if ($currentUser->belongsToRoles('user'))
        {
            $requests = \App\Request::where('user_id', '=', $user);

            if ($assignment)
            {
                $requests = $requests->where('assignment_id', '=', $assignment);
            }
        }
        else if ($currentUser->belongsToRoles('admin', 'editor'))
        {
            if ($user)
            {
                $requests = \App\Request::where('user_id', '=', $user);
            }

            if ($assignment)
            {
                $requests = $requests->where('assignment_id', '=', $assignment);
            }
            else if ($subject || $grade)
            {
                if ($subject)
                {
                    $requests = \App\Request::whereHas('assignment', function ($query) {
                        $query->whereHas('subject', function ($query) {
                            $query->where('name', '=', request('subject'));
                        });
                    });
                }

                if ($grade)
                {
                    $requests = \App\Request::whereHas('assignment', function ($query) {
                        $query->whereHas('grade', '=', request('grade'));
                    });
                }
            }
        }

        if ($assignment || $subject || $grade || $user)
        {
            $requests = $requests->latest()->paginate(5);
        }
        else
        {
            $requests = \App\Request::latest()->paginate(5);
        }

        return view('requests.index', compact('requests'));
    }

    public function create(Assignment $assignment)
    {
        $this->authorize('create', \App\Request::class, auth()->user());

        return view('requests.create', compact('assignment'));
    }

    public function edit(\App\Request $request)
    {
        $this->authorize('update', auth()->user(), $request);

        return view('requests.edit', compact('request'));
    }

    public function store(Assignment $assignment, \App\Request $request)
    {
        $user = auth()->user();

        $this->authorize('create', \App\Request::class, $user);

        $data = request()->validate([
            'due_date' => ['required', 'date', 'date_format:Y-m-d', 'after:tomorrow']
        ]);

        $request = new \App\Request();
        $request->due_date = $data['due_date'];
        $request->user()->associate($user);
        $request->assignment()->associate($assignment);

        $request->save();

        return redirect(route('assignments.show', $assignment));
    }

    public function update()
    {

    }

    public function delete(\App\Request $request)
    {
        $this->authorize('delete', $request);

        return view('request.delete', compact('request'));
    }

    public function destroy()
    {

    }
}
