<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNoteDetails extends Model
{
   use HasFactory;

    //VoucherNo,LedgreId,Narration,Amount,
    protected $table = 'debit_note_details';

    // Specify the primary key
    protected $primaryKey = 'VoucherNo';

   protected $fillable = [
       'LedgerId',
       'Narration',
       'Amount',
       'EnterBy',
       'EntryDate'
   ];
}
