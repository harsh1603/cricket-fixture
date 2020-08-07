<?php

namespace App\Imports;

use App\Product;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use App\ProductMeta;
use Auth;

class BulkImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        $created_date = $row['created_date']!=''?\Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(trim($row['created_date'])))->format('Y-m-d'):'';
        $qty =trim($row['quantity']);
        $check = Product::where('product_code',$row['product_code'])->first();
        if($check==''):
            $arr = array(
                "name"=>trim($row['product_name']),
                "product_code"=>trim($row['product_code']),
                "company_id"=>trim($row['company_name'])!=''?$this->getCompanyId(trim($row['company_name'])) :'', 
                'brand_name'=>trim($row['brand_name'])              
            );
          $product =  DB::table('products')->insertGetId($arr);
          if($product):
            ProductMeta::insert(
                [
                "product_id"=>$product,
                "created_date"=>$created_date,
                "dp"=>trim($row['price']),
                "mrp"=>trim($row['price']),
                "qty"=>$qty,
                "created_by"=>Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s"),
            ]);
          endif;
        else:
           
            $check1  = ProductMeta::select('dp','qty')->where('product_id',$check->id)->whereDate('created_date','<=', $created_date)->orderBy('created_date','Desc')->first();
            if($check1):
                $qty = $check1->qty+$row['quantity'];
           
            endif;
            ProductMeta::updateOrCreate(
                ['product_id' => $check->id, 'created_date' => $created_date],
                [
                "product_id"=>$check->id,
                "created_date"=>$created_date,
                "dp"=>$row['price'],
                "mrp"=>$row['price'],
                "qty"=>$qty,
                "created_by"=>Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s"),
            ]);
        endif;

    }

    public function getCompanyId($name){
        $inst = DB::table('company')->whereRaw('LOWER(`name`) like ?', ['%'.strtolower(trim($name)).'%'])->first();
        if($inst):
            return $inst->id;
        else:
            return '';
        endif;
    }
}
