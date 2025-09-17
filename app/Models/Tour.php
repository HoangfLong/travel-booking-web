<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{   
    use SoftDeletes;

    protected $table = 'tours';

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'destinations',
        'images',
        'number_of_days',
        'start_time',
        'end_time',
        'schedule',
        'number_of_guests',
        'available_seats',
        'status',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class, 'tour_id');
    // }

    public function likedByUsers()
    {
        // Bảng trung gian là 'likes', các khóa ngoại sẽ được suy ra
        return $this->belongsToMany(User::class, 'likes', 'tour_id', 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tour_id');   
    }
    // SELECT * FORM tours;
    // SELECT * FORM bookings WHERE tour_id (1223);
}
