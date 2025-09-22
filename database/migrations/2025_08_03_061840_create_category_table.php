<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id('CategoryId');
            $table->string('CategoryDesc', 255); // Consider 
            $table->boolean('Status'); // Use boolean for true/false 
            $table->string('EnterBy', 50);
           $table->date('EnterDate')->format('Y-m-d'); 
            $table->string('Gadget', 20);
            $table->string('CategoryImg')->nullable(); // Use nullable if 
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
        Schema::dropIfExists('category');
    }
}
