<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super Admin', 
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'SuperAdmin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo([
            'role-list',
            
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ]);
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'User', 
            'email' => 'user@admin.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'User']);
        $role->givePermissionTo([
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ]);
        $user->assignRole([$role->id]);
    }
}
