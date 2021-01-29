<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Notifications\RequestRejected;
use App\Notifications\RequestResponded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
            $requests = \App\Request::where('user_id', '=', $currentUser->getKey());

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
            else if ($assignment)
            {
                $requests = \App\Request::where('assignment_id', '=', $assignment);
            }

            if ($subject)
            {
                $requests = $requests->whereHas('assignment', function ($query) {
                    $query->whereHas('subject', function ($query) {
                        $query->where('name', '=', request('subject'));
                    });
                });
            }

            if ($grade)
            {
                $requests = $requests->whereHas('assignment', function ($query) {
                    $query->whereHas('grade', '=', request('grade'));
                });
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
            'due_date' => ['required', 'date', 'date_format:Y-m-d', 'after:today']
        ]);

        $request = new \App\Request();
        $request->due_date = $data['due_date'];
        $request->user()->associate($user);
        $request->assignment()->associate($assignment);

        $request->save();

        return redirect(route('assignments.show', $assignment));
    }

    public function update(\App\Request $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user, $request);

        $data = request()->validate([
            'due_date' => ['required', 'date', 'date_format:Y-m-d', 'after:today']
        ]);

        $request->update($data);

        return redirect(route('requests.index'));
    }

    public function delete(\App\Request $request)
    {
        $this->authorize('delete', $request);

        return view('request.delete', compact('request'));
    }

    public function destroy()
    {
        
    }

    public function accept(\App\Request $request)
    {
        if (!auth()->user()->belongsToRoles('editor', 'admin'))
            abort(401);

        return view('requests.accept', compact('request'));
    }

    public function answer(\App\Request $request)
    {
        $user = auth()->user();

        if (!$user->belongsToRoles('editor', 'admin'))
            abort(401);

        $data = request()->validate([
            'price' => ['required', 'integer', 'gt:0']
        ]);

        $requestResponse = new \App\RequestResponse();
        $requestResponse->price = $data['price'];
        $requestResponse->accepted = false;
        $requestResponse->paid = false;
        $requestResponse->user()->associate($user);
        $requestResponse->request()->associate($request);

        $requestResponse->save();

        Notification::send($request->user, new RequestResponded());

        return redirect(route('requests.index'));
    }

    public function reject(\App\Request $request)
    {
        $user = auth()->user();

        if(!$user->belongsToRoles('editor', 'admin'))
            abort(401);

        Notification::send($request->user, new RequestRejected($request));

        $request->delete();

        return redirect(route('requests.index'));
    }
}
