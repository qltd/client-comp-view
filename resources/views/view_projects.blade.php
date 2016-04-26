@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>

                <div class="panel-body">
                    <a href="/admin/new-project/{{$client}}" class="button">Add New Project</a><br />
                    <a href="" class="button arc-content-trigger">View Archived Projects</a>
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">All Projects for <span class="name">{{str_replace("-"," ",$client)}}</span></div>
                <div class="panel-body">
                    <ul class="project-wrap">
                        @foreach($projects as $project) 
                            @if($project->active == 'active')
                            <li class="project">
                                <span class="name">{{str_replace("-"," ", $project->name)}}</span>
                                <a href="/admin/new-comp/{{$project->name}}">Add Comp</a> |
                                <a href="/admin/view-project/{{$project->name}}">View Project Comps</a> |
                                <a href="/admin/edit-project/{{$project->name}}">Edit Project</a> | 
                                <a href="/view/project/{{$project->name}}">Client View</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container dissapear arc-content-wrap">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Archived Projects</div>
                <div class="panel-body">
                    <ul class="client-list">
                        @foreach($projects as $project)
                            @if($project->active != 'active')
                                <li class="project">
                                    <span class="client-name">{{str_replace("-"," ",$project->name)}}</span>
                                    <form method="post" action="/admin/activate-project">
                                        {{ Form::token() }}
                                        <input type="hidden" name="project_name" value="{{$project->name}}" />
                                        <input type="hidden" name="client_name" value="{{$client}}" />
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
