<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_category', function (Blueprint $table) {
            $table->id('ProductSubGrpId');
            $table->string('ProductSubGrpDesc', 255); // Consider 
            $table->string('ProductSubGrpShortName', 100); // Specify 
            $table->foreignId('ProductGrpId')
            ->references('CategoryId')
            ->on('category')
            ->oDelete('casecade');
            $table->boolean('Status'); // Use boolean for true/false
            $table->string('EnterBy', 100);
            $table->date('EnterDate')->format('Y-m-d');   
            $table->string('Gadget', 100);
            $table->string('PSGImg')->nullable(); // Use nullable if 
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
        Schema::dropIfExists('sub_category');
    }
}
