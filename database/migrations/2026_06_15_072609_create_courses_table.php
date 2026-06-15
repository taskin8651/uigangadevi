<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_name')->nullable();

            $table->string('level')->nullable();
            $table->string('duration')->nullable();
            $table->string('course_type')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('eligibility')->nullable();
            $table->longText('admission_process')->nullable();

            $table->json('highlights')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};