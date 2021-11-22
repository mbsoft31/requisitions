<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        Permission::findOrCreate('manage requisitions');
        Permission::findOrCreate( 'export/import');
        $role->givePermissionTo('manage requisitions');
        $role->givePermissionTo('export/import');
        $user->assignRole("admin");
        if ($user->can('manage requisitions')) dump('can manage requisitions');

        Person::factory()
            ->count(10)
            ->has(
                Requisition::factory()
                    ->count(2)
                    ->sequence(
                        ["type" => Requisition::$PREPARATION],
                        ["type" => Requisition::$MANAGEMENT],
                    )
            )
            ->for($user)
            ->create();

        // Requisition::factory()->count(10)->create();
    }
}
