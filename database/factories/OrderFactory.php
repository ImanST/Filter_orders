<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();
        $equipment = Equipment::query()->inRandomOrder()->first();

        $orderStatus = Order::getStatuses();

        return [
            'user_id' => $user->id,
            'equipment_id' => $equipment->id,
            'amount' => random_int(1, 20),
            'status' => $this->faker->randomElement($orderStatus)
        ];
    }
}
