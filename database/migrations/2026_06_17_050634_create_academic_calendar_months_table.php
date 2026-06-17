<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_calendar_months', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academic_calendar_id')
                ->constrained('academic_calendars')
                ->cascadeOnDelete();

            $table->string('month_name');
            $table->unsignedTinyInteger('month_value');
            $table->unsignedTinyInteger('display_number');

            $table->json('activities')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('academic_calendar_id');
            $table->index('month_value');
            $table->index('sort_order');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_calendar_months');
    }
};