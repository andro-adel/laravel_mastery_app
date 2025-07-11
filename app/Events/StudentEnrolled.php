<?php

namespace App\Events;

use App\Models\Enrollment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * حدث تسجيل طالب في دورة | Event: Student enrolled in a course
 */
class StudentEnrolled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Enrollment $enrollment;

    /**
     * إنشاء الحدث مع بيانات التسجيل | Create event with enrollment data
     */
    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }
}
