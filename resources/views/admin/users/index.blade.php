@extends('layouts.admin')

@section('content')

<h2>Users</h2>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
       <th scope="col">Photos</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Created</th>
      <th scope="col">Updated</th>
    </tr>
  </thead>
  <tbody>
  @if($users)

  @foreach($users as $user)

  <tr>
    <td>{{$user->id}}</td>
    <td><img height="25" src="{{$user->photo ? $user->photo->file : "No user Photo" }}" alt="Photo"></td>
    <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->role['name']}}</td>
    <td>{{$user->created_at->diffForHumans()}}</td>
    <td>{{$user->updated_at->diffForHumans()}}</td>
  </tr>
@endforeach
@endif
  </tbody>
</table>

@stop
