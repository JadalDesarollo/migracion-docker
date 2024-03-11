<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('employees');

        Schema::create('employees', function (Blueprint $table) {
            $table->id('id_employee');
            $table->unsignedBigInteger('id_person');
            $table->unsignedBigInteger('id_user_view')->nullable(); // id_user_view
            //$table->unsignedBigInteger('id_user_view')->nullable();
            $table->string('first_name', 80);
            $table->string('last_name', 80);
            $table->string('address', 45);
            $table->string('document_number', 45);
            $table->string('telphone_number', 45);
            $table->string('email', 45);
            $table->boolean('state')->default(true);
            $table->date('date_of_birth');
            $table->date('creation_date');
            $table->unsignedBigInteger('id_document_type');
            $table->timestamps();

            // Add foreign key constraints if needed
            // $table->foreign('id_user_view')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('id_document_type')->references('id')->on('document_types')->onDelete('set null');
        });

        // Execute raw SQL to inherit from person
        DB::statement('ALTER TABLE employees INHERIT persons;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
