<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instagram_settings', function (Blueprint $table) {
            $table->id();
            $table->text('access_token')->nullable();
            $table->string('user_id')->nullable();
            $table->string('username')->nullable()->default('syafaaturrasul');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instagram_settings');
    }
};
