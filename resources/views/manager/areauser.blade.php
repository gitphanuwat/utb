@extends('layouts.template')
@section('title','ข้อมูลพื้นที่ชุมชน')
@section('subtitle','จัดการข้อมูล')

@section('body')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">อัพโหลดไฟล์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="form_upload" name="form_upload" role="form" method="POST" action="" >
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><label style="width:120px">ชื่อไฟล์</label></span>
              <input type="text" class="form-control" name="filename" id="filename" placeholder="ตั้งชื่อไฟล์เอกสาร">
              <input type="hidden" class="form-control" name="filetype" id="filetype">
              <input type="hidden" class="form-control" name="areaf_id" id="areaf_id">
              <input type="hidden" name="_token" value="{{ csrf_token()}}">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><label style="width:120px">ไฟล์</label></span>
              <input type="file" class="form-control" name="filefield" id="filefield">
            </div>
          </div>
        <form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary uploadfile">อัพโหลด</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลพื้นที่ชุมชน</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btnbackprobm"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
              </div>
              <!-- /.box-body -->
            </div>

            <div id='showdetail'>
            <!-- form start -->
            <div id = 'msgname'></div>

            <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" id="j">ข้อมูลพื้นที่ชุมชน</h3>
            </div>
            <div class="box-body">
            <form role="form" id="form_data" name="form_data">
              <div class="box-body">
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">  <label type="button" class="btn btn-success" style="width:150px">มหาวิทยาลัย</label> </span>
                  <label class="form-control" id="university"></label>
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn"><button type="button" class="btn btn-success" style="width:150px">ศูนย์จัดการเครือข่าย</button> </span>
                  <label class="form-control" id="center"></label>
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">  <button type="button" class="btn btn-success" style="width:150px">พื้นที่ชุมชน</button> </span>
                  <label class="form-control" id="area"></label>
                </div>
                </div>


                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><label style="width:120px"> บริบทชุมชน</label></span>
                    <textarea class="form-control" id="context" name="context" placeholder="บริบทชุมชน"></textarea>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><label style="width:120px">หรือ <a href='#j' data-id='1' class="upload" data-target="#exampleModal"><i class='fa fa-paperclip'></i>แนบไฟล์</a></label></span>
                    <div id='file1'></div>
                  </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> จำนวนประชากร</label></span>
                  <input type="text" class="form-control" name="people" id="people" placeholder="จำนวนประชากร">
                  <span class="input-group-addon">คน</span>
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px">หรือ <a href='#j' data-id='2' class="upload" data-target="#exampleModal"><i class='fa fa-paperclip'></i>แนบไฟล์</a></label></span>
                  <div id='file2'></div>
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> ข้อมูลสุขภาพ</label></span>
                  <textarea class="form-control" id="health" name="health" placeholder="ข้อมูลสุขภาพในชุมชน"></textarea>
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px">หรือ <a href='#j' data-id='3' class="upload" data-target="#exampleModal"><i class='fa fa-paperclip'></i>แนบไฟล์</a></label></span>
                  <div id='file3'></div>
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> สภาวะสิ่งแวดล้อม</label></span>
                  <textarea class="form-control" id="environment" name="environment" placeholder="สภาวะสิ่งแวดล้อม"></textarea>
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px">หรือ <a href='#j' data-id='4' class="upload" data-target="#exampleModal"><i class='fa fa-paperclip'></i>แนบไฟล์</a></label></span>
                  <div id='file4'></div>
                </div>
                </div>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  (ไฟล์เอกสารประเภท pdf, docx, xlsx, pptx, jpg, png ขนาดไม่เกิน 20 MB)
                </p>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> ผู้ประสานงาน</label></span>
                  <input type="text" class="form-control" name="keyman" id="keyman" placeholder="ผู้ประสานงาน">
                </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><label style="width:120px"> เบอร์โทรศัพท์</label></span>
                  <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรศัพท์">
                </div>
                </div>
                <input type="hidden"  id="id">
                <button type="button" class="btn btn-primary updaterecord">บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="box">
        <div class="box-body">
          <div class="displaydetail" id="d"></div>
          <div class="displayproblem" id="l"></div>
          <div class="displaydetailproblem" id="de"></div>
          <button type='button' class='btn btn-primary btndetailprobm'><i class='fa fa-fw fa-plus'></i> เพิ่มข้อมูล</button>
          <div class="showdetailprobm">
            <div class="box-body">
            <div id = 'msgnameprobm'></div>
            <form id="form_dataprobm" name="form_dataprobm">
                <div class="form-group" id="m">
                  <label>กลุ่มปัญหาชุมชน</label>
                  <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                      <option value="">--- กลุ่มปัญหาชุมชน ---</option>
                      @foreach ($objtag as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <div id = 'taggroupdetail'></div>
                </div>

            <div class="form-group">
            <label>ข้อมูลปัญหาชุมชน</label>
            </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> หัวข้อปัญหา</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="หัวข้อปัญหา">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> รายละเอียด</label></span>
                  <textarea id="detail" name="detail" placeholder="รายละเอียด" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ประเด็นปัญหา</label></span>
                  <textarea class="form-control" id="instruct" name="instruct" placeholder="ประเด็นปัญหา"></textarea>
                </div>
                </div>

                <input type="hidden"  id="idp" name="idp">
                <input type="hidden"  id="area_id" name="area_id">
                <button type="button"  class="btn btn-primary saverecordprobm">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecordprobm">อัพเดทข้อมูล</button>
                <button type="button" class="btn btn-danger btncancelprobm">ยกเลิก</button>
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
            </form>
            </div>

          </div>
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

<script type="text/javascript">
    $(function(){

      $('body').delegate('.delfile','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $.ajax({
            url : '{!! url('manager/areauser') !!}'+'/'+id,
            type : "POST",
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(d);
              $('#file1').html(d.areafile1);
              $('#file2').html(d.areafile2);
              $('#file3').html(d.areafile3);
              $('#file4').html(d.areafile4);
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
                }else if(err.status === 404 || err.status === 500){
                  alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                }else{
                  $( '#msgname' ).html( 'ERROR : '+err.status );
                }
            }
        });
      }
      });

      $('#showdetail').hide();
      $('.showdetailprobm').hide();
      $('.btndetailprobm').hide();
      $('.btnbackprobm').hide();
      $('.updaterecord').hide();
      $('.btnbackprobm').hide();

      $('select[name="taggroup_id"]').on('change', function() {
        var id = $(this).val();
        $.ajax({
            url : '{!! url('manager/tagdetail') !!}',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}',
              'id' : id,
            },
            success : function(e)
            {
              $('#taggroupdetail').html(e);
            }
        });
      });

      $('.uploadfile').click(function(){
        //alert('upload start');
          //var research_id = $('#research_id').val();
              $.ajax({
                  url : '{!! url('manager/uploadfile') !!}',
                  async:false,
                  type:'post',
                  processData: false,
                  contentType: false,
                  data:new FormData($("#form_upload")[0]),
                  success:function(re)
                  {
                    //alert(re);
                    if(re.check == 1){
                      //displaydata();
                      $('#exampleModal').modal('hide');
                      $( '#msgname' ).html('<div class="alert alert-success">แนบไฟล์สำเร็จ</div>');
                      $('#file1').html(re.areafile1);
                      $('#file2').html(re.areafile2);
                      $('#file3').html(re.areafile3);
                      $('#file4').html(re.areafile4);

                    }
                    $("#form_upload")[0].reset();
                    //$('#research_id').val(research_id);
                  },
                  error:function(err){
                    //  alert(err);
                      if( err.status === 422 ) {
                        var errors = err.responseJSON; //this will get the errors response data.
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each( errors, function( key, value ) {
                          errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';
                        $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                      }else if(err.status === 404 || err.status === 500){
                        alert('กรุณาตรวจสอบข้อมูล');
                      }else{
                        $( '#msgname' ).html( 'ERROR : '+err.status );
                      }
                   }
              });
      }) ;

      $('.upload').click(function(){
          var id = $(this).data('id');
          var area_id = $('#id').val();
          $('#exampleModal').modal('show')
          $('#filename').val('');
          $('#filefield').val('');
          $('#filetype').val(id);
          $('#areaf_id').val(area_id);
      });

      $('.btncancel').click(function(){
          $('.updaterecord').hide();
          $('#showdetail').hide();
          $('#msgname').html('');
      });

      $('.btncancelprobm').click(function(){
        //alert(0);
          $('.updaterecordprobm').hide();
          $('.showdetailprobm').hide();
          $('#msgnameprobm').html('');
          $('.btndetailprobm').show();
          $('#taggroupdetail').html('');
          $("#form_dataprobm")[0].reset();
          $('#detail').html('');

      });

      $('.btnbackprobm').click(function(){
          $('.displayproblem').hide();
          $('.displayrecord').show();
          $('#taggroupdetail').html('');
          $('.btnbackprobm').hide();
          $('.showdetailprobm').hide();
          $('.btndetailprobm').hide();
          $('.displaydetail').hide();
          $('.displaydetailproblem').hide();


      });

      displaydata();

      $('body').delegate('.btndetailprobm','click',function(){
        $('#taggroupdetail').html('');
        $('.showdetailprobm').show();
        $('.saverecordprobm').show();
        $('.updaterecordprobm').hide();
        $('.btndetailprobm').hide();
        $('.displaydetail').hide();
        $('.displaydetailproblem').hide();

        //alert(0);
      });

      $('body').delegate('.upprobm','click',function(){
        $('#showdetail').hide();
        $('.displaydetail').hide();
        $('.displayrecord').hide();
        //$('.btndetailprobm').hide();
        //$('.btnback').show();
        $('.btndetailprobm').show();
        $('.displayproblem').show();
        $('.btnbackprobm').show();
        $('#msgnameprobm').html('');
        $('#taggroupdetail').html('');

        var id = $(this).data('id');
        displayprobm(id);

      });

      $('body').delegate('.edit','click',function(){
        $('.updaterecord').show();
        $('#showdetail').show();
        $('#msgname').html('');
        $('#taggroupdetail').html('');
        $('.displaydetail').hide();

        $('#name').focus();
        var id = $(this).data('id');

        //alert(id);
        $.ajax({
            url : '{!! url('manager/areauser') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.name);
              $('#id').val(e.id);
              $('#university').html(e.university_name);
              $('#center').html(e.center_name);
              $('#file1').html(e.areafile1);
              $('#file2').html(e.areafile2);
              $('#file3').html(e.areafile3);
              $('#file4').html(e.areafile4);
              $('#area').html(e.name);
              $('#context').val(e.context);
              $('#people').val(e.people);
              $('#health').val(e.health);
              $('#environment').val(e.environment);
              $('#keyman').val(e.keyman);
              $('#tel').val(e.tel);
            },
            error:function(err){
              if(err.status === 404 || err.status === 500){
                alert('สิทธิ์การใช้งานไม่ถูกต้อง');
              }else{
                $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
              }
            }

        });
      });

      $('body').delegate('.deleteprobm','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var idp = $(this).data('id');
        var area_id = $('#area_id').val();
        $('.updaterecordprobm').hide();
        $('.saverecordprobm').show();
        $('.showdetailprobm').hide();
        $('.displaydetail').hide();
        $('.btndetailprobm').show();
        $('.displaydetailproblem').hide();
        $('#taggroupdetail').html('');
        $.ajax({
            url : '{!! url('manager/problem') !!}'+'/'+idp,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(d);
              $("#form_dataprobm")[0].reset();
              $('#detail').html('');
              displaydata();
              displayprobm(area_id);
              $('#area_id').val(area_id);
            },
            error:function(err){
              if(err.status === 404 || err.status === 500){
                alert('สิทธิ์การใช้งานไม่ถูกต้อง');
              }else{
                $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
              }
            }
        });
      }
      });

      $('body').delegate('.titledetail','click',function(){
        $('.btndetailprobm').show();
        $('.showdetailprobm').hide();
        $('.displaydetailproblem').show();

        var idp = $(this).data('id');
        //alert(id);
        $.ajax({
            url : '{!! url('manager/problem') !!}'+'/'+idp,
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              $('.displaydetailproblem').html(e);
            },
            error:function(err){
              if(err.status === 404 || err.status === 500){
                alert('สิทธิ์การใช้งานไม่ถูกต้อง');
              }else{
                $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
              }
            }
        });
      });

      $('body').delegate('.report','click',function(){
        $('.displaydetail').show();
        $('.showdetailprobm').hide();

        var ida = $(this).data('id');
        //alert(ida);
        $.ajax({
            url : '{!! url('manager/areauser') !!}'+'/'+ida,
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              $('.displaydetail').html(e);
            },
            error:function(err){
              if(err.status === 404 || err.status === 500){
                alert('สิทธิ์การใช้งานไม่ถูกต้อง');
              }else{
                $( '#msgname' ).html( 'ERROR : '+err.status );
              }
            }
        });
      });

  }); //End Functions

  $('body').delegate('.editprobm','click',function(){
    $('.updaterecordprobm').show();
    $('.showdetailprobm').show();
    $('.btndetailprobm').hide();
    $('.saverecordprobm').hide();
    $('.displaydetail').hide();
    $('.displaydetailproblem').hide();
    $('#msgnameprobm').html('');
    $('#taggroupdetail').html('');
    $('#title').focus();
    $("#form_dataprobm")[0].reset();
    var idp = $(this).data('id');
    //alert(idp);
    $.ajax({
        url : '{!! url('manager/problem') !!}'+'/'+idp+'/edit',
        type : "get",
        //asyncfalse
        data : {
          '_token': '{{ csrf_token() }}'
        },
        success : function(e)
        {
          //alert(e.detail);
          $('#idp').val(e.id);
          $('#area_id').val(e.area_id);
          $('#taggroup_id').val(e.taggroup_id);
          $('#title').val(e.title);
          $('#detail').html(e.detail);
          $('#instruct').val(e.instruct);
        },
        error:function(err){
          if(err.status === 404 || err.status === 500){
            alert('สิทธิ์การใช้งานไม่ถูกต้อง');
          }else{
            $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
          }
        }
    });
    //$('#detail').val(e.detail);

  });


    $('.updaterecord').click(function(){
      //alert(0);
        var id = $('#id').val();
        var context = $('#context').val();
        var people = $('#people').val();
        var health = $('#health').val();
        var environment = $('#environment').val();
        var keyman = $('#keyman').val();
        var tel = $('#tel').val();
            //alert(0);
            $.ajax({
              url : '{!! url('manager/areauser') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'context' : context,
                  'people' : people,
                  'health' : health,
                  'environment' : environment,
                  'keyman' : keyman,
                  'tel' : tel
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){alert('บันทึกข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                  //$( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                  displaydata();
                  $('.updaterecord').hide();
                  $('#showdetail').hide();
                  $("#form_data")[0].reset();
                },
                error:function(err){
                  if(err.status === 404 || err.status === 500){
                    alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                  }else{
                    $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
                  }
                }
            });
    }) ;

    $('.updaterecordprobm').click(function(){
      var idp = $('#idp').val();
      var area_id = $('#area_id').val();
      var taggroup_id = $('#taggroup_id').val();
      var title = $('#title').val();
      var detail = $('#detail').val();
      var instruct = $('#instruct').val();
      //$('#detail').val('');
      //$("#form_dataprobm")[0].reset();
          //alert(0);
          $.ajax({
            url : '{!! url('manager/problem') !!}'+'/'+idp,
              type : "post",
              //asyncfalse
              data : {
                '_method':'PUT',
                '_token': '{{ csrf_token() }}',
                'idp' : idp,
                'taggroup_id' : taggroup_id,
                'title' : title,
                'detail' : detail,
                'instruct' : instruct,
              },
              success : function(re)
              {
                //alert(re);
                if(re == 0){alert('บันทึกข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                //$( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                displayprobm(area_id);
                $('#taggroupdetail').html('');
                $('.updaterecordprobm').hide();
                $('#showdetailprobm').hide();
                $('.saverecordprobm').show();
                $("#form_dataprobm")[0].reset();
                $('#detail').html('');
                $( '#msgnameprobm' ).html('');
              },
              error:function(err){
                  if( err.status === 422 ) {
                    var errors = err.responseJSON; //this will get the errors response data.
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each( errors, function( key, value ) {
                      errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';
                    $( '#msgnameprobm' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                  }else if(err.status === 404 || err.status === 500){
                    alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                  }else{
                    $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
                  }
               }
          });
    }) ;

    $('.saverecordprobm').click(function(){
        var area_id = $('#area_id').val();
            $.ajax({
                url : '{!! url('manager/problem') !!}',
                async:false,
                type:'post',
                processData: false,
                contentType: false,
                data:new FormData($("#form_dataprobm")[0]),
                success:function(re)
                {
                  if(re == 0){
                    //alert('บันทึกข้อมูลสำเร็จ');
                    $("#form_dataprobm")[0].reset();
                    $('#detail').html('');
                    displaydata();
                    displayprobm(area_id);
                    $( '#msgnameprobm' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    $('#taggroupdetail').html('');
                    //$('#detail').html('');
                  }
                  //$("#form_dataprobm")[0].reset();
                  $('#area_id').val(area_id);
                },
                error:function(err){
                    if( err.status === 422 ) {
                      var errors = err.responseJSON; //this will get the errors response data.
                      errorsHtml = '<div class="alert alert-danger"><ul>';
                      $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                      });
                      errorsHtml += '</ul></di>';
                      $( '#msgnameprobm' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    }else if(err.status === 404 || err.status === 500){
                      alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                    }else{
                      $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
                    }
                 }

            });
            //$("#form_dataprobm")[0].reset();
            //alert('999');
    }) ;


    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('manager/areauser/create') !!}',
        type : "get",
        //asyncfalse
        data : {},
        success : function(s)
        {
          //alert(s);
          $('.displayrecord').html(s);
          //if(re == 0){alert('save');}else{alert('not save');}
          $("#example1").DataTable();
        }
      });
    }

    function displayprobm(id){
        //alert(id);
        $.ajax({
          //url : '{!! url('manager/research/create') !!}',
          url : '{!! url('manager/problem') !!}',
          type : "get",
          //asyncfalse
          data : {
            'id' : id,
          },
          success : function(s)
          {
            //alert(s);
            //$('.displayexpert').html('');
            $('.displayproblem').html(s);
            //$("#example1").DataTable();
            $('#area_id').val(id);
          },
          error:function(err){
            if(err.status === 404 || err.status === 500){
              alert('สิทธิ์การใช้งานไม่ถูกต้อง');
            }else{
              $( '#msgnameprobm' ).html( 'ERROR : '+err.status );
            }
          }
        });
  }

</script>

@endsection
