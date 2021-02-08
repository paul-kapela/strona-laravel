<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestResponse extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'request_response_id');
    }
}
