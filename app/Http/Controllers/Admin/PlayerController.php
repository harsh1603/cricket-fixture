<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;
use App\Player;
use Validator;

class PlayerController extends Controller {
  
  public function index() {

		$player = DB::table ( 'cricket_players' )
		->paginate(10);
		return view('admin.player.index', compact('player'));

	}

	public function create()
    {

        return view('admin.player.create');
    }

    public function store(Request $request)
    {
		
        try{
            $validator = Validator::make($request->all(), [
              'first_name' => 'required|max:250',
              'last_name' => 'required|max:250',
              'specialist' => 'required|max:250',
			         'team' => 'required',
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
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name.' '.$request->last_name,
                'specialist' => $request->specialist,
                'team_id'=>$request->team,
                'jersey_no'=>$request->jersey_no,
                'no_of_match'=>$request->no_of_match,
                'no_of_run'=>$request->no_of_run,
                'no_of_six'=>$request->no_of_six,
                'no_of_four'=>$request->no_of_four,
                'no_of_wicket'=>$request->no_of_wicket,
                'highest_score'=>$request->highest_score,
                'no_of_catch'=>$request->no_of_catch,
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
                base_path() . '/public/images/player/', $image);  
                $data['image'] = $image;
              } 
              Player::insert($data);
        Alert::success('Success', 'Added Successfully!!');
        return redirect()->route('admin.player.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function edit($id)
    {

         $player = Player::find($id);
        return view('admin.player.edit', compact('player'));
    }

    public function update(Request $request,$id)
    {
        

        try{
            $validator = Validator::make($request->all(), [
              'first_name' => 'required|max:250',
              'last_name' => 'required|max:250',
              'specialist' => 'required|max:250',
			         'team' => 'required',
              
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
              'first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'name' => $request->first_name.' '.$request->last_name,
              'specialist' => $request->specialist,
              'team_id'=>$request->team,
              'jersey_no'=>$request->jersey_no,
              'no_of_match'=>$request->no_of_match,
              'no_of_run'=>$request->no_of_run,
              'no_of_six'=>$request->no_of_six,
              'no_of_four'=>$request->no_of_four,
              'no_of_wicket'=>$request->no_of_wicket,
              'highest_score'=>$request->highest_score,
              'no_of_catch'=>$request->no_of_catch,
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
                base_path() . '/public/images/player/', $image);  
                $data['image'] = $image;
              } 
              Player::where('id',$id)->update($data);
        Alert::success('Success', 'Updated Successfully!!');
        return redirect()->route('admin.player.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function destroy(Request $request)
    {
  
        try{  
			Player::where('id','=',$request->id)->delete();
            
            Alert::success('Success', 'Deleted Successfully!!');
        return redirect()->route('admin.player.index');
          }catch(Exception $e){
         Alert::error('Error', $e->getMessage());
         \Log::error($e->getMessage());
         abort(404);
        }
    }
}
