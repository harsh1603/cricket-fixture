<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Product;
use App\ProductMeta;
use App\Bills;
use App\BillsMeta;
use Auth;
use PDF;
class EstimateBillController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('bill_access'), 403);

        $bills = Bills::whereStatus(1)->where('bill_type',4)->orderByDesc('id')->get();
        return view('admin.estimatebill.index', compact('bills'));
    }

    public function create()
    {
       
        abort_unless(\Gate::allows('bill_create'), 403);

        return view('admin.estimatebill.create');
    }

    public function show(Request $request,$id)
    {
        abort_unless(\Gate::allows('bill_show'), 403);
        $bills = BillsMeta::where('bills_id',$id)->get();
        return view('admin.estimatebill.productlist', compact('bills'));
        
    }
    public function destroy(Request $request,$id)
    {
        abort_unless(\Gate::allows('bill_delete'), 403);

        try{  
          BillsMeta::where('bills_id','=',$id)->delete();
          Bills::where('id','=',$id)->delete();
            
            Alert::success('Success', 'Deleted Successfully!!');
        return redirect()->route('admin.estimatebill.index');
          }catch(Exception $e){
         Alert::error('Error', $e->getMessage());
         \Log::error($e->getMessage());
         abort(404);
        }
        
    }
    public function addproduct(Request $request){
       try{
        $check = Product::select('product_metas.id','products.name','product_metas.dp','product_metas.qty')->join('product_metas','product_metas.product_id','=','products.id')->where('products.product_code',$request->product)
          ->whereDate('product_metas.created_date','<=', date('Y-m-d',strtotime($request->billingdate)))->orderBy('product_metas.created_date','Desc')->first();
        //   echo'<pre>';print_r($check);die;
     //   $check = Product::where('id',$request->product)->first();
        if($check!='' && $check->qty>0):
            $qty = $check->qty - $request->qty;
            // echo $qty;die;
            ProductMeta::where('id',$check->id)->update(["qty"=>$qty]);
            $price = $check->dp * $request->qty;
            return json_encode(array("succ"=>true,"data"=>array("name"=>$check->name,"id"=>$check->id,"qty"=>$request->qty,"price"=>$price)));

        else:
            return json_encode(array("succ"=>false,"msg"=>"Product is out of stock"));
        endif;
       }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }
    }
    public function removeproduct(Request $request){
        try{
            $check = Product::select('product_metas.id','products.name','product_metas.dp','product_metas.qty')->join('product_metas','product_metas.product_id','=','products.id')->where('products.product_code',$request->product)
            ->whereDate('product_metas.created_date','<=', date('Y-m-d',strtotime($request->billingdate)))->orderBy('product_metas.created_date','Desc')->first();
            if($check!=''):
                $qty = $check->qty + $request->qty;
                // echo $qty;die;
                ProductMeta::where('id',$check->id)->update(["qty"=>$qty]);
    
                return json_encode(array("succ"=>true,"data"=>array("name"=>$check->name,"id"=>$check->id,"qty"=>$request->qty)));
    
            else:
                return json_encode(array("succ"=>false,"msg"=>"Product is out of stock"));
            endif;
           }catch(Exception $e){
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
                 
         }
    }

    public function saveBills(Request $request){
        try{
           // dd($request->all());
            abort_unless(\Gate::allows('bill_create'), 403);
            $invoice_no = Bills::select('invoice_count_no')->where('bill_type',4)->orderBy('id', 'desc')->first();
            $num=0;
            if($invoice_no!=''):
            $num = $invoice_no->invoice_count_no!=''?$invoice_no->invoice_count_no:0;
           endif;
         $innum = $num+1;
            $data = array(

                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'name'=>$request->name,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'address'=>$request->address,
                'grandtotal'=>$request->grandtotal,
                'paid_by_bank'=>$request->paid_in_bank,
                'paid_by_cash'=>$request->paid_in_cash,
                'due_amt'=>$request->dues_amt,
                "billing_date"=>date('Y-m-d',strtotime($request->billingdate)),
                "billing_month"=>date('F',strtotime($request->billingdate)),
                "billing_year"=>date('Y',strtotime($request->billingdate)),
                'status' => 1,
                'bill_type'=>4,
                'invoice_no'=>"EB-00000". $innum,
                'invoice_count_no'=>$innum,
                'created_by' => Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s")
            );
            $bills = Bills::insertGetId($data);
          

            $cost = explode(",",$request->cost);
            $product = explode(",",$request->productcode);
            $quantity = explode(",",$request->quantity);

            if($cost!=''):
                foreach($cost as $key =>$value):
                    if($value!=''):
                        BillsMeta::insert([
                            "bills_id"=>$bills,
                            "product_code"=>$product[$key],
                            "price"=>$value,
                            "qty"=>$quantity[$key]
                        ]);
                    endif;
                endforeach;
            endif;
        
            //  $pdf = PDF::loadView('admin.bill.generatebill',['data'=>$data,'setting'=>$setting]);
            //  return $pdf->download('invoice.pdf');	
            //  return back();
            Alert::success('Success', 'Generated Successfully');
            return redirect()->route('admin.estimatebill.generateBill',[\Crypt::encrypt($bills)]);
        }catch(Exception $e){
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
                 
         }
    }

    public function generateBill($id){
        $data = Bills::with('billsmeta')->whereId(\Crypt::decrypt($id))->first();
       // dd($data);
       $setting = \DB::table('setting')->first();
        return view('admin.estimatebill.generatebill',['data'=>$data,'setting'=>$setting]);
		return $pdf->download('invoice.pdf');	
        //  return view('admin.bill.generatebill');
    }
    
}
