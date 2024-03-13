<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_sale_document', function (Blueprint $table) {
            $table->id('id_order_sale_document');
            $table->unsignedBigInteger('id_order');

            // Foreign key constraint for id_order
           // $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade')->onUpdate('cascade');

            // Primary key constraint
            //$table->primary('id_order_sale_document', 'order_sale_document_pk');
            $table->timestamps();
        });

        // Alter table for foreign key constraint
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->dropForeign('currency_fk');
        //     $table->foreign('idcurrency')->references('idcurrency')->on('currencies')->onDelete('set null')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop table
        Schema::dropIfExists('order_sale_document');

        // Restore foreign key constraint
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->dropForeign(['idcurrency']);
        //     $table->foreign('idcurrency')->references('idcurrency')->on('currencies')->onDelete('set null')->onUpdate('cascade');
        // });
    }
};
