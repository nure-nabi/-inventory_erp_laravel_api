<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNoteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_details', function (Blueprint $table) {
            $table->id('VoucherNo'); // AUTO_INCREMENT primary key
            $table->foreignId('LedgerId')
            ->references('LedgerId')
            ->on('general_ledger')
            ->oDelete('casecade');
            $table->string('Narration')->nullable();
            $table->decimal('Amount', 8, 2);
            $table->timestamp('EntryDate');
             $table->string('EnterBy', 100);
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
        Schema::dropIfExists('credit_note_details');
    }
}
