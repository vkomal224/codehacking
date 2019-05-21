@extends('layouts.admin')

@section('content')
@if(Session::has('duser'))

 <p>{{session('duser')}}</p>

@endif

<h1> Posts </h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Photo</th>
       <th scope="col">User</th>
      <th scope="col">Category</th>
     <th scope="col">Title</th>
     <th scope="col">Body</th>
    <th scope="col">Created</th>
    <th scope="col">Updated</th>

    </tr>
  </thead>
  <tbody>
  @if($posts)

  @foreach($posts as $post)

  <tr>
    <td>{{$post->id}}</td>
    <td> <img height = "50" src="{{$post->photo ? $post->photo->file : 'No photo has been placed'}}" alt=""></td>
    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</td>
    <td>{{$post->categories_id}}</td>
    <td>{{$post->title}}</td>
    <td>{{str_limit($post->body, 50)}}</td>
    <td>{{$post->created_at->diffForHumans()}}</td>
    <td>{{$post->updated_at->diffForHumans()}}</td>
  </tr>
@endforeach
@endif
  </tbody>
</table>

@stop
