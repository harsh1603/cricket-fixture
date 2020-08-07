<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;
use App\Teams;
use Validator;

class TeamController extends Controller {
  
  public function index() {

		$teams = DB::table ( 'cricket_teams' )
		->orderBy ( 'cricket_teams.name', 'asc' )
		->paginate(10);
		return view('admin.team.index', compact('teams'));

	}

	public function create()
    {

        return view('admin.team.create');
    }

    public function store(Request $request)
    {
		
        try{
            $validator = Validator::make($request->all(), [
              'name' => 'required|max:250',
			  'short_name' => 'required',
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
				'short_name' => $request->short_name,
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s")
            );
           
              if ($request->hasFile('image')) {
                $file = $request->file('image');       
                //echo $request->file('image');die;  
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $image = time().'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(
                base_path() . '/public/images/teams/', $image);  
                $data['image'] = $image;
              } 
              Teams::insert($data);
        Alert::success('Success', 'Added Successfully!!');
        return redirect()->route('admin.teams.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function edit($id)
    {

         $teams = Teams::find($id);
        return view('admin.team.edit', compact('teams'));
    }

    public function update(Request $request,$id)
    {
        

        try{
            $validator = Validator::make($request->all(), [
				'name' => 'required|max:250',
				'short_name' => 'required',
              
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
				'short_name' => $request->short_name,
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s")
            );
           
              if ($request->hasFile('image')) {
                $file = $request->file('image');       
                //echo $request->file('image');die;  
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $image = time().'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(
                base_path() . '/public/images/teams/', $image);  
                $data['image'] = $image;
              } 
              Teams::where('id',$id)->update($data);
        Alert::success('Success', 'Updated Successfully!!');
        return redirect()->route('admin.teams.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function destroy(Request $request)
    {
  
        try{  
			Teams::where('id','=',$request->id)->delete();
            
            Alert::success('Success', 'Deleted Successfully!!');
        return redirect()->route('admin.teams.index');
          }catch(Exception $e){
         Alert::error('Error', $e->getMessage());
         \Log::error($e->getMessage());
         abort(404);
        }
    }
}
