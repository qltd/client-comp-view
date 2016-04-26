@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Project {{$name}}</div>
                <div class="panel-body">
                    <form method="post" action="/admin/edit-project/{{$name}}">
                        {{ Form::token() }}
                        <ul style="list-style:none;">
                            <li class="form-group">
                                <label for="project_name">Project Name (is not editable)</label>
                                <input type="text" name="project_name" class="form-control" value="{{$name}}" disabled />
                            </li>
                            <li class="form-group">
                                <label for="client_name">Client Name (is not editable)</label>
                                <input type="text" name="client_name" class="form-control" value="{{$client_name}}" disabled />
                            </li>
                            <li class="form-group">
                                <label for="des">Description</label>
                                <input type="text" name="des" class="form-control"  placeholder="enter optional description" value="{{$des}}" />
                            </li>
                            <li class="form-group">
                                <label for="project_start_date">Project Start Date</label>
                                <input type="text" name="project_start_date" class="form-control"  placeholder="enter start date" value="{{$start_date}}" />
                            </li>
                            <li class="form-group">
                                <label for="project_start_date">Project Contacts (put each contact on their own line)</label>
                                <textarea name="project_contact" class="form-control" placeholder="Sally Smith:sally@email.com">{{$project_contact}}</textarea>
                            </li>
                            <li class="form-group">
                                <input type="submit" name="submit_new_client" class="btn btn-default"  value="update" />
                            </li>
                        </ul>
                    </form>
                    <hr>
                    <form method="post" action="/admin/deactivate-project">
                        {{ Form::token() }}
                        <input type="hidden" name="project_name" value="{{$name}}" />
                        <input type="hidden" name="client_name" value="{{$client_name}}" />
                        <input type="submit" value="Archive" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
