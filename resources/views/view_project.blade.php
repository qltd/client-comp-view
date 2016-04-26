@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>

                <div class="panel-body">
                    <a href="/admin/new-comp/{{$project}}" class="button">Add Comp</a><br />
                    <a href="" class="button arc-content-trigger">View Archived Comps</a>
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">All Comps for <span class="name">{{str_replace("-"," ",$project)}}</span></div>
                <div class="panel-body">
                        @foreach($comps as $comp) 
                            @if($comp->active == 'active')
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
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container dissapear arc-content-wrap">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Archived Comps</div>
                <div class="panel-body">
                    <ul class="client-list">
                        @foreach($comps as $comp)
                            @if($comp->active != 'active')
                                <li class="comp">
                                    <span class="client-name">{{$comp->title}}</span>
                                    <form method="post" action="/admin/activate-comp">
                                        {{ Form::token() }}
                                        <input type="hidden" name="id" value="{{$comp->id}}" />
                                        <input type="hidden" name="project" value="{{$project}}" />
                                        <input type="submit" value="activate" />
                                    </form>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
