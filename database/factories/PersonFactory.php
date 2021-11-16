<?php

namespace Database\Factories;

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
        $ranks = array_merge([1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
        [
            "وظيفة سامية",
            "عضو لجنة إنتخابية بلدية",
            "رئيس لجنة إنتخابية بلدية",
            "عضو لجنة مراجعة القوائم الإنتخابية",
            "رئيس لجنة مراجعة القوائم الإنتخابية",
        ]);
        return [
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "birth_place" => $this->faker->city(),
            "original_job" => $this->faker->sentence(),
            "birthdate" => Carbon::now()->subYears(rand(18, 60))->format("Y-m-d"),
            "requisition_date" => "2021-11-15",
            "rank" => $ranks[rand(0, 24)],
            "commission" => "willaya de souk Ahras",
            "user_id" => User::factory(),
        ];
    }
}
