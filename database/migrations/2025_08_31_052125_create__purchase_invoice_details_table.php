<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoice_details', function (Blueprint $table) {
             $table->id();
              // Define VoucherNo column
            $table->string('VoucherNo', 50);

               // Then add the foreign key
             $table->foreign('VoucherNo')
              ->references('VoucherNo')
              ->on('purchase_invoice_master')
              ->onDelete('cascade');
           // $table->string('VoucherNo', 50); // String 
            $table->foreignId('ProductId')
            ->references('ProductId')
            ->on('product')
            ->oDelete('casecade');
            $table->foreignId('ProductGrpId')
            ->references('CategoryId')
            ->on('category');
            $table->foreignId('ProductSubGrpId')
            ->nullable()
            ->references('ProductSubGrpId')
            ->on('sub_category')
            ->oDelete('casecade');
            $table->foreignId('SalesmanId')
            ->references('id')
            ->on('users')
            ->oDelete('casecade');
            $table->foreignId('LedgerId')
            ->references('LedgerId')
            ->on('general_ledger')
            ->oDelete('casecade');
            $table->string('Godown');
             $table->string('Unit');
            $table->decimal('Qty'); //   Consider specifying the length 
            $table->decimal('PurchaseRate'); // Specify length for 
            $table->decimal('BasicAmount',8, 2);
            $table->decimal('LabourRate',8,2)->nullable(); // 
            $table->decimal('NetAmount',8, 2); // Use boolean for true/
            $table->decimal('Labour',8, 2)->default(0.0); // Use 
            $table->string('PaymentType');
            $table->string('Remarks')->nullable();
            $table->string('EnterBy', 100);
            $table->datetime('EnterDate'); // Use timestamp 
            // instead 
            $table->string('Gadget', 100);
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
        Schema::dropIfExists('_purchase_invoice_details');
    }
}
