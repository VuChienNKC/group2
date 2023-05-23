<?php

namespace Database\Factories;

use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name'=>fake()->name(),
            'birthday'=>fake()->date(),
            'staff_id'=>function () {
                return \App\Models\employee::inRandomOrder()->first()->staff_id;
            }
            //
        ];
    }
}