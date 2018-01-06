<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\tag;
use App\User;
use Auth;
use DB;
use View;

class adminController extends Controller
{
    public function index()
    {
       if(Auth::user())
        {
            $admin=DB::table('admins')
                   ->where('user_id','=',Auth::user()->id)
                   ->first();
            if($admin)
            return $this->user();

            else  redirect::back();
         
        }
    }

    public function user()
    {
        $user=DB::table('users')
            //  ->join('admins','users_id','=','admins.id')
            //  ->select()
              ->get();

         return view::make('admin_edit_user_data')->with('user',$user);
    }

    public function user_update_first($id)
    {
      $data=DB::table('users')
            ->where('id','=',$id)
            ->first();

      return view::make('admin_update_user_data')->with('data',$data);      
    }

    public function user_update_second(Request $request)
    {
        echo $request;
        
        
        $user=User::find($request->user_id);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->status=="normal")
        $user->status=0;
        else
        $user->status=1;


        //if($request->admin=="admin")
        $user->save();
        
        return redirect('/admin_page');

    }

    public function user_delete($id)
    {
         
    }

    public function subject()
    {
        $subject=DB::table('subject')
                 ->get();

        return view::make('admin_subject')->with('subject',$subject);
    }

    public function subject_update_first($id)
    {
      $data=DB::table('subject')
            ->where('id','=',$id)
            ->first(); 
 
      return view::make('admin_update_subject_data')->with('data',$data);      
    }

    public function subject_update_second(Request $request)
    {
            DB::table('subject')
            ->where('id', $request->subject_id)
            ->update(['subject_name' => $request->subject_name,'subject_code'=>$request->subject_code]);

            return back();
    }

    public function add_subject(Request $request)
    {
        DB::table('subject')->insert(
        ['subject_name' => $request->subject_name, 'subject_code' => $request->subject_code]
        );
        
        return redirect('/admin_page_subject');
    }

    public function subject_delete($id)
    {
        DB::table('subject')
        ->where('id','=',$id)
        ->delete();

        return back();
    }

}
