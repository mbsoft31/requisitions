<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Requisition;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequisitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "type" => $this->faker->randomElement([0,1]),
            "destination" => $this->faker->sentence(),
            "authorized_tasks" => $this->faker->sentence(),
            "person_id" => Person::factory(),
        ];
    }
}
