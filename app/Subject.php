<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
