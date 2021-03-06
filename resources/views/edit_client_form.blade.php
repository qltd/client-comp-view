@extends('layouts.app')

@section('content')
<div class="container page-title-wrap">
    <div class="row">
        <div class="col-md-12 ">
            <h2 class="page-title"><a href="/admin/view-projects/{{$name}}">{{$name}}</a></h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Client {{$name}}</div>
                <div class="panel-body">
                    <form method="post" action="/admin/edit-client/{{$name}}">
                        {{ Form::token() }}
                        <ul style="list-style:none;">
                            <li class="form-group">
                                <label for="client_name">Client Name (is not editable)</label>
                                <input type="text" name="client_name" class="form-control" value="{{$name}}" disabled />
                            </li>
                            <li class="form-group">
                                <label for="des">Client Description</label>
                                <input type="text" name="des" class="form-control"  placeholder="enter optional description" value="{{$des}}" />
                            </li>
                            <li class="form-group">
                                <input type="submit" name="update" class="btn btn-default"  value="update" />
                            </li>
                        </ul>
                    </form>
                    <hr>
                    <form method="post" action="/admin/deactivate-client">
                        {{ Form::token() }}
                        <input type="hidden" name="client_name" value="{{$name}}" />
                        <input type="submit" value="Archive" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
