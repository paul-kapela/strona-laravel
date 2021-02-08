<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $guarded = [];

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
        return $this->hasOne(RequestResponse::class);
    }

    public function status()
    {
        /*
        will return one of these three values:
        - pending (no response),
        - accepted by editor,
        - accepted by user,
        - ready,
        - paid
        */

        if (!$this->requestResponse()->exists())
        {
            return 'pending';
        }
        else
        {
            if ($this->requestResponse->accepted)
            {
                if ($this->requestResponse->answer()->exists())
                {
                    if ($this->requestResponse->paid)
                    {
                        return 'paid';
                    }
                    else
                    {
                        return 'ready';
                    }
                }
                else
                {
                    return 'accepted_by_user';
                }
            }
            else
            {
                return 'accepted_by_editor';
            }
        }
    }
}
