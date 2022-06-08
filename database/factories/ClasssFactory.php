<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClasssFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'encuadre' => '[
                {
                  "name":"Primer parcial",
                  "value":"20"
                },
                {
                  "name":"Segundo parcial",
                  "value":"40"
                },
                {
                  "name":"Tercer parcial",
                  "value":"40"
                }
            ]',
        ];
    }
}
