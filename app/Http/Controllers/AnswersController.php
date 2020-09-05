<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function create(\App\Assignment $assignment)
    {
        return view('answers.create', compact('assignment'));
    }

    public function store(\App\Assignment $assignment)
    {
        $data = request()->validate([
            'content' => 'required',
            'image-upload-token' => 'required',
        ]);

        $attachments = save_images($data['image-upload-token']);

        $answer = new Answer();
        $answer->content = $data['content'];
        $answer->attachments = serialize($attachments);
        $answer->user()->associate(Auth::user());
        $answer->assignment()->associate($assignment);
        $answer->save();

        return redirect(route('assignments.show', $assignment));
    }
}
