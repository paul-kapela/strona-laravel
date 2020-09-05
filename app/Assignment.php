<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Assignment extends Model
{
    protected $guarded = [];

    public function content()
    {
        $locale = App::getLocale();

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

    public function user()
    {
        return $this->belongsTo(User::class);
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
