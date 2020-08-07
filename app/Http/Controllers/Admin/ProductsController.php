<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Product;
use App\ProductMeta;
use Auth;
use App\Imports\BulkImport;
use Excel;
class ProductsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);

        $products = Product::orderByDesc('id')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);

        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('product_create'), 403);

        $data = array(

            'name' => $request->name,
            'product_code' => $request->product_code,
            'description'=>$request->description,
            'company_id'=>$request->company_id,
            'brand_name'=>$request->brand_name,
            'created_at' => date("Y-m-d h:i:s")
        );
        $product = Product::insertGetId($data);
        if($product):
            ProductMeta::insert([
                "product_id"=>$product,
                "created_date"=>date('Y-m-d',strtotime($request->created_date)),
                "dp"=>$request->dp,
                "mrp"=>$request->dp,
                "qty"=>$request->qty,
                "created_by"=>Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s"),
            ]);
        endif;
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        $product->update($request->all());

        return redirect()->route('admin.products.index');
    }

    public function show($id)
    {
      //  dd($id);
        abort_unless(\Gate::allows('product_show'), 403);
        $productmeta=ProductMeta::where('product_id',$id)->get();
        return view('admin.products.show', compact('productmeta','id'));
    }

    public function destroy(Product $product)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
   public function priceAdd($product_id){
    return view('admin.products.priceadd', compact('product_id'));
   } 
   public function pricestore(Request $request,$id){
    ProductMeta::updateOrCreate(
        ['product_id' => $id, 'created_date' => date('Y-m-d')],
        [
        "product_id"=>$id,
        "created_date"=>date('Y-m-d'),
        "dp"=>$request->dp,
        "mrp"=>$request->dp,
        "qty"=>$request->qty,
        "created_by"=>Auth::user()->id,
        'created_at' => date("Y-m-d h:i:s"),
    ]);
    return redirect()->route('admin.products.show', $id);
   }

   public function importProduct(Request $request) 
   {
       Excel::import(new BulkImport,request()->file('pro_import'));
          
       return back();
   }
}
