<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('contact_settings');

        Schema::create('contact_whatsapp_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable()->default('Kantor Pusat');
            $table->string('nomor_wa');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_whatsapp_numbers');

        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable()->default('Kantor Pusat');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->text('google_maps_embed')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
};
