<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
