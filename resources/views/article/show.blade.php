@extends('layouts.app')
@section('page_heading','บทความวิชาการ')
@section('content')

<div class="panel panel-default">
  <div class='panel-heading'>
      {{$article->title}}
  </div>
  <div class="panel-body">
      {{$article->body}}
  </div>
  <div class="panel-heading">
      {{$article->published_at}}
  </div>

  <div class="panel-footer">
    <a href="{{url('user/article/'.$article->id.'/edit')}}" class="btn btn-primary">EDIT </a>
    {{ Form::open(array('method'=>'DELETE',
      'url'=>'articles/'.$article->id)) }}
    {{ Form::submit('DELETE',['class'=>'btn btn-danger']) }}
    {{ Form::close() }}
  </div>

</div>

@stop
