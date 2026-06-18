<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 24,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 70,
                'title' => 'notice_management_access',
            ],
            [
                'id'    => 71,
                'title' => 'notice_create',
            ],
            [
                'id'    => 72,
                'title' => 'notice_edit',
            ],
            [
                'id'    => 73,
                'title' => 'notice_show',
            ],
            [
                'id'    => 74,
                'title' => 'notice_delete',
            ],
            [
                'id'    => 75,
                'title' => 'notice_access',
            ],
            [
                'id'    => 80,
                'title' => 'website_setting_access',
            ],
            [
                'id'    => 81,
                'title' => 'website_setting_edit',
            ],
            [
                'id'    => 90,
                'title' => 'gallery_management_access',
            ],
            [
                'id'    => 91,
                'title' => 'gallery_create',
            ],
            [
                'id'    => 92,
                'title' => 'gallery_edit',
            ],
            [
                'id'    => 93,
                'title' => 'gallery_show',
            ],
            [
                'id'    => 94,
                'title' => 'gallery_delete',
            ],
            [
                'id'    => 95,
                'title' => 'gallery_access',
            ],
            [
                'id'    => 100,
                'title' => 'hero_slide_management_access',
            ],
            [
                'id'    => 101,
                'title' => 'hero_slide_create',
            ],
            [
                'id'    => 102,
                'title' => 'hero_slide_edit',
            ],
            [
                'id'    => 103,
                'title' => 'hero_slide_show',
            ],
            [
                'id'    => 104,
                'title' => 'hero_slide_delete',
            ],
            [
                'id'    => 105,
                'title' => 'hero_slide_access',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrInsert(
                ['id' => $permission['id']],
                ['title' => $permission['title']]
            );
        }
    }
}
