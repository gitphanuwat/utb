@extends('layouts.template')
@section('title','ผู้เชี่ยวชาญท้องถิ่น')
@section('subtitle','จัดการข้อมูล')
<?php
if(Auth::user()){include ('makejsonexp.php');}
?>
@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("assets/plugins/select2/select2.min.css") }}">
@endsection
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ผู้เชี่ยวชาญท้องถิ่น</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail"><i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูล</button>
                <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
              </div>
              <!-- /.box-body -->

            </div>


            <div id='showdetail'>
            <!-- form start -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <h3 class="box-title">@yield('subtitle')</h3>
            </div>

            <div class="box-body">
            <div id = 'msgname'></div>

            <form role="form" id="form_data" name="form_data">
              <div class="form-group">
                <label>มหาวิทยาลัย</label>
                @if(Auth::user()->role->slug == 'Admin')
                <select name="university_id" id="university_id" class="form-control" style="width:350px">
                    <option value="">--- เลือกมหาวิทยาลัย ---</option>
                    @foreach ($objuniver as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @else
                <h5>{{ Auth::user()->university->name }}</h5>
                <input type="hidden" name="university_id" id="university_id" value="{{ Auth::user()->university_id }}">
                @endif
              </div>
              <div class="form-group" id="j">
                <label>พื้นที่ชุมชน</label>
                @if(Auth::user()->role->slug == 'Admin')
                <select name="area_id" id="area_id" class="form-control select2" style="width:350px">
                    <option value="">--- เลือกพื้นที่ชุมชน ---</option>
                </select>
                @elseif (Auth::user()->role->slug == 'Operator')
                <h5>{{ Auth::user()->area->name }}</h5>
                <input type="hidden" name="area_id" id="area_id" value="0">
                @else
                <select name="area_id" id="area_id" class="form-control select2" style="width:350px">
                    <option value="">--- เลือกพื้นที่ชุมชน ---</option>
                    @foreach ($objarea as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @endif
              </div>

          <div class="form-group">
            <label>ข้อมูลผู้เชี่ยวชาญ</label>
          </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> คำนำหน้าชื่อ</label></span>
                  <input type="text" class="form-control" name="headname" id="headname" placeholder="คำนำหน้าชื่อ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ชื่อ</label></span>
                  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> สกุล</label></span>
                  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="สกุล">
                </div>
                </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon" > <label style="width:100px"> ที่อยู่</label></span>
            <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่">
          </div>
          </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><label style="width:100px"> เบอร์โทร</label></span>
            <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทร">
          </div>
          </div>
          <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><label style="width:100px">อีเมล์</label></span>
            <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์">
          </div>
          </div>
          <input type="hidden"  id="id">
          <input type="hidden"  id="center_id">
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecord">อัพเดทข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
            </form>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="box-body">

          <div class="displayexpert"></div>
          <button type='button' class='btn btn-primary btndetailexp'><i class='fa fa-fw fa-plus'></i> เพิ่มข้อมูล</button>

          <div class="showdetailexp">
            <div class="box-body">
            <div id = 'msgnameexp'></div>
            <form role="form" id="form_dataexp" name="form_dataexp">
              <div class="form-group">
                <label>กลุ่มความเชี่ยวชาญ</label>
                <select name="taggroup_id" id="taggroup_id" class="form-control" style="width:350px">
                    <option value="">--- เลือกกลุ่มความเชี่ยวชาญ ---</option>
                    @foreach ($objtag as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                  <div id = 'taggroupdetail'></div>
              </div>
              <div class="form-group">
                <label>สาขาความเชี่ยวชาญ</label>
                <select name="isced_id" id="isced_id" class="form-control" style="width:350px">
                    <option value="">--- สาขาความเชี่ยวชาญ ---</option>
                    <option value="1000">การศึกษา</option>
                    <option value="2000">มนุษยศาสตร์และศิลปกรรมศาสตร์</option>
                    <option value="3000">สังคมศาสตร์ ธุรกิจ และกฎหมาย</option>
                    <option value="4000">วิทยาศาสตร์</option>
                    <option value="5000">วิศวกรรมศาสตร์ การผลิต และการก่อสร้าง</option>
                    <option value="6000">เกษตรศาสตร์</option>
                    <option value="7000">สุขภาพและสวัสดิการ</option>
                    <option value="8000">การบริการ</option>
                    <option value="9000">สาขาอื่นๆ</option>
                </select>
              </div>
            <div class="form-group">
            <label>ข้อมูลความเชี่ยวชาญ</label>
            </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> ความเชี่ยวชาญ(TH)</label></span>
                  <input type="text" class="form-control" name="title_th" id="title_th" placeholder="ความเชี่ยวชาญ (ภาษาไทย)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> ความเชี่ยวชาญ(EN)</label></span>
                  <input type="text" class="form-control" name="title_eng" id="title_eng" placeholder="ความเชี่ยวชาญ (ภาษาอังกฤษ)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:120px"> รายละเอียด</label></span>
                  <textarea class="form-control" id="detail" name="detail" placeholder="รายละเอียด"></textarea>
                </div>
                </div>

                <input type="hidden"  id="idexp">
                <input type="hidden"  id="expert_id">
                <button type="button"  class="btn btn-primary saverecordexp">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecordexp">อัพเดทข้อมูล</button>
                <button type="button" class="btn btn-danger btncancelexp">ยกเลิก</button>
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
<!-- Select2 -->
<script src="{{ asset("assets/plugins/select2/select2.full.min.js") }}"></script>

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<script type="text/javascript">
    $(function(){
      //Initialize Select2 Elements
      $(".select2").select2();

      $('.updaterecord').hide();
      $('.btnback').hide();
      $('#showdetail').hide();
      $('.showdetailexp').hide();
      $('.btndetailexp').hide();

      //load area
      $('select[name="university_id"]').on('change', function() {
        var id = $(this).val();
        loadselect(id,'');
      });

      $('select[name="area_id"]').on('change', function() {
        var id = $(this).val();
        callcenter(id);
        //alert(id);
      });

      $('select[name="taggroup_id"]').on('change', function() {
        var id = $(this).val();
        //alert(id);
        $.ajax({
            url : '{!! url('user/tagdetail') !!}',
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

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#area_id').focus();
          $('#msgname').html('');
          $(".select2").select2();
      });

      $('.btncancel').click(function(){
          $('.updaterecord').hide();
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
          $(".select2").select2();
      });
      $('.btncancelexp').click(function(){
          $('.updaterecordexp').hide();
          $('.saverecordexp').show();
          $('.btndetailexp').show();
          $('.showdetailexp').hide();
          $('#msgnameexp').html('');
          //$("#form_dataexp")[0].reset();
          $('#taggroup_id').val('');
          $('#isced_id').val('');
          $('#title_th').val('');
          $('#title_eng').val('');
          $('#detail').val('');
      });
      $('.btnback').click(function(){
          $('.displayexpert').hide();
          $('.displayrecord').show();
          $('.btndetail').show();
          $('.btnback').hide();
          $('.showdetailexp').hide();
          $('.btndetailexp').hide();
      });

      displaydata();

      $('body').delegate('.btndetailexp','click',function(){
        $('.showdetailexp').show();
        $('.updaterecordexp').hide();
        $('.btndetailexp').hide();
        $('#taggroupdetail').html('');
      });

      $('body').delegate('.edit','click',function(){
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#name').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '{!! url('user/expert') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              $('#id').val(e.id);
              $('#center_id').val(e.center_id);
              $('#university_id').val(e.university_id);
              $('#headname').val(e.headname);
              $('#firstname').val(e.firstname);
              $('#lastname').val(e.lastname);
              $('#address').val(e.address);
              $('#tel').val(e.tel);
              $('#email').val(e.email);

              loadselect(e.university_id,e.area_id);
              //$('#area_id').val(e.area_id);

            }
        });

      });

      $('body').delegate('.editexp','click',function(){
        $('.updaterecordexp').show();
        $('.saverecordexp').hide();
        $('.showdetailexp').show();
        $('.btndetailexp').hide();
        $('#msgnameexp').html('');
        $('#title_th').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '{!! url('user/expertlist') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              $('#idexp').val(e.id);
              $('#expert_id').val(e.expert_id);
              $('#taggroup_id').val(e.taggroup_id);
              $('#isced_id').val(e.isced_id);
              $('#title_th').val(e.title_th);
              $('#title_eng').val(e.title_eng);
              $('#detail').val(e.detail);
            }
        });

      });

      $('body').delegate('.upexpert','click',function(){
        $('#showdetail').hide();
        $('.displayrecord').hide();
        $('.btndetail').hide();
        //$('.btnback').show();
        $('.btndetailexp').show();
        $('.displayexpert').show();
        $('.btnback').show();

        var id = $(this).data('id');
        displayexp(id);

      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.updaterecord').hide();
        $('.saverecord').show();
        $('#showdetail').hide();
        $('.btndetail').show();
        $.ajax({
            url : '{!! url('user/expert') !!}'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(d);
              $("#form_data")[0].reset();
              displaydata();
              $('#cexpert' ).html(d.objs);
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

      $('body').delegate('.deleteexp','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        var expert_id = $('#expert_id').val();
        $('.updaterecordexp').hide();
        $('.saverecordexp').show();
        $('#showdetailexp').hide();
        //$('.btndetailexp').hide();
        $.ajax({
            url : '{!! url('user/expertlist') !!}'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(d);

              $("#form_dataexp")[0].reset();
              displaydata();
              displayexp(expert_id);
              $('#expert_id').val(expert_id);
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
  });

      $('.saverecord').click(function(){
        var area_id = $('#area_id').val();
        var center_id = $('#center_id').val();
          var university_id = $('#university_id').val();
          var headname = $('#headname').val();
          var firstname = $('#firstname').val();
          var lastname = $('#lastname').val();
          var address = $('#address').val();
          var tel = $('#tel').val();
          var email = $('#email').val();
          //$('#new_group').val('error');
              //alert(university_id);
              $.ajax({
                  url : '{!! url('user/expert') !!}',
                  type : "POST",
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'area_id' : area_id,
                    'center_id' : center_id,
                    'university_id' : university_id,
                    'headname' : headname,
                    'firstname' : firstname,
                    'lastname' : lastname,
                    'address' : address,
                    'tel' : tel,
                    'email' : email,
                  },
                  success:function(re)
                  {
                    //alert(re.objs);
                    if(re.check){
                      //alert('บันทึกข้อมูลสำเร็จ');
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      alert('เกิดข้อผิดพลาด');
                      //$( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $("#form_data")[0].reset();

                    $(".select2").select2();

                    $('#headname').focus();
                    $('#cexpert' ).html(re.objs);
                  },
                  error:function(err){
                      //alert(err);
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
      }) ;

      $('.saverecordexp').click(function(){
          //var expert_id = $('#expert_id').val();
          var expert_id = $('#expert_id').val();
          var taggroup_id = $('#taggroup_id').val();
          var isced_id = $('#isced_id').val();
          var title_th = $('#title_th').val();
          var title_eng = $('#title_eng').val();
          var detail = $('#detail').val();
          //$('#new_group').val('error');
              //alert(0);
              $.ajax({
                  url : '{!! url('user/expertlist') !!}',
                  type : "POST",
                  ////asyncfalse
                  //dataType : 'json',
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'expert_id' : expert_id,
                    //'researcher_id' : 0,
                    'taggroup_id' : taggroup_id,
                    'isced_id' : isced_id,
                    'title_th' : title_th,
                    'title_eng' : title_eng,
                    'detail' : detail,
                  },
                  success:function(re)
                  {
                    //alert(re);
                    if(re == 0){
                      //alert('บันทึกข้อมูลสำเร็จ');
                      displaydata();
                      displayexp(expert_id);
                      $( '#msgnameexp' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }

                    $("#form_dataexp")[0].reset();
                    $('#taggroup_id').focus();
                    $('#expert_id').val(expert_id);
                  },
                  error:function(err){
                      //alert(err);
                      if( err.status === 422 ) {
                        var errors = err.responseJSON; //this will get the errors response data.
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each( errors, function( key, value ) {
                          errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';
                        $( '#msgnameexp' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                      }else{
                        $( '#msgnameexp' ).html( 'ERROR : '+err.status );
                      }
                   }
              });
      }) ;

    $('.updaterecord').click(function(){
      //alert(0);
      var id = $('#id').val();
      var university_id = $('#university_id').val();
      var center_id = $('#center_id').val();
      var area_id = $('#area_id').val();
      var headname = $('#headname').val();
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var address = $('#address').val();
      var tel = $('#tel').val();
      var email = $('#email').val();
            //alert(0);
            $.ajax({
              url : '{!! url('user/expert') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'university_id' : university_id,
                  'center_id' : center_id,
                  'area_id' : area_id,
                  'headname' : headname,
                  'firstname' : firstname,
                  'lastname' : lastname,
                  'address' : address,
                  'tel' : tel,
                  'email' : email,
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){alert('แก้ไขข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                  //$( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                  displaydata();
                  $('.updaterecord').hide();
                  $('.saverecord').show();
                  $('#showdetail').hide();
                  $('.btndetail').show();
                  $("#form_data")[0].reset();

                  $(".select2").select2();

                },
                error:function(err){
                    //alert(err);
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
    }) ;
    $('.updaterecordexp').click(function(){
      //alert(0);
      var id = $('#idexp').val();
      var expert_id = $('#expert_id').val();
      var taggroup_id = $('#taggroup_id').val();
      var isced_id = $('#isced_id').val();
      var title_th = $('#title_th').val();
      var title_eng = $('#title_eng').val();
      var detail = $('#detail').val();
            //alert(id);
            $.ajax({
              url : '{!! url('user/expertlist') !!}'+'/'+id,
                type : "post",
                //asyncfalse
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'expert_id' : expert_id,
                  'researcher_id' : 0,
                  'taggroup_id' : taggroup_id,
                  'isced_id' : isced_id,
                  'title_th' : title_th,
                  'title_eng' : title_eng,
                  'detail' : detail,
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){alert('แก้ไขข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                  //$( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                  displayexp(expert_id);
                  $('.updaterecordexp').hide();
                  $('.saverecordexp').show();
                  $('#showdetailexp').hide();
                  $('.btndetailexp').hide();
                  $("#form_dataexp")[0].reset();
                },
                error:function(err){
                    //alert(err);
                    if( err.status === 422 ) {
                      var errors = err.responseJSON; //this will get the errors response data.
                      errorsHtml = '<div class="alert alert-danger"><ul>';
                      $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                      });
                      errorsHtml += '</ul></di>';
                      $( '#msgnameexp' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    }else if(err.status === 404 || err.status === 500){
                      alert('สิทธิ์การใช้งานไม่ถูกต้อง');
                    }else{
                      $( '#msgnameexp' ).html( 'ERROR : '+err.status );
                    }
                 }
            });
    }) ;

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('user/expert/create') !!}',
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


    function displayexp(id){
        //alert('aa');
        $.ajax({
          //url : '{!! url('user/expert/create') !!}',
          url : '{!! url('user/expertlist') !!}'+'/'+id,
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            //alert(s);
            $('#expert_id').val(id);
            //$('.displayexpert').html('');
            $('.displayexpert').html(s);
            //$("#example1").DataTable();
            $('#taggroupdetail').html('');
          }
        });
  }


  function callcenter(idarea){
    $.ajax({
        //url: '/research/ajax/'+stateID,
        url : '{!! url('ajaxcallcenter') !!}'+'/'+idarea,
        type: "GET",
        //asyncfalse
        //url : '{!! url('user/tagdetail') !!}',
        //type : "get",
        ////asyncfalse
        success:function(data) {
          //$('#area_id').val(idarea);
          //alert(data);
          $('#center_id').val(data);
          //$('select[name="center_id"]').html('<option value="">--test--</option>');
      }
    });
  }

  function loadselect(id,idarea){
    //alert(id);
        $.ajax({
            url : '{!! url('ajaxarea_uni') !!}'+'/'+id,
            type: "GET",
            dataType: "json",
            success:function(data) {

                $('select[name="area_id"]').empty();
                $('select[name="area_id"]').html('<option value="">-- เลือกพื้นที่ชุมชน --</option>');
                $.each(data, function(key, value) {
                    $('select[name="area_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
                $('select[name="area_id"]').on('change', function() {
                  var id = $(this).val();
                  callcenter(id);
                });
                $('#area_id').val(idarea);
            }
        });
  }
</script>

@endsection
