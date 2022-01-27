<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'south_african_id_number' => $this->faker->numerify('##########'),
            'mobile' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'language_id' => null,
        ];
    }
}
