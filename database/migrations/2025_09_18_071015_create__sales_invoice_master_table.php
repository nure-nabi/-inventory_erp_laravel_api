<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_master', function (Blueprint $table) {
            $table->string('VoucherNo', 50)->primary();//unique constraint
             $table->date('VDate')->format('Y-m-d');
            $table->date('VTime')->format('Y-m-d');
             $table->date('DueDate')->format('Y-m-d');
            $table->foreignId('LedgerId')
            ->references('LedgerId')
            ->on('general_ledger')
            ->oDelete('casecade');
             $table->string('PartyName');
        
            $table->foreignId('SalesmanId')
            ->references('id')
            ->on('users')
            ->oDelete('casecade');
            $table->decimal('CurrencyRate',8, 2);//PaymentType
            $table->decimal('BasicAmount',8, 2);
            $table->decimal('NetAmount',8, 2); // Use boolean for true/false values
            $table->string('PaymentType');
            $table->string('Remarks');
            $table->string('EnterBy', 100);
            $table->timestamp('EnterDate'); // Use 
            $table->string('Gadget', 100);
            $table->string('IsBillCancel', 10)->nullable();
            $table->string('PSGImg')->nullable(); // Use nullable if the field is optional
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
        Schema::dropIfExists('sales_invoice_master');
    }
}
