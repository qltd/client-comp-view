<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller {
    //admin controller controls various admin tasks like adding new clients and projects

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        return view('home');
    }

    public function new_client_form(){
        return view('new_client_form');
    }

    public function new_project_form(){
        //display new project form, which requires a list of all clients
        return view('new_project_form'); 
    }

    //post method calls
    public function new_client_add(Request $request){
       $name = $request->input('client_name');
       $des = $request->input('client_des');
       //call methods varify the input and save it to database
       //then return user to admin dashboard with response message
       if(!empty($name)){
            //make lowercase
            $name = strtolower($name); 

            //remove white space
            $name = str_replace(" ","-",$name);

            //save new client
            $client = new Client;
            $client->name = $name;
            $client->des = $des;
            $client->save();
            //I guess we just assume all saves are successful?
            //(sarcastic) yay frameworks! 
            $request->session()->flash('alert-success', 'New client was added successfully'); 
            $redirect = '/admin';
       }else{
           $request->session()->flash('alert-warning', 'Client name must be filled out'); 
           $redirect = '/admin/new-client';
       }

       return redirect($redirect);
    }

    public function new_project_add(Request $request){
        //add a new project 
        $name = $request->input('project_name');
        $client = $request->input('client_name');
        $start_date = $request->input('project_start_date');

        if(!empty($name) && !empty($client)){
            $name = strtolower($name); 
            $name = str_replace(" ","-",$name);
            $client = strtolower($client);
            $client = str_replace(" ","-",$client);
            $project = new Project;
            $project->name = $name;
            $project->client = $client;
            $project->start_date = $start_date;
            $project->save();
            $request->session()->flash('alert-success','New project was successfully added');
            $redirect = '/admin';
        }else{
            $request->session()->flash('alert-warning','Project name must be filled out and client selected'); 
            $redirect = '/admin/new-project';
        }

        return redirect($redirect);
    }
}
