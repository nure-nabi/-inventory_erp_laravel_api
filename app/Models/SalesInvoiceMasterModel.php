<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceMasterModel extends Model
{
    use HasFactory;
    protected $table = 'sales_invoice_master';

   protected $fillable = [
    'VoucherNo',
    'VDate',
    'VTime',
    'DueDate',
    'LedgerId',
    'PartyName',
    'SalesmanId',
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
