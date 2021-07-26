<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AttachmentUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function store()
    {
        $data = request()->validate([
            'token' => 'required',
            'attachment' => ['required', 'file', 'mimes:jpeg,jpg,png,doc,docx,pdf']
        ]);

        $token = request('token');

        $imagePath = $data['attachment']->store('cache/'.$token, 'public');

        return response()->json([
            'filename' => substr($imagePath, strrpos($imagePath, '/' ) + 1)
        ]);
    }

    public function destroy()
    {
        $data = request()->validate([
            'token' => 'required',
            'filename' => 'required'
        ]);

        $path = storage_path('app/public/cache/'.$data['token'].'/'.$data['filename']);

        Storage::disk('public')->delete($path);

        return response()->json([
            'filename' => substr($path, strrpos($path   , '/' ) + 1)
        ]);
    }
}
