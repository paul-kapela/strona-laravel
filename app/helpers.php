<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

if (!function_exists('save_attachments')) {
    function save_images($attachmentUploadToken, $attachmentsDirectory) {
        $oldPath = 'cache/'.$attachmentUploadToken;
        $newPath = 'uploads/'.$attachmentsDirectory;

        $attachments = [];

        foreach (Storage::disk('public')->files($oldPath) as $filename)
        {
            $newFilename = $newPath.'/'.substr($filename, strrpos($filename, '/' ) + 1);
            Storage::disk('public')->move($filename, $newFilename);
            array_push($attachments, $newFilename);
        }

        return $attachments;
    }
}

if (!function_exists('attachments_to_json')) {
    function attachments_to_json($id, $model) {
        $attachments = [];
        
        if ($model == 'assignment')
            $attachments = unserialize(\App\Assignment::find($id)->attachments);
        elseif ($model == 'answer')
            $attachments = unserialize(\App\Answer::find($id)->attachments);

        $object = [];

        foreach ($attachments as $attachment)
        {
            $object[] = [
                'name' => substr($attachment, strrpos($attachment, '/' ) + 1),
                'size' => Storage::disk('public')->size($attachment),
                'url' => $attachment
            ];
        }

        return json_encode($object);
    }
}

if (!function_exists('is_image')) {
    function is_image($attachment) {
        $imageExtensions = ['jpeg', 'jpg', 'png'];

        foreach ($imageExtensions as $imageExtension)
        {
            if (str_ends_with($attachment, $imageExtension))
                return true;
        }

        return false;
    }
}