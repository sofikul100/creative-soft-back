<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::create(['name' => 'superadmin']);

        $permissions = [
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission.menu',
                    'add.permission',
                    'edit.permission',
                    'delete.permission'
                ],

            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.menu',
                    'add.role',
                    'edit.role',
                    'delete.role'
                ],
            ],
            [
                'group_name' => 'role_in_permission',
                'permissions' => [
                    'add.role_in_permission',
                    'all.role_in_permission',
                    'edit.role_in_permission',
                    'delete.role_in_permission'
                ],
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'all.user_menu',
                    'add.user',
                    'edit.user',
                    'delete.user'
                ],
            ],
            [
                'group_name' => 'logo',
                'permissions' => [
                    'add.logo',
                    'edit.logo',
                    'delete.logo',
                    'logo.menu'
                ],
            ],
            [
                'group_name' => 'service',
                'permissions' => [
                    'service.menu',
                    'add.service',
                    'edit.service',
                    'delete.service'
                ],
            ],
            [
                'group_name' => 'team',
                'permissions' => [
                    'team.menu',
                    'add.team',
                    'edit.team',
                    'delete.team',
                    'status.team'
                ],
            ],

            [
                'group_name' => 'client_say',
                'permissions' => [
                    'clientsay.menu',
                    'add.clientsay',
                    'edit.clientsay',
                    'delete.clientsay',
                    'status.clientsay'
                ],
            ],

            [
                'group_name' => 'slider',
                'permissions' => [
                    'slider.menu',
                    'add.slider',
                    'edit.slider',
                    'delete.slider',
                    'status.slider'
                ],
            ],

            [
                'group_name' => 'project',
                'permissions' => [
                    'project.menu',
                    'status.project',
                    'edit.project',
                    'delete.project',
                    'add.project'
                ],
            ],

            [
                'group_name' => 'project_d_section',
                'permissions' => [
                    'project_d_section.menu',
                    'status.project_d_section',
                    'edit.project_d_section',
                    'delete.project_d_section',
                    'add.project_d_section'
                ],
            ],

            [
                'group_name' => 'project_price',
                'permissions' => [
                    'project_price.menu',
                    'status.project_price',
                    'add.project_price',
                    'edit.project_price',
                    'delete.project_price',
                    'populer.project_price'
                ],
            ],

        ];

        //create and assign permission===//
        $user = User::first();
        for($i = 0; $i < count($permissions);$i++){
            $permission_groups = $permissions[$i]['group_name'];
            
            for($j = 0; $j < count($permissions[$i]['permissions']);$j++){
                $permission = Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=>$permission_groups]);

                $super_admin->givePermissionTo($permission);
                
                $user->assignRole($super_admin);
            }

        }
    }
}
