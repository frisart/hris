<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'order' => $this->faker->randomNumber(6),
            'active' => $this->faker->boolean(),


        ];
    }
}