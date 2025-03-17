<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Add other fields as necessary
    ];

    /**
     * Get the user associated with the teacher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the courses taught by the teacher.
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
