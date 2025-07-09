<?php
/**
 * User Model
 *
 * English: Represents the user entity in the application. Handles user authentication, relationships, and attributes.
 * Arabic: يمثل كيان المستخدم في التطبيق. يتعامل مع المصادقة والعلاقات والخصائص الخاصة بالمستخدم.
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Import HasRoles trait for role-based access control
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable; // Import Billable trait for Stripe payments

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, Billable; // Add Billable trait

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    /**
     * Get the enrollments for the user.
     * جلب جميع التسجيلات الخاصة بالمستخدم
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
