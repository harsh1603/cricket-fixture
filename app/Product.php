<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'product_code',
        'price',
        'qty',
        'company_id',
        'brand_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];
}
