<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'enrollment_id' => Enrollment::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'transaction_id' => $this->faker->uuid(),
            'paid_at' => $this->faker->optional()->dateTimeThisYear(),
        ];
    }
}
