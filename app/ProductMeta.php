<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{

  

    protected $fillable = [
        'product_id',
        'created_date',
        'dp',
        'mrp',
        'qty',
        'created_by',
        'created_at',
        'updated_at'

    ];
}
