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
        Schema::table('ingredient_menu', function (Blueprint $table) {
            if (Schema::hasColumn('ingredient_menu', 'takaran')) {
                $table->dropColumn('takaran');
            }

            $table->string('jumlah')->after('ingredient_id');
            $table->string('satuan')->after('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient_menu', function (Blueprint $table) {
            $table->dropColumn(['jumlah', 'satuan']);
            $table->string('takaran')->after('ingredient_id');
        });
    }
};
