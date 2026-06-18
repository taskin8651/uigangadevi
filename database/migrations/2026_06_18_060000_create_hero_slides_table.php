<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->string('badge_icon')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('primary_button_text')->nullable();
            $table->text('primary_button_url')->nullable();
            $table->string('secondary_button_text')->nullable();
            $table->text('secondary_button_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $permissions = [
            100 => 'hero_slide_management_access',
            101 => 'hero_slide_create',
            102 => 'hero_slide_edit',
            103 => 'hero_slide_show',
            104 => 'hero_slide_delete',
            105 => 'hero_slide_access',
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
                'hero_slide_management_access',
                'hero_slide_create',
                'hero_slide_edit',
                'hero_slide_show',
                'hero_slide_delete',
                'hero_slide_access',
            ])
            ->pluck('id');

        DB::table('permission_role')
            ->whereIn('permission_id', $permissionIds)
            ->delete();

        DB::table('permissions')
            ->whereIn('id', $permissionIds)
            ->delete();

        Schema::dropIfExists('hero_slides');
    }
};
