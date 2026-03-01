<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('sales_invoice_details', function (Blueprint $table) {
            $table->id();
            // Define VoucherNo column
            $table->string('VoucherNo', 50);
             // Then add the foreign key
             $table->foreign('VoucherNo')
              ->references('VoucherNo')
              ->on('sales_invoice_master')
              ->onDelete('cascade');
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
            $table->decimal('Qty'); // Consider 
            $table->decimal('SalesRate',8,2); // Specify length for better control
            $table->decimal('BasicAmount',8, 2);
            $table->decimal('LabourRate',8,2)->nullable(); // 
            $table->decimal('NetAmount',8, 2); // Use boolean for true/false values
            $table->string('PaymentType');
            $table->string('Remarks')->nullable();
            $table->string('EnterBy', 100);
            $table->timestamp('EnterDate'); // Use timestamp instead of datetime if only date and time are needed
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
        Schema::dropIfExists('sales_invoice_details');
    }
}
