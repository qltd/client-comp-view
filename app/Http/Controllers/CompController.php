<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comp;

class CompController extends Controller{

    public function view_comp($id){
        $comp = Comp::where('id','=',$id)->get();
        foreach($comp as $c){
            $img = !empty($c->img_path) ? $c->img_path : '';
            $link = !empty($c->link) ? $c->link : '';
        }
        return view('view_comp',['img' => $img, 'link' => $link]);
    }
}
