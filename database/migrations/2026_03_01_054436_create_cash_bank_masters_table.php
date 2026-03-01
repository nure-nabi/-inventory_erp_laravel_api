<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBankMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_bank_masters', function (Blueprint $table) {
             $table->id('VoucherNo');
            $table->dateTime('VDate'); // Consider specifying the length if necessary
            $table->dateTime('VTime'); // Specify length for better control
            $table->foreignId('LedgerId')
            ->references('LedgerId')
            ->on('general_ledger')
            ->oDelete('casecade');
            $table->foreignId('SalesmanId')
            ->references('SalesmanId')
            ->on('users')
            ->oDelete('casecade');
            $table->string('Remarks')->nullable();
            $table->string('EnterBy', 100);
            $table->timestamp('EnterDate'); // Use timestamp instead of datetime if only date and time are needed
            $table->string('Gadget', 100);
            $table->timestamp('CancelDate')->nullable();
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
        Schema::dropIfExists('cash_bank_masters');
    }
}
