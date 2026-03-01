<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_invoice_details';

    // Specify the primary key
    //protected $primaryKey = 'VoucherNo';

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
       'PurchaseRate',
       'BasicAmount',
       'LabourRate',
       'NetAmount',
       'PaymentType',
       'Remarks',
       'EnterBy',
       'EnterDate',
       'Gadget',
       'PSGImg'
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
