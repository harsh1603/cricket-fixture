<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class BillsMeta extends Model
{

    protected $table = 'bill_product';

    protected $fillable = [
        'bills_id',
        'product_code',
        'qty',
        'price',
    ];
  
}
