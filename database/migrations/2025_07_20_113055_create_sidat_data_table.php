<?php
// Paste this code into your ...create_sidat_data_table.php file

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
        // This schema defines the structure of the 'sidat_data' table
        Schema::create('sidat_data', function (Blueprint $table) {
            $table->id();
            // This creates a foreign key linking this table to the 'users' table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('day');
            $table->string('month');
            $table->string('country');
            $table->string('province');
            $table->string('regency');
            $table->string('district');
            $table->string('river');
            $table->string('stage');
            $table->string('fisher_name');
            $table->integer('number_of_fisher');
            $table->string('type_of_fishing_gear');
            $table->integer('number_of_fishing_gear');
            $table->string('species_name');
            $table->decimal('operation_time', 8, 2);
            $table->decimal('total_weight_per_day', 8, 2);
            $table->decimal('price_per_kg', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidat_data');
    }
};
