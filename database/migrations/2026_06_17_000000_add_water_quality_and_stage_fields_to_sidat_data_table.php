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
            // Water Quality fields
            $table->string('fish_photo')->nullable()->after('price_per_kg');
            $table->decimal('suhu', 5, 2)->nullable()->after('fish_photo');
            $table->decimal('ph_air', 5, 2)->nullable()->after('suhu');
            $table->decimal('salinitas', 5, 2)->nullable()->after('ph_air');
            $table->boolean('hujan')->default(false)->after('salinitas');
            
            // Stage type fields
            $table->string('stage_type')->nullable()->after('hujan'); // Glasseel, Elver, Yellow Eel
            $table->integer('sampling')->nullable()->after('stage_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidat_data', function (Blueprint $table) {
            $table->dropColumn([
                'fish_photo',
                'suhu',
                'ph_air',
                'salinitas',
                'hujan',
                'stage_type',
                'sampling',
            ]);
        });
    }
};
