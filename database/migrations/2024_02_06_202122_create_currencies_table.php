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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id('id_currency');
            $table->string('currency_code', 255);
            $table->string('currency_type', 255);
            $table->string('simple_description', 255);
            $table->smallInteger('complete_description');
            $table->timestamps();
            //$table->softDeletes();
            //$table->primary('idcurrency', 'CURRENCY_pk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
