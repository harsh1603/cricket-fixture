<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;
use App\Match;
use Validator;

class MatchController extends Controller {
  
  public function index() {

		$match = DB::table ( 'cricket_match' )
		->paginate(10);
		return view('admin.match.index', compact('match'));

	}

	public function create()
    {

        return view('admin.match.create');
    }

    public function store(Request $request)
    {
		
        try{
            $validator = Validator::make($request->all(), [
              'venue' => 'required|max:250',
			
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
                'team_a_id' => $request->team_a_id,
				        'team_b_id' => $request->team_b_id,
                'venue' => $request->venue,
                'match_date' => $request->match_date,
                'match_status' => $request->match_status,
                'win_team_id'=>$request->win_team_id,
                'created_by' => Auth::user()->id,
                'created_at' => date("Y-m-d h:i:s")
            );
           $match = Match::insertGetId($data);
            $a_point=0;
            $a_lose=0;
            $a_win=0;
            $a_tied=0;
            if($request->win_team_id!='' && $request->win_team_id!=$request->team_a_id):
              $a_point=10;
              $a_lose=0;
              $a_win=1;
              $a_tied=0;
            endif;
 

            $b_point=0;
            $b_lose=0;
            $b_win=0;
            $b_tied=0;
            if($request->win_team_id!='' && $request->win_team_id!=$request->team_b_id):
              $b_lose=0;
              $b_win=1;
              $b_tied=0;
              $b_point=10;
            endif;
           $teamapoint = DB::table('cricket_points')->where('team_id',$request->team_a_id)->where('match_id',$match)->first();

           $teambpoint = DB::table('cricket_points')->where('team_id',$request->team_b_id)->where('match_id',$match)->first();

           $teamadata = array(
             "team_id"=>$request->team_a_id,
              "played"=>(isset($teamapoint->player) && $teamapoint->player!=0)?$teamapoint->player+1:0,
              "match_tied"=>(isset($teamapoint->match_tied) && $teamapoint->match_tied!=0)?$teamapoint->match_tied:0,
              "match_won"=>(isset($teamapoint->match_won) && $teamapoint->match_won!=0)?$teamapoint->match_won+$a_win:$a_win,
              "match_lose"=>(isset($teamapoint->match_lose) && $teamapoint->match_lose!=0)?$teamapoint->match_lose+$a_lose:$a_lose,
              "points"=>(isset($teamapoint->points) && $teamapoint->points!=0)?$teamapoint->points+$a_point:$a_point,
              "match_id"=>$match,
            );
      
            $teambdata = array(
              "team_id"=>$request->team_b_id,
               "played"=>(isset($teambpoint->player) && $teambpoint->player!=0)?$teambpoint->player+1:0,
               "match_tied"=>(isset($teambpoint->match_tied) && $teambpoint->match_tied!=0)?$teambpoint->match_tied:0,
               "match_won"=>(isset($teambpoint->match_won) && $teambpoint->match_won!=0)?$teambpoint->match_won+$b_win:$b_win,
               "match_lose"=>(isset($teambpoint->match_lose) && $teambpoint->match_lose!=0)?$teambpoint->match_lose+$b_lose:$b_lose,
               "points"=>(isset($teambpoint->points) && $teambpoint->points!=0)?$teamapoint->teambpoint+$b_point:$b_point,
               "match_id"=>$match,
             );
          
             $attributesa=array(
              "team_id"=>$request->team_a_id,
              "match_id"=>$match,
             );
             $attributesb=array(
              "team_id"=>$request->team_b_id,
              "match_id"=>$match,
             );
             DB::table('cricket_points')->updateOrInsert($attributesa, $teamadata);
             DB::table('cricket_points')->updateOrInsert($attributesb, $teambdata);
             
        Alert::success('Success', 'Added Successfully!!');
        return redirect()->route('admin.match.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function edit($id)
    {

         $match = Match::find($id);
        return view('admin.match.edit', compact('match'));
    }

    public function update(Request $request,$id)
    {
        

        try{
            $validator = Validator::make($request->all(), [
              'venue' => 'required|max:250',
              
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
              'team_a_id' => $request->team_a_id,
              'team_b_id' => $request->team_b_id,
              'venue' => $request->venue,
              'match_date' => $request->match_date,
              'match_status' => $request->match_status,
              'win_team_id'=>$request->win_team_id,
              'created_by' => Auth::user()->id,
              'created_at' => date("Y-m-d h:i:s")
          );
           
         
          Match::where('id',$id)->update($data);

          $a_point=0;
          $a_lose=1;
          $a_win=0;
          $a_tied=0;
          if($request->win_team_id!='' && $request->win_team_id!=$request->team_a_id):
            $a_point=10;
            $a_lose=0;
            $a_win=1;
            $a_tied=0;
          endif;


          $b_point=0;
          $b_lose=1;
          $b_win=0;
          $b_tied=0;
          if($request->win_team_id!='' && $request->win_team_id!=$request->team_b_id):
            $b_lose=0;
            $b_win=1;
            $b_tied=0;
            $b_point=10;
          endif;
         $teamapoint = DB::table('cricket_points')->where('team_id',$request->team_a_id)->where('match_id',$id)->first();

         $teambpoint = DB::table('cricket_points')->where('team_id',$request->team_b_id)->where('match_id',$id)->first();
          if(isset($teamapoint) && $teamapoint->points==0):
         $teamadata = array(
           "team_id"=>$request->team_a_id,
            "match_tied"=>(isset($teamapoint->match_tied) && $teamapoint->match_tied!=0)?$teamapoint->match_tied:0,
            "match_won"=>(isset($teamapoint->match_won) && $teamapoint->match_won!=0)?$teamapoint->match_won+$a_win:$a_win,
            "match_lose"=>(isset($teamapoint->match_lose) && $teamapoint->match_lose!=0)?$teamapoint->match_lose+$a_lose:$a_lose,
            "points"=>(isset($teamapoint->points) && $teamapoint->points!=0)?$teamapoint->points+$a_point:$a_point,
            "match_id"=>$id,
          );
          $attributesa=array(
            "team_id"=>$request->team_a_id,
            "match_id"=>$id,
           );
           DB::table('cricket_points')->updateOrInsert($attributesa, $teamadata);
          endif;
          if(isset($teambpoint) && $teambpoint->points==0):

          $teambdata = array(
            "team_id"=>$request->team_b_id,
             "match_tied"=>(isset($teambpoint->match_tied) && $teambpoint->match_tied!=0)?$teambpoint->match_tied:0,
             "match_won"=>(isset($teambpoint->match_won) && $teambpoint->match_won!=0)?$teambpoint->match_won+$b_win:$b_win,
             "match_lose"=>(isset($teambpoint->match_lose) && $teambpoint->match_lose!=0)?$teambpoint->match_lose+$b_lose:$b_lose,
             "points"=>(isset($teambpoint->points) && $teambpoint->points!=0)?$teamapoint->teambpoint+$b_point:$b_point,
             "match_id"=>$id,
           );
     
          
           $attributesb=array(
            "team_id"=>$request->team_b_id,
            "match_id"=>$id,
           );
       
           DB::table('cricket_points')->updateOrInsert($attributesb, $teambdata);
          endif;
        Alert::success('Success', 'Updated Successfully!!');
        return redirect()->route('admin.match.index');
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
        abort(404);
             
     }

    }

    public function destroy(Request $request)
    {
  
        try{  
			Match::where('id','=',$request->id)->delete();
            
            Alert::success('Success', 'Deleted Successfully!!');
        return redirect()->route('admin.match.index');
          }catch(Exception $e){
         Alert::error('Error', $e->getMessage());
         \Log::error($e->getMessage());
         abort(404);
        }
    }
}
