<?php

namespace Database\Factories;

use App\Helper\NumberHelper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EquipmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(15)
        ];
    }
}
