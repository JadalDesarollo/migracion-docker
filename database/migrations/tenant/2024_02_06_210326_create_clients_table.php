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
            $table->string('client_code')->nullable();
            $table->string('ruc')->nullable();
            $table->string('company_name')->nullable();
            //$table->string('address');
            $table->string('district_code')->nullable();
            $table->string('department_code')->nullable();
            $table->string('zone_code')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_alternative')->nullable();
            $table->string('fax')->nullable();
            $table->string('currency_limit')->nullable();
            $table->string('amount_limit')->nullable();
            $table->string('available_amount')->nullable();
            $table->string('credit_blocked')->nullable();
            //$table->string('email');
            $table->date('birth_date')->nullable();
            $table->string('warehouse_code')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('credit_days')->nullable();
            $table->string('GROUPCLI_CODE')->nullable();
            $table->string('Sunat_Update')->nullable();
            $table->string('client')->nullable();
            $table->string('contact')->nullable();
            //$table->timestamp('creation_date');
            $table->string('ROUTE_GROUP')->nullable();
            $table->string('sunat_query')->nullable();
            $table->string('BEACH')->nullable();
            $table->string('migration_flag')->nullable();
            $table->string('migration_id')->nullable();
            $table->timestamps();

            // Add inherit
            $table->string('first_name', 80);
            $table->string('last_name', 80);
            $table->string('document_number', 45);
            $table->string('telphone_number', 45);
            $table->string('email', 45);
            $table->boolean('state')->default(true);
            $table->date('date_of_birth');
            $table->date('creation_date');
            $table->unsignedBigInteger('id_document_type');

            //relation
            $table->unsignedBigInteger('id_type_client');

            //forain key
            $table->foreign('id_type_client')->references('id_type_client')->on('type_client');
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
