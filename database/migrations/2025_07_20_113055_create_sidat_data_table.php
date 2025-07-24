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
            $table->string('district');
            $table->string('river');
            $table->string('stage');
            $table->string('type');
            $table->string('fisherman_name');
            $table->string('type_of_fishing_gear');
            $table->integer('number_of_fishing_gear');
            $table->string('species_name');
            $table->decimal('operation_time', 8, 2);
            $table->decimal('total_weight_per_day', 8, 2);
            $table->decimal('price_per_kg', 15, 2);
            $table->decimal('total_weight_per_fisher', 8, 2);
            $table->integer('estimate_number_by_fisher_per_day');
            $table->decimal('total_weight_elver_kg', 8, 2)->nullable();
            $table->decimal('price_elver', 15, 2)->nullable();
            $table->decimal('total_weight_pk_kg', 8, 2)->nullable();
            $table->decimal('price_pk', 15, 2)->nullable();
            $table->decimal('total_weight_pb_kg', 8, 2)->nullable();
            $table->decimal('price_pb', 15, 2)->nullable();
            $table->decimal('total_weight_fingerling', 8, 2)->nullable();
            $table->decimal('price_fingerling', 15, 2)->nullable();
            $table->integer('amount_individual_elver_size')->nullable();
            $table->integer('amount_individual_pk_size')->nullable();
            $table->integer('amount_individual_pb_size')->nullable();
            $table->integer('amount_individual_fingerling_size')->nullable();
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
