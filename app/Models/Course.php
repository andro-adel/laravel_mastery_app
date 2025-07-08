<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * الحقول القابلة للملء الجماعي
     */
    protected $fillable = [
        'title', // Course title | عنوان الدورة
        'description', // Course description | وصف الدورة
        'image_path', // Path to featured image | مسار صورة الدورة
        'instructor_id', // Instructor user id | رقم معرف المدرس
        'status', // Course status | حالة الدورة
    ];

    /**
     * Get the instructor (user) for the course.
     * جلب بيانات المدرس المرتبط بالدورة
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
