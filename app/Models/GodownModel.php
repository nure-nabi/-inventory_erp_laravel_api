<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GodownModel extends Model
{
    use HasFactory;
     protected $table = 'godown';

    // Specify the primary key
    protected $primaryKey = 'GodownId';

   protected $fillable = [
       'GodownDesc',
       'Status',
       'EnterBy',
       'EnterDate',
   ];
}
