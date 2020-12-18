<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    // 'name', 'surname',

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->roles()->attach(Role::where('name', '=', 'user')->get());
            //Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function profileImage()
    {
        return (($this->image) ? '/storage/' . $this->image : '/img/customProfile.png');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
