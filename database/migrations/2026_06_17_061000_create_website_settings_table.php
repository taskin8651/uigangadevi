<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('site_url')->nullable();
            $table->text('footer_description')->nullable();
            $table->string('copyright_text')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->string('address_line')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('primary_email')->nullable();
            $table->string('admission_email')->nullable();
            $table->string('exam_email')->nullable();
            $table->string('documents_email')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('admission_phone')->nullable();
            $table->string('exam_phone')->nullable();
            $table->string('documents_phone')->nullable();

            $table->string('office_days')->nullable();
            $table->string('office_time')->nullable();
            $table->string('calling_hours')->nullable();
            $table->string('closed_days')->nullable();

            $table->text('map_embed_url')->nullable();
            $table->text('map_link')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $permissions = [
            80 => 'website_setting_access',
            81 => 'website_setting_edit',
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
                'website_setting_access',
                'website_setting_edit',
            ])
            ->pluck('id');

        DB::table('permission_role')
            ->whereIn('permission_id', $permissionIds)
            ->delete();

        DB::table('permissions')
            ->whereIn('id', $permissionIds)
            ->delete();

        Schema::dropIfExists('website_settings');
    }
};
