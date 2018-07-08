@extends('layouts.template')
@section('title','งานวิจัย')
@section('subtitle','รายงานข้อมูล')
@section('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset("assets/plugins/morris/morris.css") }}">
@endsection
<?php
use App\University;
use App\Taggroup;
use App\Research;
use App\Researcher;
use App\Expertlist;
?>

@section('body')
<div class="row">
<div class="col-md-12">
  <div id='showgraph1'>
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">รายงานข้อมูลงานวิจัย</h3>
          </div>
          <div class="box-body with-border">
            <div class="form-group">
              <label>มหาวิทยาลัย</label>
              <select name="university_id" id="university_id" class="form-control" style="width:350px">
                  <option value="">--- เลือกมหาวิทยาลัย ---</option>
                  @foreach ($objuniver as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>กลุ่มงานวิจัย</label>
              <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                  <option value="">--- เลือกกลุ่มงานวิจัย ---</option>
                  @foreach ($objtag as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
              </select>
            </div>

            <button type="button"  class="btn btn-primary btnupdate">แสดงข้อมูล</button>

          </div>
      </div>
  </div>


    <div class="box box-primary">
          <div class="box-body">
            <div id="displayrecord">

            </div>
          </div>

          <div class="box-footer">
            <div class="pull-right">
              <button type="button" class="btn btn-default btnprint"><i class="fa fa-print"></i> Print</button>
            </div>
          </div>

        </div>

</div>
</div>

@endsection
@section('script')

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset("assets/plugins/morris/morris.min.js") }}"></script>


<script type="text/javascript">
    $(function(){

      loaddata('','');

      $('.btnprint').click(function(){
        window.print();
      });

      $('.btnupdate').click(function(){
        var id = $('#university_id').val();
        var idtag = $('#taggroup_id').val();
        loaddata(id,idtag);
      });

  });


  function loaddata(id,idtag){
    //alert(idtag);
      $.ajax({
        url : '{!! url('report/loadresearch') !!}',
        type : "get",
        //asyncfalse
        data : {
          'id' : id,
          'idtag' : idtag,
        },
        success : function(s)
        {
          $('#displayrecord').html(s);
          $("#example1").DataTable();
        }
      });
  }


</script>

@endsection
