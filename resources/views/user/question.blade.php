@extends('layouts.template')
@section('title','ข้อมูลการสื่อสาร')
@section('subtitle','จัดการข้อมูลการสื่อสาร')

@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">การสื่อสารข้อมูล</h3>
            </div>
            <!-- /.box-header -->
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail"><i class="fa fa-fw fa-plus"></i> สร้างข้อความใหม่</button>
              </div>
              <!-- /.box-body -->
            </div>

          <div id='showdetail'>
          <!-- form start -->

          <div id = 'msgname'></div>

          <form role="form" id="form_data" name="form_data">
            <div class="box-body">

              <div class="form-group">
                <label>ชื่อเรื่อง</label>
                <input type="text" class="form-control" name="topic" id="topic"  placeholder="ชื่อเรื่อง" value="">
              </div>
              <div class="form-group">
                <label>รายละเอียด</label>
                <textarea class="textarea" id="detail" name="detail" value="รายละเอียด" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
              <div class="form-group">
                <label>ผู้ส่ง : {{Auth::user()->headname}}{{Auth::user()->firstname}} {{Auth::user()->lastname}}({{Auth::user()->email}})</label>
              </div>
              <div class="form-group">
                <label>ผู้รับ : เลือกนักวิจัยและผู้เชี่ยวชาญ</label>
                <div class="box-body with-border">
                  <div class="form-group">
                    <label>มหาวิทยาลัย</label>
                    <select name="university_id" id="university_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกมหาวิทยาลัย ---</option>
                      <option value="*">--- เลือกทั้งหมด ---</option>
                        @foreach ($objuniver as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                  </div>

                </div>
                <div class="showresearcher"></div>
              </div>

              <input type="hidden"  id="id">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
              <input type="hidden" name="sender" id="sender" value="{{Auth::user()->headname}}{{Auth::user()->firstname}} {{Auth::user()->lastname}}">
              <input type="hidden" name="tel" id="tel" value="{{Auth::user()->tel}}">
              <input type="hidden" name="address" id="address" value="{{Auth::user()->address}}">
              <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}">
              <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">

              <button type="button"  class="btn btn-primary saverecord">ส่งข้อมูล</button>
              <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
            </div>
            <div id="loading" align="center">
                <img src="{{url('images/ajax-loader.gif')}}" align="absmiddle" />
            </div>
          </form>
        </div>
        </div>
        <div class='showreport'></div>
</div>
</div>

@endsection
@section('script')

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<script type="text/javascript">
    $(function(){

      $('.showreport').hide();
      $('#showdetail').hide();
      $('#loading').hide();

      displaydata();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('.showreport').hide();
          $('.showresearcher').html('');
          $( '#msgname' ).html('');
          $('#topic').focus();
      });

      $('body').delegate('.report','click',function(){
          $('.showreport').show();
          $('#showdetail').hide();
          $('.btndetail').show();
          var id = $(this).data('id');
          displayreport(id);
      });

      $('.btncancel').click(function(){
        $("#form_data")[0].reset();
        $('.showreport').hide();
        $('#showdetail').hide();
        $('.btndetail').show();
      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.showreport').hide();
        $.ajax({
            url : '{!! url('user/question') !!}'+'/'+id,
            type : "POST",
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              $('.showreport').hide();
              $('#showdetail').hide();
              $('.btndetail').show();
              displaydata();
            }
        });
      }
      });
      $('select[name="university_id"]').on('change', function() {
        var id = $(this).val();
        getresearcher();
      });
  });

  $('.saverecord').click(function(){
    $("#loading").show();
          $.ajax({
              url : '{!! url('sendmail') !!}',
              type : "post",
              data : $('form#form_data').serialize(),
              success:function(m)
              {
                if(m == 1){
                  $( '#msgname' ).html('<div class="alert alert-success">ส่งข้อมูลมูลสำเร็จ</div>');
                  alert('ส่งข้อความสำเร็จ');
                  savedata();
                  //window.history.back();
                }else if(m == 2){
                  $( '#msgname' ).html('<div class="alert alert-danger">อีเมล์ผู้ส่งไม่ถูกต้อง</div>');
                  $("#loading").fadeOut();
                }else{
                  $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาดในการส่งข้อความ</div>');
                  $("#loading").fadeOut();
                }
              },
              error:function(err){
                  if( err.status === 422 ) {
                    var errors = err.responseJSON; //this will get the errors response data.
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each( errors, function( key, value ) {
                      errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';

                    $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                  }else{
                    $( '#msgname' ).html( 'ERROR : '+err.status );
                  }
               }
          });
      function savedata(){
            $.ajax({
                url : '{!! url('user/question') !!}',
                type : "post",
                data : $('form#form_data').serialize(),
                success:function(re)
                {
                  if(re == 0){
                    displaydata();
                    //$( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    $("#loading").fadeOut();
                    $("#form_data")[0].reset();
                    $('.showreport').hide();
                    $('#showdetail').hide();
                    $('.btndetail').show();
                  }else{
                    $( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาดในการบันทึกข้อมูล</div>');
                  }
                },
                error:function(err){
                    if( err.status === 422 ) {
                      var errors = err.responseJSON; //this will get the errors response data.
                      errorsHtml = '<div class="alert alert-danger"><ul>';
                      $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                      });
                      errorsHtml += '</ul></di>';

                      $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    }else{
                      $( '#msgname' ).html( 'ERROR : '+err.status );
                    }
                 }
            });
        }
  });
    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('user/question/create') !!}',
        type : "get",
        data : {},
        success : function(s)
        {
          //alert(s.cobj);
          $('.displayrecord').html(s.display);
          $("#example1").DataTable();
          $( '#cquestion' ).html(s.cobj);
        }
      });
    }

    function displayreport(id){
      //$('.showreport').html(id);
      //alert(0);
      $.ajax({
        url : '{!! url('user/question') !!}'+'/'+id,
        type : "get",
        data : {},
        success : function(s)
        {
          //alert(0);
          $('#showreport').show();
          $('.showreport').html(s);
        }
      });
    }

    function getresearcher(){
      //alert(0);
      $.ajax({
        url : '{!! url('user/question/getresearcher') !!}',
        type : "post",
        data : $('form#form_data').serialize(),
        success : function(s)
        {
          //alert(s);
          $('.showresearcher').html(s);
          $("#example2").DataTable();
          //if(re == 0){alert('save');}else{alert('not save');}
        }
      });
    }

  function do_this() {
    var checkboxes = document.getElementsByName('check_users[]');
    var check = document.getElementById('toggle');

    if(check.checked){
        for (var i in checkboxes){
            checkboxes[i].checked = 'FALSE';
        }
    }else{
        for (var i in checkboxes){
            checkboxes[i].checked = '';
        }
    }
  }


</script>




@endsection
