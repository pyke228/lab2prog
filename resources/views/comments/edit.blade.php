@extends('layout')
@section('content')


@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif



<h1 class="text-center mt-5">Comments</h1>
<div class="container">
  @if(session('save'))
  <div class="alert  alert-success">
    <p>{{session('save')}}</p>
  </div>
  @endif
<form action="/comments/{{$comment->id}}" method=POST  class="mb-3">
    @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title" value="{{$comment->title}}">
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">Text</label>
    <textarea type="text" class="form-control" id="text" name="text" placeholder="Your text" >{{$comment->text}}</textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Update comment</button>
</form>
</div>
@endsection