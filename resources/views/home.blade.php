@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">New Client</div>

                <div class="panel-body">
                    <a href="/admin/new-client" class="button">Add New Client</a>
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">
                    <ul class="client-list">
                        @foreach($clients as $client)
                            <li class="client">
                                <span class="client-name">{{str_replace("-"," ",$client->name)}}</span>
                                <em>{{$client->des}}</em>
                                <a href="/admin/new-project/{{$client->name}}">Add Project</a> |
                                <a href="/admin/view-projects/{{$client->name}}">View Projects</a> |
                                <a href="/admin/edit-client/{{$client->name}}">Edit Client</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
