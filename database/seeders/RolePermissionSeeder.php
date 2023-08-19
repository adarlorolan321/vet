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


                'store dental_service',
                'access dental_service',
                'insert dental_service',
                'edit dental_service',
                'update dental_service',
                'delete dental_service',
                'view dental_service',

                'store checkup_history',
                'access checkup_history',
                'insert checkup_history',
                'edit checkup_history',
                'update checkup_history',
                'delete checkup_history',
                'view checkup_history',

               
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

                'view checkup_history',

            ],
           
        ];
        foreach ($roles as $role => $permissions) {
            $db_role = Role::where('name', $role)->first();
            if (!$db_role) {
               
                $db_role = Role::create(['name' => $role]);
            }
            
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
