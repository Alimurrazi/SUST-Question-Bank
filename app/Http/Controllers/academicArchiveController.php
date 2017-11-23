<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input; 
use Illuminate\Http\Request;
use View;
use Auth;
use DB;
class academicArchiveController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    //
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    //
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{



  /*  $userid = \Auth::user()->id;

    $subject = Input::get('subject');
    $Semester = Input::get('Semester');
    $session = Input::get('session');
   / $teacher = Input::get('teacher'); 
    $type = Input::get('type');
*/
        //$id = Auth::user()->id;
    DB::table('academic_archive')->insert([
        'user_id'=>Auth::user()->id,
        'subject'=>Input::get('subject'),
        'semester'=>Input::get('semester'),
        'session'=>Input::get('session'),
        'teacher'=>Input::get('teacher'),
        'type'=>Input::get('type')]);


    if (Input::hasFile('image')) {
        $image = Input::file('image');
       // $path=$image->move(public_path().'/'.'img'.'/'.'question'.'/',$image->getClientOriginalName());
    $image->move(public_path().'/'.'img'.'/'.'question'.'/',$image->getClientOriginalName());

    $path='/'.'img'.'/'.'question'.'/'.$image->getClientOriginalName();
      echo $path;
        $latest_id=DB::table('academic_archive')->max('id');
        //$latest_id++;
        //echo $latest_id;

        DB::table('academic_archive_file')->insert([
           'foreign_id'=>$latest_id,
           'file'=>$path]);
    }





   // return view::make('academic_archive');
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show()
{
    $data=DB::table('academic_archive_file')
          ->get();
    return view::make('academic_archive_file_view')->with('data',$data);      
}


public function search(Request $request)
{

    $data=DB::table('academic_archive')
          ->join('academic_archive_file','academic_archive.id','=','academic_archive_file.foreign_id')
          ->where('academic_archive.subject','=',Input::get('subject'))
          ->where('academic_archive.semester','=',Input::get('semester'))
          ->where('academic_archive.session','=',Input::get('session'))
          ->get();

      
   return view::make('academic_archive_file_view')->with('data',$data);      
}
/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    //
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    //
}
}
