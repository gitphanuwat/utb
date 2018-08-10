@extends('layouts.template')
@section('title','พื้นที่ชุมชน')
@section('body')

    <a href="{{url("areas/create")}}" class="btn btn-info pull-right">Add a area</a>

    <div class="panel-body">
      <div class="form-group">
          <label for="title">Select University:</label>
          <select name="university_id" class="form-control" style="width:350px">
              <option value="">--- Select State ---</option>
              @foreach ($objsuniv as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
          </select>
      </div>
          <div class="form-group">
              <label for="title">Select Center:</label>
              <select name="center_id" class="form-control" style="width:350px">
                <option value="">--- Select Center ---</option>
              </select>
          </div>
    </div>

    <div class="table-responsive">
    <table class="table">
      <tr>
        <td>ID</td>
        <td>มหาวิทยาลัย</td>
        <td>ชื่อศูนย์จัดการเครือข่าย</td>
        <td>ชื่อพื้นที่ชุมชน</td>
        <td>ผู้นำกลุ่ม</td>
        <td>Action</td>
      </tr>
@foreach($objs as $row)
      <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->center->university->name}}</td>
        <td>{{$row->center->name}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->keyman}}</td>
        <td>
          <form action="{{url('areas/'.$row->id)}}" method="post" onsubmit="return(confirm('ลบข้อมูล'))">
            <a href="{{url('areas/'.$row->id.'/edit')}}" class="btn btn-primary">EDIT</a>
            {{ method_field('DELETE') }}
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <button type="submit" class="btn btn-danger">DELETE</button>
          </form>
        </td>
      </tr>
@endforeach
    </table>
  </div>
@stop
@section('script')

<script type="text/javascript">
$(document).ready(function() {
  //alert("aa");
    $('select[name="university_id"]').on('change', function() {
        var stateID = $(this).val();

        if(stateID) {
          //alert(stateID);
          //$('select[name="center_id"]').html('<option value="">--ไม่พบข้อมูล--</option>');

            $.ajax({
                url: '{!! url('ajax') !!}'+'/'+stateID,
                type: "GET",
                dataType: "json",
                success:function(data) {
                  //alert("TEST");
                    $('select[name="center_id"]').empty();
                    $('select[name="center_id"]').html('<option value="">-- Select Center --</option>');
                    $.each(data, function(key, value) {
                        $('select[name="center_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    //$('select[name="center_id"]').html('<option value="">--test--</option>');
                }
            });
        }else{
            $('select[name="center_id"]').empty();
            $('select[name="center_id"]').html('<option value="">--ไม่พบข้อมูล--</option>');
        }
    });
});

</script>
@endsection
