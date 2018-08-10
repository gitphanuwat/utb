@extends('layouts.templatehome')
@section('title','ศูนย์จัดการเครือข่าย')
@section('subtitle','จัดการข้อมูล')
@section('body')
<!-- Main content -->
<section class="content">


      <form action="fileentry/add" method="post" enctype="multipart/form-data">
          <input type="file" name="filefield">
          {{ csrf_field() }}
          <input type="submit">
      </form>

   <h1> Pictures list</h1>

   <div class="row">

      <ul>
   @foreach($entries as $entry)
          <a href="{{route('getentry', $entry->filename)}}"><li>{{$entry->filename}}</li></a>
   @endforeach
      </ul>
   </div>


  <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">
      <input type="file" name="filefield">
      {{ csrf_field() }}
      <input type="submit">
  </form>

<h1> Pictures list</h1>
<div class="row">
      <ul class="thumbnails">
@foreach($entries as $entry)
          <div class="col-md-2">
              <div class="thumbnail">
                  <img src="{{route('getentry', $entry->filename)}}" alt="ALT NAME" class="img-responsive" />
                  <div class="caption">
                      <p>{{$entry->original_filename}}</p>
                  </div>
              </div>
          </div>
@endforeach
</ul>
</div>
</section>
<!-- /.content -->
@endsection
