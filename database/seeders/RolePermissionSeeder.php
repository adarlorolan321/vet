<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin' => [
                'access user',
                'insert user',
                'edit user',
                'update user',
                'delete user',
                'view user',

                
                'access apointment',
                'insert apointment',
                'edit apointment',
                'update apointment',
                'delete apointment',
                'view apointment',
                
            ],
            'Dentist' => [
                'access user',
                'insert user',
                'edit user',
                'update user',
                'delete user',
                'view user',

                'access apointment',
                'insert apointment',
                'edit apointment',
                'update apointment',
                'delete apointment',
                'view apointment',

                
            ],
            

            'Customer' => [
                'access user',
                'insert user',
                'edit user',
                'update user',
                'delete user',
                'view user',

                'access apointment',
                'insert apointment',
                'edit apointment',
                'update apointment',
                'delete apointment',
                'view apointment',

            ],
           
        ];
        foreach ($roles as $role => $permissions) {
            $db_role = Role::where('name', $role)->first();
            if (!$db_role) {
                // CREATE NEW ROLE
                $db_role = Role::create(['name' => $role]);
            }
            // ADD PERMISSION
            foreach ($permissions as $permission) {
                $new_permission = Permission::where('name', $permission)->first();
                if (!$new_permission) {
                    $new_permission = Permission::create([
                        'name' => $permission
                    ]);
                }
                if (!$db_role->hasPermissionTo($permission)) {
                    $db_role->givePermissionTo($permission);
                }
            }
        }

        // ASSIGN ADMIN ROLE
        $admin = User::where('email', 'admin@admin.com')->first();
        if (!is_null($admin)) {
            $admin->assignRole('Admin'); // ADMIN
        }
        $admin = User::where('email', 'dentist@admin.com')->first();
        if (!is_null($admin)) {
            $admin->assignRole('Dentist'); // ADMIN
        }
     
    }
}
