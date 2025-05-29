<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->uuid('menu_id')->after('id');
            $table->decimal('jumlah', 8, 2)->after('nama_bahan');
            $table->string('satuan')->after('jumlah');

            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn(['menu_id', 'jumlah', 'satuan']);
        });
    }
};
