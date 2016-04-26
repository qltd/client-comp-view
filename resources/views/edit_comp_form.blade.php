@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Comp</div>
                <div class="panel-body">
                    <form method="post" action="/admin/new-comp" enctype="multipart/form-data">
                        {{ Form::token() }}
                        <input type="hidden" name="project" value="{{$project}}" />
                        <ul style="list-style:none;">
                            <li class="form-group">
                                <label for="comp_name">Comp Name</label>
                                <input type="text" name="comp_name" class="form-control" placeholder="enter comp name" value="{{$name}}" />
                            </li>
                            <li class="form-group">
                                <label for="des">Comp Description</label>
                                <input type="text" name="des" class="form-control"  placeholder="enter optional description" value="{{$des}}" />
                            </li>
                            <li class="form-group">
                                <label for="date">Display Date</label>
                                <input type="text" name="date" class="form-control"  placeholder="enter date you wish to display" value="{{$dd}}"/>
                            </li>
                            <li class="form-group">
                                <label for="file">Image file is not editable</label>
                                <img src="{{$img}}" alt="comp image" />
                            </li>
                            @if(!empty($project_comps))
                            <li class="form-group">
                                <label for="link">Link</label>
                                <select name="link">
                                    <option value="0">None</option>
                                   @foreach($project_comps as $pcomp) 
                                        <option value="{{$pcomp->id}}">
                                            <span class="name">{{$pcomp->title}}</span>
                                        </option>
                                   @endforeach
                                </select>
                            </li>
                            @endif
                            <li class="form-group">
                                <input type="submit" name="submit_new_client" class="btn btn-default"  value="update" />
                            </li>
                        </ul>
                    </form>
                    <hr>
                    <form method="post" action="/admin/deactivate-comp">
                        {{ Form::token() }}
                        <input type="hidden" name="project_name" value="{{$project}}" />
                        <input type="hidden" name="id" value="{{$id}}" />
                        <input type="submit" value="Archive" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
