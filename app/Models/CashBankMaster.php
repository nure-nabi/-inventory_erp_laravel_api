<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBankMaster extends Model
{
   use HasFactory;

     protected $table = 'cash_bank_master';

     // Specify the primary key
     protected $primaryKey = 'VoucherNo';

    protected $fillable = [
        'VDate',
       'VTime',
       'LedgerId',
       'SalesmanId',
       'Remarks',
       'EnterBy',
       'EnterDate',
       'Gadget',
       'CancelDate',

    ];
}
