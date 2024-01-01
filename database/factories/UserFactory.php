<?php

namespace Database\Factories;

use App\Helper\NumberHelper;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws BindingResolutionException
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'national_code' => NumberHelper::fakeNationalCode(),
            'password' => Hash::make($this->faker->password(8, 25)),
        ];
    }
}
