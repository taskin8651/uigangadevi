<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category', 100)->nullable();
            $table->date('notice_date')->nullable();
            $table->text('short_description')->nullable();
            $table->text('external_url')->nullable();
            $table->string('button_text')->nullable();
            $table->boolean('is_latest')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('category');
            $table->index('notice_date');
            $table->index('is_latest');
            $table->index('sort_order');
            $table->index('status');
        });

        $permissions = [
            70 => 'notice_management_access',
            71 => 'notice_create',
            72 => 'notice_edit',
            73 => 'notice_show',
            74 => 'notice_delete',
            75 => 'notice_access',
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

        $adminRole = DB::table('roles')->where('id', 1)->first();

        if ($adminRole) {
            $permissionIds = DB::table('permissions')
                ->whereIn('title', array_values($permissions))
                ->pluck('id');

            foreach ($permissionIds as $permissionId) {
                DB::table('permission_role')->updateOrInsert([
                    'permission_id' => $permissionId,
                    'role_id' => 1,
                ]);
            }
        }
    }

    public function down(): void
    {
        $permissions = [
            'notice_management_access',
            'notice_create',
            'notice_edit',
            'notice_show',
            'notice_delete',
            'notice_access',
        ];

        $permissionIds = DB::table('permissions')
            ->whereIn('title', $permissions)
            ->pluck('id');

        DB::table('permission_role')
            ->whereIn('permission_id', $permissionIds)
            ->delete();

        DB::table('permissions')
            ->whereIn('id', $permissionIds)
            ->delete();

        Schema::dropIfExists('notices');
    }
};
