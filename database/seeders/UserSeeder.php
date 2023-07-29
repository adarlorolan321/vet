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
                'name' => 'Dentist',
                
                'email' => 'dentist@admin.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Admin',
               
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Test',
                'email' => 'test@admin.com',
                'password' => bcrypt('password'),
            ],
        ];
        foreach($users as $user) {
            $exist = User::where('email',$user['email'])->first();
            if(!$exist) {
                User::create($user);
            }
        }
    }
}
