<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ساخت Role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        // ساخت کاربر
        $user = User::firstOrCreate(
            [
                'phoneNumber' => '09139638917',
            ],
            [
                'nameAndFamily' => 'مدیر سیستم',
                'password' => Hash::make('00981920'),
                'userType' => 'admin',
            ]
        );

        // اختصاص Role به کاربر
        $user->assignRole($adminRole);
    }
}
