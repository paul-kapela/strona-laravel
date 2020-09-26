<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function store()
    {
        $validExtensions = array('jpeg', 'jpg', 'png');

        $data = request()->validate([
            'token' => 'required',
            'image' => ['required', 'image']
        ]);

        $token = request('token');

        $extension = $data['image']->getClientOriginalExtension();

        if (in_array(strtolower($extension), $validExtensions))
        {
            $imagePath = $data['image']->store('cache/'.$token, 'public');
        }

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

        $path = 'public/cache/'.$data['token'].'/'.$data['filename'];

        Storage::delete($path);

        return response()->json([
            'filename' => substr($path, strrpos($path   , '/' ) + 1)
        ]);
    }
}
