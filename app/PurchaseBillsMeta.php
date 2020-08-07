<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class PurchaseBillsMeta extends Model
{

    protected $table = 'purchasebill_product';

    protected $fillable = [
        'purchasebills_id',
        'product_id',
        'qty',
        'price',
        'total_amt'
    ];
  
}
