<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * نموذج الإشعار | Notification Model
 *
 * يمثل إشعارًا في النظام | Represents a notification in the system
 */
class Notification extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة | Fillable fields
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'data', 'read_at',
    ];

    /**
     * المستخدم الذي استلم الإشعار | The user who received the notification
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
