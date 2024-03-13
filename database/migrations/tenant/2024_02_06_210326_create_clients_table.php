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
        Schema::create('client', function (Blueprint $table) {
            $table->id('id_client');
            $table->unsignedBigInteger('id_person');
            $table->string('client_code');
            $table->string('ruc');
            $table->string('company_name');
            //$table->string('address');
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
            //$table->string('email');
            $table->date('birth_date');
            $table->string('warehouse_code');
            $table->string('customer_type');
            $table->string('credit_days');
            $table->string('GROUPCLI_CODE');
            $table->string('Sunat_Update');
            $table->string('client');
            $table->string('contact');
            //$table->timestamp('creation_date');
            $table->string('ROUTE_GROUP');
            $table->string('sunat_query');
            $table->string('BEACH');
            $table->string('migration_flag');
            $table->string('migration_id');
            $table->timestamps();

            // Add inherit
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
        });

        // Execute raw SQL to inherit from person
        DB::statement('ALTER TABLE client INHERIT person;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
