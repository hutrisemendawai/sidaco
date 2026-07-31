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
            $table->index(['isapproved', 'country', 'date'], 'sidat_data_approved_country_date_idx');
            $table->index(['isapproved', 'country', 'province'], 'sidat_data_approved_country_province_idx');
            $table->index(['isapproved', 'country', 'species_name'], 'sidat_data_approved_country_species_idx');
            $table->index(['isapproved', 'country', 'river'], 'sidat_data_approved_country_river_idx');
            $table->index(['isapproved', 'country', 'stage'], 'sidat_data_approved_country_stage_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidat_data', function (Blueprint $table) {
            $table->dropIndex('sidat_data_approved_country_date_idx');
            $table->dropIndex('sidat_data_approved_country_province_idx');
            $table->dropIndex('sidat_data_approved_country_species_idx');
            $table->dropIndex('sidat_data_approved_country_river_idx');
            $table->dropIndex('sidat_data_approved_country_stage_idx');
        });
    }
};
