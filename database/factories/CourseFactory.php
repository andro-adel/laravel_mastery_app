<?php
/**
 * Course Factory
 *
 * English: Defines the default set of attributes for creating course model instances in tests and seeding.
 * Arabic: يحدد مجموعة الخصائص الافتراضية لإنشاء مثيلات نموذج الدورة في الاختبارات والتعبئة.
 */

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'image_path' => null,
            'instructor_id' => User::factory(),
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
