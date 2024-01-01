<?php

namespace App\Helper;

use Faker\Generator;
use Illuminate\Contracts\Container\BindingResolutionException;

class NumberHelper
{
    /**
     * @throws BindingResolutionException
     */
    public static function fakeNationalCode(): string
    {
        /** @var Generator $faker */
        $faker = app()->make(Generator::class);
        $partialFakeNationalCode = $faker->numerify('#########');

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (10 - $i) * (int)$partialFakeNationalCode[$i];
        }
        $residual = $sum % 11;

        if ($residual < 2) {
            $lastDigit = $residual;
        } else {
            $lastDigit = 11 - $residual;
        }

        return $partialFakeNationalCode . $lastDigit;
    }
}
