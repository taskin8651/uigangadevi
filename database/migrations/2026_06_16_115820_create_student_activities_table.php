<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_activities', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('category')->nullable();
            $table->date('activity_date')->nullable();

            $table->string('venue')->nullable();
            $table->string('organizer')->nullable();
            $table->string('guest_name')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->json('activity_highlights')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->json('participants')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('category');
            $table->index('activity_date');
            $table->index('is_featured');
            $table->index('sort_order');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_activities');
    }
};