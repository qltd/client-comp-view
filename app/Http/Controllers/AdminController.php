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

    public function edit_client_form($client){
        $client_data = Client::where('name','=',$client)->get();
        if(!empty($client_data)){
            foreach($client_data as $cd){
                $view_data = array(
                    'name' => $cd->name,
                    'des' => $cd->des
                );
            } 
        }
        return view('edit_client_form',$view_data); 
    }


    public function new_project_form($client=null){
        //display new project form, which requires a list of all clients
        return view('new_project_form',['client' => $client]); 
    }

    public function edit_project_form($project){
        $project_data = Project::where('name','=',$project)->get(); 
        if(!empty($project_data)){
            foreach($project_data as $pd){
                $res = array(
                    'name' => $project,
                    'client_name' => $pd->client,
                    'des' => $pd->des,
                    'start_date' => $pd->start_date,
                    'project_contact' => $pd->project_contact
                ); 
            } 
        }
        return view('edit_project',$res);
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
        $comps = Comp::where('project','=',$project)->orderBy('id','desc')->get();

        return view('view_project',['comps' => $comps, 'project' => $project]);
    }

    public function new_comp_form($project){
        //display a form to add a new comp to a project 
        $comps = Comp::where('project','=',$project)->get();
        return view('new_comp_form',['project' => $project, 'comps' => $comps]);
    }

    public function edit_comp_form($id){
        $comp = Comp::where('id','=',$id)->get(); 
        if(!empty($comp)){
            foreach($comp as $c){
                $res = array(
                    'project' => $c->project,
                    'name' => $c->title,
                    'des' => $c->des,
                    'dd' => $c->display_date,
                    'img' => $c->img_path,
                    'id' => $c->id
                ); 
            } 
            $res['project_comps'] = Comp::where('project','=',$res['project'])->get();
        }
        return view('edit_comp_form',$res);
    }

    /**
     * POST methods
     *
     * */

    public function edit_client(Request $request,$client){
        $des = htmlspecialchars($request->input('des'));
        $cd = Client::where('name','=',$client)->update(array('des'=>$des)); 
        if($cd){
            $request->session()->flash('alert-success', 'Client was updated successfully'); 
        }else{
            $request->session()->flash('alert-warning', 'Sorry, we were not able to update that client'); 
        }
        return redirect("/admin/view-projects/{$client}");
    }

    public function edit_project(Request $request, $project){
        $des = htmlspecialchars($request->input('des'));
        $start_date = htmlspecialchars($request->input('project_start_date'));
        $pd = Project::where('name','=',$project)->update(array('des'=>$des,'start_date'=>$start_date));
        if($pd){
            $request->session()->flash('alert-success', 'Project was updated successfully'); 
        }else{
            $request->session()->flash('alert-warning', 'Sorry, we were not able to update that project'); 
        }
        return redirect("admin/view-project/{$project}");
    }

    public function edit_comp(Request $request){
        $update_array = array(
            'title' => $request->input('comp_name'), 
            'display_date' => $request->input('date'),
            'link' => $request->input('link')
        );
        $update = Comp::where('id','=',$request->input('id'))->update($update_array);
        if($update){
            $request->session()->flash('alert-success', 'Comp was updated successfully'); 
        }else{
            $request->session()->flash('alert-warning', 'Sorry, we were not able to update that comp'); 
        }
        return redirect('/admin/view-project/'.$request->input('project'));
    }

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
            $client->active = 'active';
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
        $project_contact = !empty($request->input('project_contact')) ? $request->input('project_contact') : '';

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
            $project->active = 'active';
            $project->project_contact = $project_contact;
            $project->save();
            $request->session()->flash('alert-success','New project was successfully added');
            $redirect = "/admin/view-projects/{$client}";
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
            $name = 'c'.time().$request->file('file')->getClientOriginalName();
            $request->file('file')->move(__DIR__.'/../../../public/comps',$name);
            //save comp in database
            $comp = new Comp;
            $comp->title = $request->input('comp_name');
            $comp->project = $request->input('project');
            $comp->link = $request->input('link');            
            $comp->img_path = '/comps/'.$name;
            $comp->display_date = $request->input('date');
            $comp->active = 'active';
            $comp->save();
            //redirect and give success message
            $request->session()->flash('alert-success','New comp was successfully added');
            $redirect = "/admin/view-project/{$request->input('project')}";
        }else{
            $request->session()->flash('alert-warning','Sorry, that is not a valid file'); 
            $redirect = '/admin/new-comp/'.$request->input('project');
        }

        return redirect($redirect);
    }

    public function activate_client(Request $request){
        if(!empty($request->input('client_name'))){
            $cd = Client::where('name','=',$request->input('client_name'))->update(array('active'=>'active')); 
            if($cd){
                $request->session()->flash('alert-success','Client was activated');
            }else{
                $request->session()->flash('alert-warning','Client was not able to be activated at this time');
            }
        }else{
                $request->session()->flash('alert-warning','Sorry, we do not know which client should be activated');
        }
        return redirect('/admin');
    }

    public function deactivate_client(Request $request){
        if(!empty($request->input('client_name'))){
            $cd = Client::where('name','=',$request->input('client_name'))->update(array('active'=>'')); 
            if($cd){
                $request->session()->flash('alert-success','Client was archived successfully');
            }else{
                $request->session()->flash('alert-warning','Client was not able to be archived at this time');
            }
        }else{
                $request->session()->flash('alert-warning','Sorry, we do not have enough information to archive that client');
        }
        return redirect('/admin');
    }

    public function activate_project(Request $request){
        if(!empty($request->input('project_name'))){
            $cd = Project::where('name','=',$request->input('project_name'))->update(array('active'=>'active')); 
            if($cd){
                $request->session()->flash('alert-success','Project was activated');
            }else{
                $request->session()->flash('alert-warning','Project was not able to be activated at this time');
            }
        }else{
                $request->session()->flash('alert-warning','Sorry, we do not know which Project should be activated');
        }
        return redirect('/admin/view-projects/'.$request->input('client_name'));
    }

    public function deactivate_project(Request $request){
        if(!empty($request->input('project_name'))){
            $cd = Project::where('name','=',$request->input('project_name'))->update(array('active'=>'')); 
            if($cd){
                $request->session()->flash('alert-success','Project was archived');
            }else{
                $request->session()->flash('alert-warning','Project was not able to be archived at this time');
            }
        }else{
                $request->session()->flash('alert-warning','Sorry, we do not know which Project should be archived');
        }
        return redirect('/admin/view-projects/'.$request->input('client_name'));
    }

    public function deactivate_comp(Request $request){
        if(!empty($request->input('id'))){
            $cd = Comp::where('id','=',$request->input('id'))->update(array('active'=>'')); 
            if($cd){
                $request->session()->flash('alert-success','Comp was archived');
            }else{
                $request->session()->flash('alert-warning','Comp was not able to be archived at this time');
            }
        }else{
                $request->session()->flash('alert-warning','Sorry, we do not know which Comp should be archived');
        }
        return redirect('/admin/view-project/'.$request->input('project_name'));
    }

    public function activate_comp(Request $request){
        if(!empty($request->input('id'))){
            $cd = Comp::where('id','=',$request->input('id'))->update(array('active'=>'active')); 
            if($cd){
                $request->session()->flash('alert-success','Comp was activated');
            }else{
                $request->session()->flash('alert-warning','Comp was not able to be activated at this time');
            }
        }else{
                $request->session()->flash('alert-warning','Sorry, we do not know which Comp should be activated');
        }
        return redirect('/admin/view-project/'.$request->input('project_name'));
    }
}
