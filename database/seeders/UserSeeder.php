<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [

                'first_name' => 'Dentist',
                'mobile_no' => '123456789',
                'barangay' => '1',
                'city' => '1',
                'province' => '1',
                'last_name' => 'Dentist',
                'email' => 'dentist@admin.com',
                'password' => bcrypt('password'),
            ],
            [

                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'barangay' => '1',
                'city' => '1',
                'province' => '1',
                'mobile_no' => '123456789',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ],
            [
                'first_name' => 'Test',
                'barangay' => '1',
                'mobile_no' => '123456789',
                'city' => '1',
                'province' => '1',
                'last_name' => 'Test',
                'email' => 'test@admin.com',
                'password' => bcrypt('password'),
            ],
        ];
        foreach ($users as $user) {
            $exist = User::where('email', $user['email'])->first();
            if (!$exist) {
                User::create($user);
            }
        }
    }
}
