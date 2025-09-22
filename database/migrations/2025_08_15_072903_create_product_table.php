<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('ProductId');
            $table->string('ProductDesc');
            $table->string('ProductShortName');
            $table->foreignId('ProductGrpId')
            ->references('CategoryId')
            ->on('category')
            ->oDelete('casecade');
            $table->foreignId('ProductSubGrpId')
            ->references('ProductSubGrpId')
            ->on('sub_category')
            ->oDelete('casecade');
            $table->decimal('BuyRate');
            $table->decimal('SalesRate');
            $table->boolean('Status'); // Use boolean for true/
            $table->string('EnterBy', 100);
            $table->date('EnterDate')->format('Y-m-d'); //datetime if only date and time are needed
            $table->string('Gadget', 100);
            $table->string('PImage')->nullable();
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
        Schema::dropIfExists('product');
    }
}
