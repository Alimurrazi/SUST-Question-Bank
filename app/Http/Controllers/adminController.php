<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tag;

class adminController extends Controller
{
    public function index()
    {
        $tags = tag::latest()->paginate(10);
        return view('members.index',compact('members'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

        public function create()
    {
        return view('members.create');
    }
    
}
