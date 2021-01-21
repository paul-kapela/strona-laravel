<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $this->authorize('create', Answer::class, auth()->user());

        $subject = request('subject');
        $grade = request('grade');
        $query = request('query');
        $user = request('user');

        if ($subject || $grade)
        {
            if ($subject)
            {
                $answers = \App\Answer::whereHas('assignment', function ($query) {
                    $query->whereHas('subject', function ($query) {
                        $query->where('name', '=', request('subject'));
                    });
                });
            }
            
            if ($grade)
            {
                $answers = \App\Answer::whereHas('assignment', function ($query) {
                    $query->whereHas('grade', function ($query) {
                        $query->where('name', '=', request('grade'));
                    });
                });
            }
        }
    

        if ($user)
        {
            if ($subject || $grade)
            {
                $answers = $answers->where('user_id', '=', $user);
            }
            else
            {
                $answers = \App\Answer::where('user_id', '=', $user);
            }
        }

        if ($query)
        {
            $column = App::getLocale() == 'pl' ? 'content_pl' : 'content_en';

            if ($subject || $grade || $user)
            {
                $answers = $answers->where($column, 'LIKE', '%' . $query . '%');
            }
            else
            {
                $answers = \App\Answer::where($column, 'LIKE', '%' . $query . '%');
            }
        }

        if ($subject || $grade || $user || $query)
        {
            $answers = $answers->latest()->paginate(5);
        }
        else
        {
            $answers = \App\Answer::latest()->paginate(5);
        }

        return view('answers.index', compact('answers'));
    }

    public function show(\App\Answer $answer)
    {
        $this->authorize('create', Answer::class, auth()->user());

        return view('answers.show', compact('answer'));
    }

    public function create(\App\Assignment $assignment)
    {
        $this->authorize('create', Answer::class, auth()->user());

        return view('answers.create', compact('assignment'));
    }

    public function edit(\App\Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('answer'));

        // todo: maybe something else
    }

    public function store(\App\Answer $answer, \App\Assignment $assignment)
    {
        $user = auth()->user();

        $this->authorize('create', Answer::class, $user);

        $data = request()->validate([
            'content_pl' => 'required_without:content_en',
            'content_en' => 'required_without:content_pl',
            'image-upload-token' => 'required',
        ]);

        $image_directory = Str::uuid();
        $attachments = save_images($data['image-upload-token'], $image_directory);
        Storage::deleteDirectory('public/cache/'.$data['image-upload-token']);

        $answer = new Answer();
        $answer->content_pl = (array_key_exists('content_pl', $data) && $data['content_pl'] != null) ? $data['content_pl'] : '';
        $answer->content_en = (array_key_exists('content_en', $data) && $data['content_en'] != null) ? $data['content_en'] : '';
        $answer->image_directory = $image_directory;
        $answer->attachments = serialize($attachments);
        $answer->user()->associate(Auth::user());
        $answer->assignment()->associate($assignment);
        $answer->save();

        return redirect(route('assignments.show', $assignment));
    }

    public function update(\App\Answer $answer)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $data = request()->validate([
            'content_pl' => 'required_without:content_en',
            'content_en' => 'required_without:content_pl',
        ]);

        $updatedData = [
            'content_pl' => $data['content_pl'] ?? '',
            'content_en' => $data['content_en'] ?? '',
        ];

        $answer->update($updatedData);

        return redirect(route('assignments.show', $answer->assignment()->get()->first()));
    }

    public function delete(\App\Answer $answer)
    {
        $this->authorize('delete', $answer);

        return view('answers.delete', compact('answer'));
        // TODO: the view
    }

    public function destroy(\App\Answer $answer)
    {
        $this->authorize('delete', $answer);

        $assignment = $answer->assignment()->get()->first();

        Storage::deleteDirectory('public/uploads/'.$answer->image_directory);

        $answer->delete();

        return redirect(route('assignments.show', $assignment));
    }

    public function imageUploadStore(\App\Answer $answer)
    {
        $this->authorize('update', $answer);

        $validExtensions = array('jpeg', 'jpg', 'png');

        $data = request()->validate([
            'token' => 'required',
            'image' => ['required', 'image']
        ]);

        $extension = $data['image']->getClientOriginalExtension();

        if (in_array(strtolower($extension), $validExtensions))
        {
            $attachments = unserialize($answer->attachments);

            $imagePath = $data['image']->store('uploads/'.$answer->image_directory, 'public');

            Log::channel('stack')->info($imagePath);

            $attachments[] = 'public/'.$imagePath;

            $answer->attachments = serialize($attachments);
            $answer->save();
        }

        return response()->json([
           'filename' => substr($imagePath, strrpos($imagePath, '/' ) + 1)
        ]);
    }

    public function imageUploadDestroy(\App\Answer $answer)
    {
        $this->authorize('update', $answer);

        $data = request()->validate([
            //'token' => 'required',
            'filename' => 'required'
        ]);

        $path = 'public/uploads/'.$answer->image_directory.'/'.$data['filename'];

        Storage::delete($path);

        $attachments = unserialize($answer->attachments);
        $answer->attachments = serialize(array_diff($attachments, [$path]));
        $answer->save();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
