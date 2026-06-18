<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->nullable();
            $table->enum('type', ['image', 'video'])->default('image');
            $table->text('description')->nullable();
            $table->text('video_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $permissions = [
            90 => 'gallery_management_access',
            91 => 'gallery_create',
            92 => 'gallery_edit',
            93 => 'gallery_show',
            94 => 'gallery_delete',
            95 => 'gallery_access',
        ];

        foreach ($permissions as $id => $permission) {
            DB::table('permissions')->updateOrInsert(
                ['id' => $id],
                [
                    'title' => $permission,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        if (DB::table('roles')->where('id', 1)->exists()) {
            foreach (array_keys($permissions) as $permissionId) {
                DB::table('permission_role')->updateOrInsert([
                    'permission_id' => $permissionId,
                    'role_id' => 1,
                ]);
            }
        }
    }

    public function down(): void
    {
        $permissionIds = DB::table('permissions')
            ->whereIn('title', [
                'gallery_management_access',
                'gallery_create',
                'gallery_edit',
                'gallery_show',
                'gallery_delete',
                'gallery_access',
            ])
            ->pluck('id');

        DB::table('permission_role')
            ->whereIn('permission_id', $permissionIds)
            ->delete();

        DB::table('permissions')
            ->whereIn('id', $permissionIds)
            ->delete();

        Schema::dropIfExists('galleries');
    }
};
