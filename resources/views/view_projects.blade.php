@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">New Project</div>

                <div class="panel-body">
                    <a href="/admin/new-project/{{$client->name}}" class="button">Add New Project</a>
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">All Projects for {{str_replace("-"," ",$client)}}</div>
                <div class="panel-body">
                    <ul class="project-wrap">
                        @foreach($projects as $project) 
                            <li class="project">
                                <span class="name">{{str_replace("-"," ", $project->name)}}</span>
                                <a href="">Add Comp</a> |
                                <a href="">View Project</a> |
                                <a href="">Edit Project</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
