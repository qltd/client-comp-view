@extends('layouts.app')

@section('content')
<div class="container page-title-wrap">
    <div class="row">
        <div class="col-md-12 ">
            <h2 class="page-title"><a href="/admin/view-projects/{{$client}}">{{$client}}</a></h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Project</div>
                <div class="panel-body">
                    <form method="post" action="/admin/new-project">
                        {{ Form::token() }}
                        <ul style="list-style:none;">
                            <li class="form-group">
                                <label for="project_name">Project Name</label>
                                <input type="text" name="project_name" class="form-control" placeholder="enter project name" />
                            </li>
                            <li class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" name="client_name" class="form-control"  placeholder="enter client name" 
                                        value="{{str_replace("-"," ",$client)}}" />
                            </li>
                            <li class="form-group">
                                <label for="des">Description</label>
                                <input type="text" name="des" class="form-control"  placeholder="enter optional description" />
                            </li>
                            <li class="form-group">
                                <label for="project_start_date">Project Start Date</label>
                                <input type="text" name="project_start_date" class="form-control"  placeholder="enter start date" />
                            </li>
                            <li class="form-group">
                                <label for="project_contact">Project Contacts (put each contact on their own line)</label>
                                <textarea name="project_contact" class="form-control" placeholder="Sally Smith:sally@email.com"></textarea>
                            </li>
                            <li class="form-group">
                                <input type="submit" name="submit_new_client" class="btn btn-default"  value="save new project" />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
