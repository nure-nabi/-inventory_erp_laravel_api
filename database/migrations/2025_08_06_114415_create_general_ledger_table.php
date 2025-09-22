<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_ledger', function (Blueprint $table) {
            $table->id('LedgerId'); // AUTO_INCREMENT primary key
            $table->string('GlDesc');
            $table->string('GlCategory');
            $table->foreignId('SalesmanId')
            ->references('id')
            ->on('users')
            ->oDelete('casecade');
            $table->decimal('CreditLimit', 8, 2)->nullable();
            $table->string('Address')->nullable();
            $table->string('MobileNo');
            $table->string('Email')->nullable();
             $table->date('DOB')->format('Y-m-d'); 
            $table->string('Gender');
            $table->string('GLImage')->nullable();
            $table->boolean('Status'); // Use boolean for true/false values
            $table->string('EnterBy', 100);
            $table->date('EnterDate')->format('Y-m-d'); 
            $table->string('Gadget', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_ledger');
    }
}
