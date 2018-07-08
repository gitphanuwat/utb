@extends('layouts.template')
@section('title','พื้นที่ชุมชน')
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
            <h3 class="box-title">รายงานข้อมูลพื้นที่ชุมชน</h3>
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
              <label>ศูนย์จัดการเครือข่าย</label>
              <select name="center_id" id="center_id" class="form-control" style="width:350px">
                  <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>
              </select>
            </div>

            <div class="form-group">
              <label>กลุ่มปัญหาในพื้นที่ชุมชน</label>
              <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                  <option value="">--- เลือกกลุ่มปัญหา ---</option>
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

      loaddata('','','');

      $('select[name="university_id"]').on('change', function() {
        var stateID = $(this).val();
        loadselect(stateID,'');
      });

      $('.btnprint').click(function(){
        window.print();
      });

      $('.btnupdate').click(function(){
        var id = $('#university_id').val();
        var idcen = $('#center_id').val();
        var idtag = $('#taggroup_id').val();
        loaddata(id,idcen,idtag);
      });

  });

  function loadselect(id,idcen){
        $.ajax({
            url : '{!! url('ajax') !!}'+'/'+id,
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="center_id"]').empty();
                $('select[name="center_id"]').html('<option value="">-- เลือกศูนย์จัดการเครือข่าย --</option>');
                $.each(data, function(key, value) {
                    $('select[name="center_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
                $('#center_id').val(idcen);
            }
        });
  }

  function loaddata(id,idcen,idtag){
    //alert(id);
      $.ajax({
        url : '{!! url('report/loadarea') !!}',
        type : "get",
        //asyncfalse
        data : {
          'id' : id,
          'idcen' : idcen,
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
