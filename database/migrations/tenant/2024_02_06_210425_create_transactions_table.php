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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('id_transaction')->unique();
            $table->unsignedBigInteger('id_user_view')->nullable();
            $table->unsignedBigInteger('id_employee')->nullable();

            $table->foreign('id_user_view')->references('id_user_view')->on('user_view')->onDelete('set null')->onUpdate('cascade');

            // $table->foreign('id_employee')
            //     ->references('id_employee')
            //     ->on('employee')
            //     ->onDelete('set null')
            //     ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
