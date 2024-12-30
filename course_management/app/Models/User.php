<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function courses() 
    {
        // A user can be instructor or student
        // As an instructor, they have many courses they created
        // As a student, they can be in many courses via pivot
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }
    
    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }
}