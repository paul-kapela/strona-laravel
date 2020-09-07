<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Grade;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $subject = request('subject');
        $grade = request('grade');
        $query = request('query');

        if ($subject && $grade)
        {
            $assignments = \App\Subject::where('name', '=', $subject)->get()->first()->assignments()->where('grade_id', '=', \App\Grade::where('name', '=', $grade)->get()->first()->id);
        }
        else if ($subject)
        {
            $assignments = \App\Subject::where('name', '=', $subject)->get()->first()->assignments();
        }
        else if ($grade)
        {
            $assignments = \App\Grade::where('name', '=', $grade)->get()->first()->assignments();
        }

        if ($query)
        {
            $column = App::getLocale() == 'pl' ? 'content_pl' : 'content_en';

            if ($subject || $grade)
            {
                $assignments = $assignments->where($column, 'LIKE', '%' . $query . '%');
            }
            else
            {
                $assignments = \App\Assignment::where($column, 'LIKE', '%' . $query . '%');
            }
        }

        // TODO: Make number of assignments per page customizable
        if ($subject || $grade || $query)
        {
            $assignments = $assignments->latest()->paginate(5);
        }
        else
        {
            $assignments = \App\Assignment::latest()->paginate(5);
        }

        return view('assignments.index', compact('assignments'));
    }

    public function show(\App\Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    public function create()
    {
        return view('assignments.create');
    }

    public function edit(\App\Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        return view('assignments.edit', compact('assignment'));
    }

    public function store()
    {
        $user = auth()->user();

        $data = request()->validate([
            'content_pl' => 'required_without:content_en',
            'content_en' => 'required_without:content_pl',
            'image-upload-token' => 'required',
            'subject' => 'required',
            'grade' => 'required',
        ]);

        $attachments = save_images($data['image-upload-token']);

        $assignment = new Assignment();
        $assignment->content_pl = array_key_exists('content_pl', $data) ? $data['content_pl'] : '';
        $assignment->content_en = array_key_exists('content_en', $data) ? $data['content_en'] : '';
        $assignment->image_upload_token = $data['image-upload-token'];
        $assignment->attachments = serialize($attachments);
        $assignment->user()->associate($user);
        $assignment->subject()->associate(Subject::find($data['subject']));
        $assignment->grade()->associate(Grade::find($data['grade']));
        $assignment->save();

        return redirect(route('assignments.show', $assignment));
    }

    public function patch(\App\Assignment $assignment)
    {

    }

    public function update(\App\Assignment $assignment)
    {

    }

    public function delete(\App\Assignment $assignment)
    {
        $this->authorize('delete', $assignment);

        return view('assignments.delete', compact($assignment));
    }

    public function destroy(\App\Assignment $assignment)
    {
        $this->authorize('delete', $assignment);
    }

    public function imageUploadStore(\App\Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $validExtensions = array('jpeg', 'jpg', 'png');

        $data = request()->validate([
            'token' => 'required',
            'image' => ['required', 'image']
        ]);

        $token = request('token');

        $extension = $data['image']->getClientOriginalExtension();

        if (in_array(strtolower($extension), $validExtensions))
        {
            $imagePath = $data['image']->store('uploads/'.$token, 'public');
        }

        return response()->json([
           'filename' => substr($imagePath, strrpos($imagePath, '/' ) + 1)
        ]);
    }

    public function imageUploadDestroy(\App\Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $data = request()->validate([
            'token' => 'required',
            'filename' => 'required'
        ]);

        $path = 'public/uploads/'.$data['token'].'/'.$data['filename'];

        Storage::delete($path);
    }
}
