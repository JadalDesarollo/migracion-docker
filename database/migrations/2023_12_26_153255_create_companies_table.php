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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('identity_document_type_id')->nullable();
            $table->string('number', 255)->nullable();
            $table->string('name', 255);
            $table->string('trade_name', 255)->nullable();
            $table->char('soap_send_id', 2)->default('01');
            $table->char('soap_type_id', 2)->nullable();
            $table->string('soap_username', 255)->nullable();
            $table->string('soap_password', 255)->nullable();
            $table->string('soap_url', 255)->nullable();
            $table->string('certificate', 255)->nullable();
            $table->date('certificate_due')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('detraction_account', 255)->nullable();
            $table->string('logo_store', 255)->nullable();
            $table->string('favicon', 150)->nullable();
            $table->string('img_firm', 255)->nullable();
            $table->tinyInteger('operation_amazonia')->default(0);
            $table->text('cod_digemid')->nullable();
            $table->string('commerce_code')->nullable();//codigo de comercio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
