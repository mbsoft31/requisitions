<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ranks = Person::$ranks;
        return [
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "birth_place" => $this->faker->city(),
            "original_job" => $this->faker->sentence(),
            "birthdate" => Carbon::now()->subYears(rand(18, 60))->format("Y-m-d"),
            "requisition_date" => "2021-11-15",
            "rank" => rand(1, 25),
            "commission" => "willaya de souk Ahras",
            "user_id" => User::factory(),
        ];
    }
}
