<?php
/**
 * Enrollment Model
 * English: Represents a user's enrollment in a course, including payment status.
 * Arabic: يمثل تسجيل المستخدم في كورس معين مع حالة الدفع.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // User who enrolled | معرف المستخدم
        'course_id', // Course enrolled in | معرف الكورس
        'payment_status', // Payment status | حالة الدفع
        'stripe_payment_id', // Stripe payment ID | رقم عملية Stripe
    ];

    /**
     * User relationship
     * علاقة المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Course relationship
     * علاقة الكورس
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
