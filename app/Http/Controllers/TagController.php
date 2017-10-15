<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use View;

class TagController extends Controller
{
    public function index()
    {
        return view('tag'); 
    }
 
    public function ajax(Request $request){

        $query = $request->get('query',''); 
      //  $user = DB::table('users')->where('name', 'John')->first();       
	//$sql = "SELECT name FROM tags 
	//		WHERE name LIKE '%".$_GET['query']."%'
	//		LIMIT 10";
      //  $users = DB::table('users')->where('name', 'like', 'T%')->get();
        $posts = DB::table('tags')->select('tag_name')->where('tag_name','LIKE','%'.$query.'%')->get();        

        return response()->json($posts);
	}

	public function submit()
	{
		return Input::all();
	}

}