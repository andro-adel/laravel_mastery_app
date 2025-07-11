<?php

namespace App\Notifications;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * إشعار تسجيل طالب في دورة | Notification: Student enrolled in a course
 */
class StudentEnrolledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Enrollment $enrollment;

    /**
     * إنشاء الإشعار مع بيانات التسجيل | Create notification with enrollment data
     */
    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * القنوات المستخدمة | Notification channels
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * رسالة البريد | To mail
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('تم تسجيلك في دورة جديدة | You have been enrolled in a new course')
            ->greeting('مرحبًا ' . $notifiable->name)
            ->line('تم تسجيلك في الدورة: ' . $this->enrollment->course->title)
            ->action('عرض الدورة | View Course', url('/courses/' . $this->enrollment->course_id))
            ->line('شكرًا لاستخدامك منصتنا التعليمية! | Thank you for using our platform!');
    }

    /**
     * تخزين الإشعار في قاعدة البيانات | To database
     */
    public function toDatabase($notifiable)
    {
        return [
            'course_id' => $this->enrollment->course_id,
            'course_title' => $this->enrollment->course->title,
            'message' => 'تم تسجيلك في الدورة: ' . $this->enrollment->course->title,
        ];
    }
}
