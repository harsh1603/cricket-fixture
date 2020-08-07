<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Product;
use App\ProductMeta;
use App\PurchaseBills;
use App\PurchaseBillsMeta;
use Auth;
use PDF;
use Crypt;
class PurchaseBillController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('bill_access'), 403);

        $bills = PurchaseBills::orderByDesc('id')->get();
        return view('admin.purchasebill.index', compact('bills'));
    }

    public function create()
    {
       
       // abort_unless(\Gate::allows('bill_create'), 403);
     
        return view('admin.purchasebill.create');
    }
  
 
    public function show(Request $request,$id)
    {
      //  abort_unless(\Gate::allows('bill_show'), 403);
        $bills = PurchaseBillsMeta::where('purchasebills_id',$id)->get();
        return view('admin.purchasebill.productlist', compact('bills'));
        
    }
  

    public function saveBills(Request $request){
        try{
            //abort_unless(\Gate::allows('bill_create'), 403);
         //   dd($request->all());
            $data = array(

                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'grandtotal'=>$request->grandtotal,
                'due_amt'=>$request->dues_amt,
                'company_id'=>$request->companyid,
                'created_date'=>date('Y-m-d',strtotime($request->createddate)),
                'created_month'=>date('F',strtotime($request->createddate)),
                'created_year'=>date('Y',strtotime($request->createddate)),
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s")
            );
            $bills = PurchaseBills::insertGetId($data);
            PurchaseBills::whereId($bills)->update(["invoice_no" =>"PB-00000".$bills]);
            $cost = explode(",",$request->cost);
            $product_code = explode(",",$request->product_code);
            $quantity = explode(",",$request->quantity);
            $product_name = explode(",",$request->product_name);
            $brand_name = explode(",",$request->brand);

            if($cost!=''):
                foreach($cost as $key =>$value):
                    $checkexist = Product::select('id')->where('product_code',$product_code[$key])->first();
                    if($checkexist==''):
                        $arr = array(

                            'name' => $product_name[$key],
                            'product_code' => $product_code[$key],
                            'description'=>'',
                            'brand_name'=>$brand_name[$key],
                            'company_id'=>$request->companyid,
                            'created_at' => date("Y-m-d h:i:s")
                        );
                        $productid = Product::insertGetId($arr);
                    else:
                    $productid=$checkexist->id;
                    endif;
                    if($value!=''):
                        PurchaseBillsMeta::insert([
                            "purchasebills_id"=>$bills,
                            "product_id"=>$productid,
                            "price"=>$value,
                            "qty"=>$quantity[$key],
                            "total_amt"=>$value * $quantity[$key]
                        ]);
                    endif;
                    $qty =$quantity[$key];
                    $check  = ProductMeta::select('dp','qty')->where('product_id',$productid)->whereDate('created_date','<=', date('Y-m-d',strtotime($request->createddate)))->orderBy('created_date','Desc')->first();
                    if($check):
                        $qty = $check->qty+$quantity[$key];
                   
                    endif;
                    ProductMeta::updateOrCreate(
                        ['product_id' => $productid, 'created_date' => date('Y-m-d',strtotime($request->createddate))],
                        [
                        "product_id"=>$productid,
                        "created_date"=>date('Y-m-d',strtotime($request->createddate)),
                        "dp"=>$value,
                        "mrp"=>$value,
                        "qty"=>$qty,
                        "created_by"=>Auth::user()->id,
                        'created_at' => date("Y-m-d h:i:s"),
                    ]);
              
                endforeach;
            endif;
          //  return redirect()->route('admin.purchasebill.generateBill',[Crypt::encrypt($bills)]);
            Alert::success('Success', 'Generated Successfully');
            return redirect()->route('admin.purchasebill.index');
        }catch(Exception $e){
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
                 
         }
    }

    public function generateBill($id){
        $data = PurchaseBills::with('billsmeta')->whereId(Crypt::decrypt($id))->first();
       $setting = \DB::table('setting')->first();
        return view('admin.purchasebill.generatebill',['data'=>$data,'setting'=>$setting]);
	
    }

    public function ProductBrandName(Request $request){
        $check = Product::select('brand_name')->where('product_code',$request->product_code)->first();
    
          return json_encode(array("succ"=>true,"data"=>array("brand_name"=>$check->brand_name)));

    }
    
}
