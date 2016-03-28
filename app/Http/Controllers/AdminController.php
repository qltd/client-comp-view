<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('home');
    }

    public function new_client_form(){
        return view('new_client_form');
    }

    //post method calls
    public function new_client_add(Request $request){
       $name = $request->input('client_name');
       $project = $request->input('client_project');
       //call methods varify the input and save it to database
       //then return user to admin dashboard with response message
    }
}
