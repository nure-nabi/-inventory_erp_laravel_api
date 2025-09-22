<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    
    protected $table = 'product';

    // Specify the primary key
    protected $primaryKey = 'ProductId';

   protected $fillable = [
       'ProductDesc',
       'ProductShortName',
       'ProductGrpId',
       'ProductSubGrpId',
       'BuyRate',
       'SalesRate',
       'Status',
       'EnterBy',
       'EnterDate',
       'Gadget',
       'PImage'

   ];

   public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'ProductGrpId');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategoryModel::class, 'ProductSubGrpId');
    }
}
