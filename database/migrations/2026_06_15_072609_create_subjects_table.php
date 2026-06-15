<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('department_name')->nullable();
            $table->string('short_name')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->json('academic_areas')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->json('career_opportunities')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};