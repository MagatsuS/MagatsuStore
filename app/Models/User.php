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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function addresses()
    {
        return $this->hasMany(Address::class);
    } 

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->role = $user->role ?? 'user'; // Set default role to 1 if not specified
        });
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Set default role if not already set (optional)
        $this->role = $this->role ?? 'user'; // 1 for user, 2 for owner
    }
}