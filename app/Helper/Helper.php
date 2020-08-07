<?php

function getTeam(){
	$list = \DB::table('cricket_teams')->select('id','name')->get();

	return $list;
}

function getTeamName($id){
	$list = \DB::table('cricket_teams')->whereId($id)->select('name')->first();

	return $list->name??'';
}
function getTeamImage($id){
	$list = \DB::table('cricket_teams')->whereId($id)->select('image')->first();

	return $list->image??'';
}
?>