<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Answer extends Model
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

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function requestResponse()
    {
        return $this->belongsTo(RequestResponse::class);
    }

    public function canDisplay()
    {
        // assignment->requests()->first()->exists() && $answer->assignment->requests()->   
        return false;
    }
}
