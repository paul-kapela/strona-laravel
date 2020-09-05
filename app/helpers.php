<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('env')) {
    function save_images($imageUploadToken) {
        $oldPath = 'public/cache/'.$imageUploadToken.'/';
        $newPath = 'public/uploads/'.$imageUploadToken.'/';

        $attachments = [];

        foreach (Storage::files($oldPath) as $filename)
        {
            $newFilename = $newPath.substr($filename, strrpos($filename, '/' ) + 1);
            Storage::move($filename, $newFilename);
            array_push($attachments, $newFilename);
        }

        return attachments;
    }
}
