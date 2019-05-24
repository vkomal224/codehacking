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


          @if(count($comment->replies) > 0)

            @foreach($comment->replies as $reply)

          <!-- Nested Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$reply->author}}
                            <small>{{$reply->created_at->diffForHumans()}}</small>
                        </h4>
                      {{$reply->body}}
                    </div>

               {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply'])!!}
                    <div class="form-group">

                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        {!!Form::label('body', 'Reply: ')!!}
                        {!!Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1 ])!!}
                    </div>
                    <div class="form-group">
                    {!!Form::submit('Send Reply', ['class'=>'btn btn-primary'])!!}
                    </div>

                    {!!Form::close()!!}

                </div>
                @endforeach
                @endif
                <!-- End Nested Comment -->

</div>
@endforeach
@endif
    </div>
@stop
