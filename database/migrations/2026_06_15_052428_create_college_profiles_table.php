<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('college_profiles', function (Blueprint $table) {
            $table->id();

            // About College
            $table->string('about_badge')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description_one')->nullable();
            $table->text('about_description_two')->nullable();
            $table->string('image_badge_title')->nullable();
            $table->string('image_badge_subtitle')->nullable();
            $table->json('about_points')->nullable();

            // Vision
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->json('vision_points')->nullable();

            // Mission
            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->json('mission_points')->nullable();

            // Core Values
            $table->string('core_value_title')->nullable();
            $table->text('core_value_description')->nullable();
            $table->json('core_value_points')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('college_profiles');
    }
};