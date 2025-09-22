<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'category';
    // Specify the primary key
    protected $primaryKey = 'CategoryId';

   protected $fillable = [
        'CategoryId',
        'CategoryDesc',
        'Status',
        'EnterBy',
        'EnterDate',
        'Gadget',
        'CategoryImg'
   ];


   
}
