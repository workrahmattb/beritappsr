<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day'); // Senin, Selasa, Rabu, Kamis, Jumat, Sabtu
            $table->string('time_start'); // 07:30
            $table->string('time_end');   // 09:00
            $table->string('subject');
            $table->string('teacher')->nullable();
            $table->string('class')->nullable(); // Tingkat kelas, e.g. VII A, VIII B
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('day');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_schedules');
    }
};
