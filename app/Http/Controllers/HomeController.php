<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ques_list=DB::table('questions')
                   ->orderBy('created_at', 'desc')
                   ->get();

        return view('home')->with('list',$ques_list);
    }
}