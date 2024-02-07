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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
