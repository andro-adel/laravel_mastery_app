<?php
/**
 * EnrollmentFailed Notification
 * English: Notifies user when enrollment payment fails.
 * Arabic: إشعار المستخدم عند فشل دفع التسجيل في الكورس.
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Enrollment;

class EnrollmentFailed extends Notification implements ShouldQueue
{
    use Queueable;

    public $enrollment;
    public $reason;

    public function __construct(Enrollment $enrollment, $reason = null)
    {
        $this->enrollment = $enrollment;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Course Enrollment Payment Failed | فشل دفع التسجيل في الكورس'))
            ->greeting(__('Hello, :name', ['name' => $notifiable->name]))
            ->line(__('Your payment for course ":course" failed.', ['course' => $this->enrollment->course->title]))
            ->line($this->reason ? __('Reason: :reason', ['reason' => $this->reason]) : '')
            ->line(__('Please try again or contact support. | يرجى المحاولة مرة أخرى أو التواصل مع الدعم.'));
    }

    public function toDatabase($notifiable)
    {
        return [
            'course_id' => $this->enrollment->course_id,
            'course_title' => $this->enrollment->course->title,
            'message' => __('Payment failed for course: :course', ['course' => $this->enrollment->course->title]),
            'reason' => $this->reason,
        ];
    }
}
