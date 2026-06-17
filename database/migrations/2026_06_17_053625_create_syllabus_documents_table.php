<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('syllabus_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects')
                ->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('academic_session', 50);
            $table->string('semester', 100)->nullable();

            $table->string('document_type', 100)->nullable();
            $table->string('curriculum_type', 100)->nullable();
            $table->string('effective_from', 100)->nullable();

            $table->text('short_description')->nullable();

            $table->text('external_url')->nullable();
            $table->string('button_text')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('course_id');
            $table->index('subject_id');
            $table->index('academic_session');
            $table->index('document_type');
            $table->index('is_featured');
            $table->index('sort_order');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('syllabus_documents');
    }
};