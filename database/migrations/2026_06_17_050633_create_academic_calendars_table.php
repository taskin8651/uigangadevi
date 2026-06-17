<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('academic_session');
            $table->text('short_description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('academic_session');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_calendars');
    }
};