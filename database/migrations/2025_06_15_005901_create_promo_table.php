<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_promo');
            $table->text('deskripsi_promo')->nullable();
            $table->string('gambar_promo')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};

