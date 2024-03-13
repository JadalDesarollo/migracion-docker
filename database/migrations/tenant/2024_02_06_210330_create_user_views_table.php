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
        Schema::create('user_view', function (Blueprint $table) {
            $table->id('id_user_view');
            $table->timestamps();
        });

        Schema::table('employee', function (Blueprint $table) {
            $table->foreign('id_user_view')->references('id_user_view')->on('user_view')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign(['id_user_view']);
        });

        Schema::dropIfExists('user_view');
    }
};
