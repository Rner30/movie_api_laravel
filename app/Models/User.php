<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    public $incrementing = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class)->withPivot('seconds');
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public static function getUserByEmail($email)
    {
        $user = User::query()->where('email', $email)->first();
        return $user;
    }
    
    public static function getUserById($id)
    {
        $user = User::query()->with('movies')->findOrFail($id)->first();
        return $user;
    }

}
