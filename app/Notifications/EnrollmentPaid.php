<?php
/**
 * EnrollmentPaid Notification
 * English: Notifies user when enrollment payment is successful.
 * Arabic: إشعار المستخدم عند نجاح دفع التسجيل في الكورس.
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Enrollment;

class EnrollmentPaid extends Notification implements ShouldQueue
{
    use Queueable;

    public $enrollment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Course Enrollment Successful | تم التسجيل في الكورس بنجاح'))
            ->greeting(__('Hello, :name', ['name' => $notifiable->name]))
            ->line(__('You have successfully enrolled in the course: :course', ['course' => $this->enrollment->course->title]))
            ->line(__('Thank you for your payment! | شكراً لدفعك!'));
    }

    /**
     * Get the array representation of the notification for database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'course_id' => $this->enrollment->course_id,
            'course_title' => $this->enrollment->course->title,
            'message' => __('You have successfully enrolled in the course: :course', ['course' => $this->enrollment->course->title]),
        ];
    }
}
