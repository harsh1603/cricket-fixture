<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseBillsMeta;
class PurchaseBills extends Model
{

    protected $table = 'purchasebills';

    protected $fillable = [
        'invoice_no',
        'subtotal',
        'discount',
        'grandtotal',
        'due_amt',
        'company_id',
        'created_date',
        'created_month',
        'created_year',
        'status',
        'created_by',
        'updated_at',
    ];
    public function billsmeta()
    {
        return $this->hasMany(PurchaseBillsMeta::class,'purchasebills_id','id');
    }
}
