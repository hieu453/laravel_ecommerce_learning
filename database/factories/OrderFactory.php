<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'tracking_no' => 'no'.Str::random(10),
            'fullname' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '12345678910',
            'address' => 'ajkdf',
            'pincode' => '123456',
            'status_message' => 'in progress',
            'payment_mode' => 'cod',
        ];
    }
}
