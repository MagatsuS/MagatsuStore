<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    // Specify the model associated with this factory
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Automatically create a user and assign it to the order
            'total_price' => $this->faker->randomFloat(2, 50, 500), // Random total price between 50 and 500
            'shipping_status' => 'Pending', // Default status
            'tracking_number' => strtoupper($this->faker->lexify('???')) . $this->faker->numerify('##########'), // Example: ABC123456789
        ];
    }
}
