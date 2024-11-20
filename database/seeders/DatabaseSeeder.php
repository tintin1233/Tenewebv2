<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRoles;
use App\Models\Tenement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Tenement::factory(2)->create();

        $userRoles = UserRoles::cases();

        collect($userRoles)->map(function($role) {
            Role::create([
                'name' => $role->value
            ]);
        });


        $superAdminRole = Role::where('name', UserRoles::SUPERADMIN->value)->first();
        $tenantRole = Role::where('name', UserRoles::TENANT->value)->first();


        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => "superadmin@superadmin.com",
            'password' => Hash::make('superadmin123')
        ]);

        // $tenant= User::create([
        //     'name' => 'tenant',
        //     'email' => "tenant@tenant.com",
        //     'password' => Hash::make('tenant123')
        // ]);




        $superAdmin->assignRole($superAdminRole);
        // $tenant->assignRole($tenantRole);



        // $this->call([
        //     RoomSeeder::class
        // ]);
    }
}
