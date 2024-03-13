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
        Schema::create('price_list', function (Blueprint $table) {
            $table->id('id_list_price');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        //DB::statement('ALTER TABLE price_lists OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_list');
    }
};
