@extends('layouts.blog-post')

@section('content')

<!-- Blog Post -->

<!-- Title -->
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo->file}}" alt="">

<hr>

<!-- Post Content -->
<p class="lead">{{$post->body}}</p>

<hr>
@if(Session::has('comment_msg'))

{{session('comment_msg')}}

@endif
  <!-- Blog Comments -->


@if(Auth::check())

  <!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>

{!!Form::open (['method'=>'POST' , 'action'=>'PostCommentsController@store'])!!}

<input type="hidden" name="post_id" value="{{$post->id}}">
<div class="form-group">
    {!!Form::label('body', 'Comment: ')!!}
    {!!Form::textarea('body', null, ['class'=>'form-control', 'row'=>3])!!}
</div>
<div class="form-group">
{!!Form::submit('Submit Comment', ['class'=>'btn btn-primary'])!!}
</div>

{!!Form::close()!!}

</div>
@endif

<hr>
<!-- Posted Comment -->

@if(count($comments) > 0)
  @foreach ($comments as $comment)
  <!-- Comment -->
  <div class="media">
      <a class="pull-left" href="#">
          <img height="64" class="media-object" src="" alt="">
      </a>
      <div class="media-body">
          <h4 class="media-heading">{{$comment->author}}
              <small>{{$comment->created_at->diffForHumans()}}</small>
          </h4>
          <p>{{$comment->body}}</p>
</div>
@endforeach
@endif

<!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        <!-- Nested Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Nested Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
        <!-- End Nested Comment -->
    </div>
</div>

</div>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <div class="input-group">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>

</div>
@stop
