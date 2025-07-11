<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * نموذج التسجيل | Enrollment Model
 *
 * يمثل تسجيل طالب في دورة | Represents a student's enrollment in a course
 */
class Enrollment extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة | Fillable fields
     * @var array
     */
    protected $fillable = [
        'user_id', 'course_id', 'status',
    ];

    /**
     * الطالب المسجل | The enrolled student
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الدورة المرتبطة بالتسجيل | The course of this enrollment
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * المدفوعات المرتبطة بالتسجيل | Payments for this enrollment
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
