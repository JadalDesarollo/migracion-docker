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
        Schema::create('locals', function (Blueprint $table) {
            $table->id('id_local');
            $table->string('name');
            $table->string('local_code', 45)->nullable();
            $table->string('telphone_number', 45)->nullable();
            $table->string('address', 250)->nullable();
            $table->timestamps();
            //$table->softDeletes();
        });

        // Schema::table('local', function (Blueprint $table) {
        //     $table->unique('id_local');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locals');
    }
};
