<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBankDetails extends Model
{
   use HasFactory;
    protected $table = 'cash_bank_details';

     // Specify the primary key
     protected $primaryKey = 'VoucherNo';

    protected $fillable = [
        'SalesmanId',
       'LedgerId',
       'RecAmt',
       'PayAmt',
       'RecLocalAmt',
       'PayLocalAmt',
       'EnteryDate',
       'EnterBy',
       'Naration',

    ];
}
