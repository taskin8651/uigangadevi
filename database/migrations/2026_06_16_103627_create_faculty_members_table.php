<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculty_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects')
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('faculty_category')->nullable();
            $table->string('designation')->nullable();
            $table->string('employee_id')->nullable()->unique();

            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();

            $table->date('joining_date')->nullable();

            $table->string('teaching_experience')->nullable();
            $table->string('research_experience')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('biography')->nullable();

            $table->json('qualifications')->nullable();
            $table->json('specializations')->nullable();
            $table->json('subjects_taught')->nullable();
            $table->json('research_interests')->nullable();
            $table->json('publications')->nullable();
            $table->json('awards')->nullable();
            $table->json('responsibilities')->nullable();
            $table->json('memberships')->nullable();
            $table->json('seminars')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('faculty_category');
            $table->index('status');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_members');
    }
};