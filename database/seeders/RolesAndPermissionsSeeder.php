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
        $adminRole->givePermissionTo(Permission::all());
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        
         $adminUser = User::Create([
            'name' => 'Admin',
            'email' => 'admin@blog.com',      
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]
        ); 
        $adminUser->assignRole('admin');
    
    }
}
