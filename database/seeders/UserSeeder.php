<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::where('name', 'owner')->first();
        $staffRole = Role::where('name', 'staff')->first();

        // OWNER
        User::create([
            'name' => 'Owner Abadi Nan Jaya',
            'email' => 'owner_abadinanjaya@test.com',
            'password' => Hash::make('password'),
            'tenant_id' => 1,
            'role_id' => $ownerRole->id,
        ]);

        User::create([
            'name' => 'Owner Maju Mundur',
            'email' => 'owner_majumundur@test.com',
            'password' => Hash::make('password'),
            'tenant_id' => 2,
            'role_id' => $ownerRole->id,
        ]);

        // STAFF
        User::create([
            'name' => 'Staff Maju Terus',
            'email' => 'staff_majujterus@test.com',
            'password' => Hash::make('password'),
            'tenant_id' => 3,
            'role_id' => $staffRole->id,
        ]);

        User::create([
            'name' => 'Staff Sukses Jaya Abadi',
            'email' => 'staff_suksesjaya@tst.com',
            'password' => Hash::make('password'),
            'tenant_id' => 4,
            'role_id' => $staffRole->id,
        ]);
    }
}
