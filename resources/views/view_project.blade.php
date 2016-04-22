@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add Comp</div>

                <div class="panel-body">
                    <a href="/admin/new-comp/{{$project}}" class="button">Add Comp</a>
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">All Comps for <span class="name">{{str_replace("-"," ",$project)}}</span></div>
                <div class="panel-body">
                        @foreach($comps as $comp) 
                            <div class="row">
                                <div class="col-md-5">
                                    <span class="name">{{$comp->title}}</span>
                                    <span class="des">{{$comp->des}}</span>
                                    <span class="display-date">{{$comp->display_date}}</span>
                                </div>
                                <div class="col-md-5">
                                    <img src="{{$comp->img_path}}" alt="comp image"/>
                                </div>
                                <div class="col-md-2">
                                    <a href="/admin/edit-comp/{{$comp->id}}">edit</a>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
