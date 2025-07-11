<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * نموذج الدفع | Payment Model
 *
 * يمثل عملية دفع في المنصة | Represents a payment in the platform
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة | Fillable fields
     * @var array
     */
    protected $fillable = [
        'user_id', 'enrollment_id', 'amount', 'status', 'payment_method', 'transaction_id', 'paid_at',
    ];

    /**
     * المستخدم الذي قام بالدفع | The user who made the payment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * التسجيل المرتبط بالدفع | The enrollment for this payment
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }
}
