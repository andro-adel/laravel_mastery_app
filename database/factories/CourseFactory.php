<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'instructor_id' => User::factory(),
        ];
    }
}
