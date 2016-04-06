<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

//import models
use App\Client;
use App\Project;
use App\Comp;

class AdminController extends Controller {
    //admin controller controls various admin tasks like adding new clients and projects

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $clients = Client::all();
        return view('home', ['clients' => $clients]);
    }

    public function new_client_form(){
        return view('new_client_form');
    }

    public function new_project_form($client=null){
        //display new project form, which requires a list of all clients
        return view('new_project_form',['client' => $client]); 
    }

    public function view_projects($client=null){
        if(is_null($client)){
           //if we are trying to view projects without a client, go back to the dashboard with a warning message 
           $request->session()->flash('alert-warning', 'Client not selected'); 
           return redirect("/");
        }
        //grab a list of all projects for the client
        $projects = Project::where('client','=',$client)->get();

        return view('view_projects',['client' => $client, 'projects' => $projects]); 
    }

    public function view_project($project=null){
        //This is where we list the specific details of a project for an admin's view
        if(is_null($project)){
           $request->session()->flash('alert-warning', 'Project not selected'); 
           return redirect("/");
        }
        //need to grab project information and return view.
    }

    public function new_comp_form($project){
        //display a form to add a new comp to a project 
        return view('new_comp_form',['project' => $project]);
    }

    //post method calls
    public function new_client_add(Request $request){
       $name = $request->input('client_name');
       $des = !empty($request->input('des')) ? $request->input('des') : '';
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
        $des = !empty($request->input('des')) ? $request->input('des') : '';

        if(!empty($name) && !empty($client)){
            $name = strtolower($name); 
            $name = str_replace(" ","-",$name);
            $client = strtolower($client);
            $client = str_replace(" ","-",$client);
            $project = new Project;
            $project->name = $name;
            $project->client = $client;
            $project->start_date = $start_date;
            $project->des = $des;
            $project->save();
            $request->session()->flash('alert-success','New project was successfully added');
            $redirect = '/admin';
        }else{
            $request->session()->flash('alert-warning','Project name must be filled out and client selected'); 
            $redirect = '/admin/new-project';
        }

        return redirect($redirect);
    }

    public function new_comp(Request $request){
        //add a new comp for a project 
        //we are also handling file upload in this method
        if($request->file('file')->isValid()){
            //name file, move file 
            //$name = 
            //$request->file('file')->move('/comps',$name);
            var_dump($request->file('file')->getClientOriginalName());
            die;
        }else{
            $request->session()->flash('alert-warning','Sorry, that is not a valid file'); 
            $redirect = '/admin/new-comp/'.$request->input('project');
        }

        return redirect($redirect);
    }
}
