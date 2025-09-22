<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'password',
        'google_id',
        'facebook_id',
        'role',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function likedTours()
    {
        // Bảng trung gian là 'likes', các khóa ngoại sẽ được suy ra
        return $this->belongsToMany(Tour::class, 'likes', 'user_id', 'tour_id');
    }

    // Thêm helper
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
        //exists() check role có tồn tại
    }
}
