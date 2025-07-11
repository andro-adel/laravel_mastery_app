<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Enrollment;
use App\Models\Payment;

/**
 * نموذج الدورة | Course Model
 *
 * يمثل دورة تعليمية في المنصة | Represents a course in the platform
 */
class Course extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة | Fillable fields
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'price', 'instructor_id', 'status',
    ];

    /**
     * المدرب المسؤول عن الدورة | The instructor of the course
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * التسجيلات المرتبطة بالدورة | Enrollments for this course
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * المدفوعات المرتبطة بالدورة عبر التسجيلات | Payments for this course via enrollments
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Enrollment::class);
    }
}
