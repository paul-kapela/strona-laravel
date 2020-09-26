<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

if (!function_exists('save_images')) {
    function save_images($imageUploadToken, $imageDirectory) {
        $oldPath = 'public/cache/'.$imageUploadToken.'/';
        $newPath = 'public/uploads/'.$imageDirectory.'/';

        $attachments = [];

        foreach (Storage::files($oldPath) as $filename)
        {
            $newFilename = $newPath.substr($filename, strrpos($filename, '/' ) + 1);
            Storage::move($filename, $newFilename);
            array_push($attachments, $newFilename);
        }

        return $attachments;
    }
}

if (!function_exists('attachments_to_json')) {
    function attachments_to_json($assignment_id) {
        $attachments = unserialize(\App\Assignment::find($assignment_id)->attachments);

        $object = [];

        foreach ($attachments as $attachment)
        {
            $object[] = [ 'name' => substr($attachment, strrpos($attachment, '/' ) + 1), 'size' => Storage::size($attachment), 'url' => $attachment ];
        }

        return json_encode($object);
    }
}
