@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>

                <div class="panel-body">
                    <a href="/admin/new-client" class="button">Add New Client</a>
                    <a href="" class="button arc-content-trigger">View Archived Clients</a>
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">
                    <ul class="client-list">
                        @foreach($clients as $client)
                            @if($client->active == 'active')
                                <li class="client">
                                    <span class="client-name">{{str_replace("-"," ",$client->name)}}</span>
                                    <em>{{$client->des}}</em>
                                    <a href="/admin/new-project/{{$client->name}}">Add Project</a> |
                                    <a href="/admin/view-projects/{{$client->name}}">View Projects</a> |
                                    <a href="/admin/edit-client/{{$client->name}}">Edit Client</a>
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
                <div class="panel-heading">Archived Clients</div>

                <div class="panel-body">
                    <ul class="client-list">
                        @foreach($clients as $client)
                            @if($client->active != 'active')
                                <li class="client">
                                    <span class="client-name">{{str_replace("-"," ",$client->name)}}</span>
                                    <form method="post" action="/admin/activate-client">
                                        {{ Form::token() }}
                                        <input type="hidden" name="client_name" value="{{$client->name}}" />
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
