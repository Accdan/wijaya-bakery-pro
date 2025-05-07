<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pengguna');
            $table->string('username')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('no_telepon');
            $table->string('password');
            $table->uuid('role_id');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
