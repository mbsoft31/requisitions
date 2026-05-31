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
        Permission::findOrCreate( 'delete person');

        $role->givePermissionTo('delete person');
        $role->givePermissionTo('manage requisitions');
        $role->givePermissionTo('export/import');

        $user->assignRole("admin");

        $user = User::factory()->create([
            "name" => "manager",
            "email" => "manager@mail.com",
        ]);

        $role = Role::create(["name" => "manager"]);

        Permission::findOrCreate('manage requisitions');
        Permission::findOrCreate( 'export/import');

        $role->givePermissionTo('manage requisitions');
        $role->givePermissionTo('export/import');

        $user->assignRole("manager");

        $user = User::factory()->create([
            "name" => "hadi",
            "email" => "hadi@mail.com",
        ]);

        $role = Role::create(["name" => "exporter"]);

        $role->givePermissionTo('export/import');

        $user->assignRole("exporter");
    }
}
