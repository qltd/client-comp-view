@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Client</div>
                <div class="panel-body">
                    <form method="post" action="/admin/new-client">
                        {{ Form::token() }}
                        <ul style="list-style:none;">
                            <li class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" name="client_name" class="form-control" placeholder="enter client name" />
                            </li>
                            <li class="form-group">
                                <label for="des">Client Description</label>
                                <input type="text" name="des" class="form-control"  placeholder="enter optional description" />
                            </li>
                            <li class="form-group">
                                <input type="submit" name="submit_new_client" class="btn btn-default"  value="save new client" />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
