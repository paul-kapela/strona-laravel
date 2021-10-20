<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Grade;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        $this->authorize('viewAny', Assignment::class, auth()->user());

        $subject = request('subject');
        $grade = request('grade');
        $query = request('query');
        $user = request('user');
        $solved = request('solved');

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

        if ($user)
        {
            if ($subject || $grade)
            {
                $assignments = $assignments->where('user_id', '=', $user);
            }
            else
            {
                $assignments = \App\Assignment::where('user_id', '=', $user);
            }
        }

        if ($query)
        {
            $column = App::getLocale() == 'pl' ? 'content_pl' : 'content_en';

            if ($subject || $grade || $user)
            {
                $assignments = $assignments->where($column, 'LIKE', '%' . $query . '%');
            }
            else
            {
                $assignments = \App\Assignment::where($column, 'LIKE', '%' . $query . '%');
            }
        }
        
        if ($solved == '0' || $solved == '1')
        {
            if ($subject || $grade || $user || $query)
            {
                if ($solved == '0')
                {
                    $assignments = $assignments->doesntHave('answers');
                }
                else if ($solved == '1')
                {
                    $assignments = $assignments->has('answers');
                }
            }
            else
            {
                if ($solved == '0')
                {
                    $assignments = \App\Assignment::doesntHave('answers');
                }
                else if ($solved == '1')
                {
                    $assignments = \App\Assignment::has('answers');
                }
            }
        }

        // TODO: Make number of assignments per page customizable?
        if ($subject || $grade || $user || $query)
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
        $this->authorize('viewAny', Assignment::class, auth()->user());

        return view('assignments.show', compact('assignment'));
    }

    public function create()
    {
        $this->authorize('create', Assignment::class, auth()->user());

        return view('assignments.create');
    }

    public function edit(\App\Assignment $assignment)
    {
        $this->authorize('update', auth()->user(), $assignment);

        return view('assignments.edit', compact('assignment'));
    }

    public function store()
    {
        $user = auth()->user();

        $this->authorize('create', Assignment::class, $user);

        $data = request()->validate([
            'content_pl' => 'required_without:content_en',
            'content_en' => 'required_without:content_pl',
            'image-upload-token' => 'required',
            'subject' => 'required',
            'grade' => 'required',
        ]);

        $image_directory = Str::uuid();
        $attachments = save_images($data['image-upload-token'], $image_directory);
        Storage::disk('public')->deleteDirectory('cache/'.$data['image-upload-token']);

        $assignment = new Assignment();
        $assignment->content_pl = (array_key_exists('content_pl', $data) && $data['content_pl'] != null) ? $data['content_pl'] : '';
        $assignment->content_en = (array_key_exists('content_en', $data) && $data['content_en'] != null) ? $data['content_en'] : '';
        $assignment->image_directory = $image_directory;
        $assignment->attachments = serialize($attachments);
        $assignment->user()->associate($user);
        $assignment->subject()->associate(Subject::find($data['subject']));
        $assignment->grade()->associate(Grade::find($data['grade']));

        $assignment->save();

        return redirect(route('assignments.show', $assignment));
    }

    public function update(\App\Assignment $assignment)
    {
        $user = auth()->user();
        
        $this->authorize('update', $user, $assignment);

        $data = request()->validate([
            'content_pl' => 'required_without:content_en',
            'content_en' => 'required_without:content_pl',
            'subject' => 'required',
            'grade' => 'required',
        ]);

        $updatedData = [
            'content_pl' => $data['content_pl'] ?? '',
            'content_en' => $data['content_en'] ?? '',
        ];

        $assignment->update($updatedData);

        if ($data['subject'] || $data['grade'])
        {
            if ($data['subject']) {
                $assignment->subject()->dissociate();
                $assignment->subject()->associate(Subject::find($data['subject']));
            }

            if ($data['grade']) {
                $assignment->grade()->dissociate();
                $assignment->grade()->associate(Grade::find($data['grade']));
            }

            $assignment->save();
        }

        return redirect(route('assignments.show', $assignment));
    }

    public function delete(\App\Assignment $assignment)
    {
        $this->authorize('delete', $assignment);

        return view('assignments.delete', compact('assignment'));
    }

    public function destroy(\App\Assignment $assignment)
    {
        $this->authorize('delete', $assignment);

        $assignment->delete();

        return redirect(route('assignments.index'));
    }

    public function uploadStore(\App\Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $data = request()->validate([
            'token' => 'required',
            'attachment' => ['required', 'file', 'mimes:jpeg,jpg,png,doc,docx,pdf']
        ]);

        $attachments = unserialize($assignment->attachments);

        $imagePath = $data['attachment']->store('uploads/'.$assignment->image_directory, 'public');

        $attachments[] = $imagePath;

        $assignment->attachments = serialize($attachments);
        $assignment->save();

        return response()->json([
           'filename' => substr($imagePath, strrpos($imagePath, '/' ) + 1)
        ]);
    }

    public function uploadDestroy(\App\Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $data = request()->validate([
            //'token' => 'required',
            'filename' => 'required'
        ]);

        $path = 'uploads/'.$assignment->image_directory.'/'.$data['filename'];

        Storage::disk('public')->delete($path);

        $attachments = unserialize($assignment->attachments);
        $assignment->attachments = serialize(array_diff($attachments, [$path]));
        $assignment->save();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
