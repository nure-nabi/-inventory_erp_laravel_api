<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;

     protected $table = 'sub_category';

    // Specify the primary key
    protected $primaryKey = 'ProductSubGrpId';

   
   protected $fillable = [
       'ProductSubGrpDesc',
       'ProductSubGrpShortName',
       'ProductGrpId',
       'Status',
       'EnterBy',
       'EnterDate',
       'Gadget',
       'PSGImg'

   ];


   public function category()
{
    return $this->belongsTo(CategoryModel::class, 'ProductGrpId');
}

}
