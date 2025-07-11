<?php

namespace App\Listeners;

use App\Events\StudentEnrolled;
use App\Notifications\StudentEnrolledNotification;

/**
 * مستمع لإرسال إشعار عند تسجيل طالب في دورة | Listener to send notification on student enrollment
 */
class SendStudentEnrolledNotification
{
    /**
     * تنفيذ عند استقبال الحدث | Handle the event
     */
    public function handle(StudentEnrolled $event)
    {
        $student = $event->enrollment->user;
        $student->notify(new StudentEnrolledNotification($event->enrollment));
    }
}
