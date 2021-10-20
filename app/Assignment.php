<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Assignment extends Model
{
    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::deleting(function ($assignment) {
            Storage::disk('public')->deleteDirectory('uploads/'.$assignment->image_directory);

            $assignment->answers()->delete();
        });
    }

    public function content($language = NULL)
    {
        $locale = $language ?? App::getLocale();

        switch ($locale)
        {
            case 'pl':
                return $this->content_pl;
                break;
            case 'en':
                return $this->content_en;
                break;
            default:
                return $this->content_pl;
                break;
        }
    }

    public function shortContent($language = NULL)
    {
        return Str::words(strip_tags($this->content($language)), 50, '...');
    }

    public static function recentUnsolved($number = 3) {
        return Assignment::doesntHave('answers')->latest()->take($number)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
