<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;

     protected $table = 'unit';

    // Specify the primary key
    protected $primaryKey = 'UnitId';

   protected $fillable = [
       'UnitDesc',
       'Status',
       'EnterBy',
       'EnterDate',
   ];
}
