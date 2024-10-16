<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Surrender Details to Profiles Model
    public function profile()
    {
        return $this->hasOne(profilesModel::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'role',
        'email',
        'password',
    ];

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false) {
            $query->where('email', 'like', '%' . request('search') . '%')
            ->orWhere('username', 'like', '%' . request('search') . '%')
            ->orWhere('role', 'like', '%' . request('search') . '%')
            ->orWhere('id', 'like', '%' . request('search') . '%');
        }
    }


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
        'password' => 'hashed',
    ];
}
