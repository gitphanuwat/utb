@extends('layouts.app')
@section('page_heading','บทความวิชาการ')
@section('content')

<h2 class="page-title">แก้ไขบทความวิชาการ</h2>
  @include('errors.list')

  {{ Form::open(array('method' => 'PATCH',
      'action' => ['ArticlesController@update',$article->id])) }}

  @include('Articles._form',
      ['submitButtonText' => 'Edit Article'])

  {{ Form::close() }}

@stop
