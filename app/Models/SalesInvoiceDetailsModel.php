<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceDetailsModel extends Model
{
    use HasFactory;
     protected $table = 'sales_invoice_details';

   protected $fillable = [
    'VoucherNo',
    'ProductId',
    'ProductGrpId',
    'ProductSubGrpId',
    'SalesmanId',
    'LedgerId',
    'Godown',
    'Unit',
    'Qty',
    'SalesRate',
    'BasicAmount',
    'LabourRate',
    'NetAmount',
    'PaymentType',
    'Remarks',
    'EnterBy',
    'EnterDate',
    'Gadget'
   ];

   public function product()
   {
       return $this->belongsTo(ProductModel::class,'ProductId');
   }
    public function category()
   {
       return $this->belongsTo(CategoryModel::class,'ProductGrpId');
   }
   public function subCategory()
   {
       return $this->belongsTo(SubCategoryModel::class,'ProductSubGrpId');
   }
   public function ledger()
   {
       return $this->belongsTo(GeneralLedgerModel::class,'LedgerId');
   }
   public function remarks()
   {
       return $this->belongsTo(PurchaseInvoiceMasterModel::class,'VouchefNo');
   }
}
