<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGodownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('godown', function 
        (Blueprint $table) {
            $table->id('GodownId');
            $table->string('GodownDesc');
            $table->boolean('Status'); // Use boolean for true/false values
            $table->string('EnterBy', 100);
            $table->date('EnterDate')->format('Y-m-d'); 
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
        Schema::dropIfExists('godown');
    }
}
