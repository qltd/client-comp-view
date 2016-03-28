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
                    Client list goes here
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
