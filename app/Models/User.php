<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function following(){
        return $this->belongsToMany(User::class,'user_follows','user_id','target_id');
    }

    public function followers(){
        return $this->belongsToMany(User::class,'user_follows','target_id','user_id');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }


    public function blocked_users()
    {
        return $this->belongsToMany(User::class, 'user_blocks', 'target_id', 'user_id');
    }

    public function isBlockedBy(User $user)
    {
        return $this->blocked_users()->where('target_id', $user->id)->exists();
    }
}
