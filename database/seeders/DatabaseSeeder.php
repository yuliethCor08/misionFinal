<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Movie;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // create permissions
        Permission::create(['name' => 'edit movies']);
        Permission::create(['name' => 'delete movies']);
        Permission::create(['name' => 'publish movies']);
        Permission::create(['name' => 'unpublish movies']);

        // create roles and assign created permissions

        // this can be done as separate statements
       // $user_admin = Role::create(['name' => 'user_admin']);
        //$user_admin->givePermissionTo(['edit movies', 'delete movies', 'publish movies','unpublish movies']);

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish movies', 'unpublish movies']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
