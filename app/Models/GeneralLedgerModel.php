<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralLedgerModel extends Model
{
    use HasFactory;

     protected $table = 'general_ledger';

    // Specify the primary key
    protected $primaryKey = 'LedgerId';

   protected $fillable = [
       'GlDesc',
       'GlCategory',
       'SalesmanId',
       'CreditLimit',
       'Address',
       'MobileNo',
       'Email',
       'DOB',
       'Gender',
       'Status',
       'EnterBy',
       'EnterDate',
       'Gadget',
       'GLImage'
   ];
}
