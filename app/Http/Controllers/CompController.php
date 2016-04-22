<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Comp;
use App\Project;

class CompController extends Controller{

    public function view_comp($id){
        $comp = Comp::where('id','=',$id)->get();
        foreach($comp as $c){
            $img = !empty($c->img_path) ? $c->img_path : '';
            $link = !empty($c->link) ? $c->link : '/view/project/'.$c->project;
        }
        return view('view_comp',['img' => $img, 'link' => $link]);
    }

    public function view_project($project){
        $comps = Comp::where('project','=',$project)->get(); 
        $project = Project::where('name','=',$project)->get();
        foreach($project as $p){
            $project_name = str_replace('-',' ',$p->name); 
        }
        return view('client_view_project',['comps' => $comps, 'project_name' => $project_name, 'show_client_project' => true, 'show_comp' => true]);
    }
}
