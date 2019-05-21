@extends('layouts.admin')

@section('content')

<h1> Media </h1>



<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
       <th scope="col">File</th>
      <th scope="col">Created</th>
      <th scope="col">Delete Picture</th>
    </tr>
  </thead>
  <tbody>
  @if($photos)

  @foreach($photos as $photo)

  <tr>
    <td>{{$photo->id}}</td>
    <td><img height="50" src="{{$photo->file}}" alt=""></td>
    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
    <td>

      {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy', $photo->id]]) !!}

      <div class="form-group">
        {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6']) !!}
      </div>
        {!! Form::close() !!}
    </td>
  </tr>
@endforeach
@endif
  </tbody>
</table>

@stop
