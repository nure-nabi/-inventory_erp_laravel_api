<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNoteDetails extends Model
{
    use HasFactory;
     //VoucherNo,LedgreId,Narration,Amount,
     protected $table = 'credit_note_details';

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
