<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceMasterModel extends Model
{
    use HasFactory;
    
    protected $table = 'purchase_invoice_master';

    // Specify the primary key
    //protected $primaryKey = 'VoucherNo';

   protected $fillable = [
       'VoucherNo',
       'VDate',
       'VTime',
       'DueDate',
       'LedgerId',
       'PartyName',
       'CurrencyRate',
       'BasicAmount',
       'NetAmount',
       'PaymentType',
       'Remarks',
       'EnterBy',
       'EnterDate',
       'Gadget',
       'IsBillCancel',
       'PGImg'

   ];
}
