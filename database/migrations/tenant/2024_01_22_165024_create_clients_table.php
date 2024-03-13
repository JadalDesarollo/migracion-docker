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
        Schema::create('client', function (Blueprint $table) {
            $table->id('id_client');
            $table->string('client_code');
            $table->string('ruc');
            $table->string('company_name');
            $table->string('address');
            $table->string('district_code');
            $table->string('department_code');
            $table->string('zone_code');
            $table->string('billing_address');
            $table->string('delivery_address');
            $table->string('phone');
            $table->string('phone_alternative');
            $table->string('fax');
            $table->string('currency_limit');
            $table->string('amount_limit');
            $table->string('available_amount');
            $table->string('credit_blocked');
            $table->string('email');
            $table->date('birth_date');
            $table->string('warehouse_code');
            $table->string('customer_type');
            $table->string('credit_days');
            $table->string('GROUPCLI_CODE');
            $table->string('Sunat_Update');
            $table->string('client');
            $table->string('contact');
            $table->timestamp('creation_date');
            $table->string('ROUTE_GROUP');
            $table->string('sunat_query');
            $table->string('BEACH');
            $table->string('migration_flag');
            $table->string('migration_id');
            $table->timestamps();

            // Add missing columns
            $table->integer('id_type_client');
            $table->integer('id_person');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document_number');
            $table->string('telphone_number');
            $table->boolean('state');
            $table->integer('id_document_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
