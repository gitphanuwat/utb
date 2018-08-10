@extends('layouts.template')
@section('title','บทความวิชาการ')
@section('body')

  <a href="article/create" class="btn btn-primary">+ADD Article</a>
  <p>All Article</p>
@foreach($articles as $article)
<div class="panel panel-default">
  <div class='panel-heading'>
    <a href="{{url('user/article/'.$article->id)}}">
      {{$article->title}}
    </a>
  </div>
  <div class="panel-body">
      {{$article->body}}
  </div>
  <div class="panel-footer">
      {{$article->published_at->diffForHumans()}}
  </div>
</div>
@endforeach
@stop
