<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage_categories']);
        Permission::create(['name' => 'manage_tags']);
        Permission::create(['name' => 'manage_users']);

        $adminRole = Role::create(['name' => 'admin']);
        
        $adminRole->givePermissionTo(['manage_categories','manage_tags']);
        
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo('manage_users');

        $adminUser = User::Create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',      
            'password' => Hash::make('password'),
        ]
        ); 
        $adminUser->assignRole('admin');
        $superAdminUser = User::Create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password123'),
        ]
        );
        $superAdminUser->assignRole('super-admin');

        

    
    }
}
