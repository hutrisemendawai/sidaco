<?php
// Paste this code into your ...create_users_table.php file

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
        // This schema defines the structure of the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('first_name');
            $table->string('middle_name')->nullable(); // Optional field
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('email')->unique(); // Must be a unique email
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('address');
            $table->string('phone_number'); // For Indonesian format, validation will be in the controller
            $table->rememberToken();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};