<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_bank_details', function (Blueprint $table) {
           $table->id('VoucherNo');
            $table->foreignId('SalesmanId')
            ->references('SalesmanId')
            ->on('users')
            ->oDelete('casecade');
            $table->foreignId('LedgerId')
            ->references('LedgerId')
            ->on('general_ledger')
            ->oDelete('casecade');
            $table->decimal('RecAmt',8, 2);
            $table->decimal('PayAmt',8, 2);
            $table->decimal('RecLocalAmt',8, 2); // Use timestamp instead of datetime if only date and time are needed
            $table->decimal('PayLocalAmt',8, 2);
            $table->timestamp('EnteryDate');
            $table->string('Naration')->nullable(); // Use 
           $table->string('EnterBy', 100);
            // nullable if the field is optional
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
        Schema::dropIfExists('cash_bank_details');
    }
}
