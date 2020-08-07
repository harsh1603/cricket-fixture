<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use PDF;
class SettingController extends Controller
{
    
    public function create()
    {
       
     $setting = \DB::table('setting')->first();

        return view('admin.setting.create',compact('setting'));
    }

   
  
    public function edit(Request $request){
        try{
         

            $data = array(

                'company_name' => $request->company_name,
                'mobile' => $request->mobile,
                'email'=>$request->email,
                'address'=>$request->address,
               
            );
            $bills = \DB::table('setting')->whereId(1)->update($data);
          
            Alert::success('Success', 'Updated Successfully');
            return back();
        }catch(Exception $e){
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
                 
         }
    }

    
}
