<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
            'parent_whatsapp' => $this->faker->numerify('33########'),
            'number_list' => $this->faker->numberBetween(1, 30),
        ];
    }
}
