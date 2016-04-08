@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Comp for <span class="name">{{str_replace("-"," ",$project)}}</span></div>
                <div class="panel-body">
                    <form method="post" action="/admin/new-comp" enctype="multipart/form-data">
                        {{ Form::token() }}
                        <input type="hidden" name="project" value="{{$project}}" />
                        <ul style="list-style:none;">
                            <li class="form-group">
                                <label for="comp_name">Comp Name</label>
                                <input type="text" name="comp_name" class="form-control" placeholder="enter comp name" />
                            </li>
                            <li class="form-group">
                                <label for="des">Comp Description</label>
                                <input type="text" name="des" class="form-control"  placeholder="enter optional description" />
                            </li>
                            <li class="form-group">
                                <label for="date">Display Date</label>
                                <input type="text" name="date" class="form-control"  placeholder="enter date you wish to display" />
                            </li>
                            <li class="form-group">
                                <label for="file">Upload File</label>
                                <input type="file" name="file" class="form-control" />
                            </li>
                            @if(!empty($comps))
                            <li class="form-group">
                                <label for="link">Link</label>
                                <select name="link">
                                    <option value="0">None</option>
                                   @foreach($comps as $comp) 
                                        <option value="{{$comp->id}}">
                                            <span class="name">{{$comp->title}}</span>
                                        </option>
                                   @endforeach
                                </select>
                            </li>
                            @endif
                            <li class="form-group">
                                <input type="submit" name="submit_new_client" class="btn btn-default"  value="add new comp" />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
