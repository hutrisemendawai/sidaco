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
        Schema::table('sidat_data', function (Blueprint $table) {
            $table->boolean('iscreatedbyenum')->default(false);
            $table->boolean('isapproved')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidat_data', function (Blueprint $table) {
            $table->dropColumn(['iscreatedbyenum', 'isapproved']);
        });
    }
};
