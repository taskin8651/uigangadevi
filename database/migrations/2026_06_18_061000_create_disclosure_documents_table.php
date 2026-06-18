<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disclosure_documents', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['rti', 'naac'])->default('rti');
            $table->string('title');
            $table->string('category')->nullable();
            $table->string('year')->nullable();
            $table->text('external_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $permissions = [
            110 => 'disclosure_document_management_access',
            111 => 'disclosure_document_create',
            112 => 'disclosure_document_edit',
            113 => 'disclosure_document_show',
            114 => 'disclosure_document_delete',
            115 => 'disclosure_document_access',
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
                'disclosure_document_management_access',
                'disclosure_document_create',
                'disclosure_document_edit',
                'disclosure_document_show',
                'disclosure_document_delete',
                'disclosure_document_access',
            ])
            ->pluck('id');

        DB::table('permission_role')->whereIn('permission_id', $permissionIds)->delete();
        DB::table('permissions')->whereIn('id', $permissionIds)->delete();

        Schema::dropIfExists('disclosure_documents');
    }
};
