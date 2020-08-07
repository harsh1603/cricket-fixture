<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use Illuminate\Http\Request;

use App\company;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;
use Validator;

class CompanyController extends Controller
{
    public function index(Request $request)
    {

        //echo 'dsd';die;
       
        abort_unless(\Gate::allows('company_access'), 403);
        $company = \DB::table('company')->orderByDesc('id')->paginate(10);

        return view('admin.company.index', compact('company'));
    }

    public function create()
    {
         abort_unless(\Gate::allows('company_create'), 403);

        return view('admin.company.create');
    }

    public function store(Request $request)
    {
         abort_unless(\Gate::allows('company_create'), 403);

        try{
            $validator = Validator::make($request->all(), [
              'name' => 'required|max:200',
              
              ]);
          if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all(':message') as $message)
            {
                 Alert::error('Sorry!',  $message);
                 return back();
            }
            }
          
            $data = array(
                'name' => $request->name,
                'mobile' => $request->mobile,
                'gst_no' => $request->gst_no,
                'address' => $request->address,
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s")
            );
           
              \DB::table('company')->insert($data);
        Alert::success('Success', 'Added Successfully!!');
        return redirect()->route('admin.company.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function edit($id)
    {
         abort_unless(\Gate::allows('company_edit'), 403);
         $company = \DB::table('company')->find($id);
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request,$id)
    {
         abort_unless(\Gate::allows('company_edit'), 403);

        try{
            $validator = Validator::make($request->all(), [
              'name' => 'required|max:200',
              
              ]);
          if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all(':message') as $message)
            {
                 Alert::error('Sorry!',  $message);
                 return back();
            }
            }
          
            $data = array(
              'name' => $request->name,
              'mobile' => $request->mobile,
              'gst_no' => $request->gst_no,
              'address' => $request->address,
              'status' => 1,
              'created_by' => Auth::user()->id,
          );
              \DB::table('company')->where('id',$id)->update($data);
        Alert::success('Success', 'Updated Successfully!!');
        return redirect()->route('admin.company.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        // echo 'd';die;

         abort_unless(\Gate::allows('company_delete'), 403);

        try{  
          \DB::table('company')->where('id','=',$request->id)->delete();
            
            Alert::success('Success', 'Deleted Successfully!!');
        return redirect()->route('admin.company.index');
          }catch(Exception $e){
         Alert::error('Error', $e->getMessage());
         \Log::error($e->getMessage());
         abort(404);
        }
    }

   
}