<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            "name" => "admin",
            "email" => "admin@mail.com",
        ]);

        $role = Role::create(["name" => "admin"]);

        $user->assignRole("admin");


        Person::factory()
            ->count(10)
            ->has(
                Requisition::factory()
            )
            ->for($user)
            ->create();

        // Requisition::factory()->count(10)->create();
    }
}
