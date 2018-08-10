@extends('layouts.template')
@section('title','งานวิจัย')
@section('subtitle','จัดการข้อมูล')
@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("assets/plugins/select2/select2.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/test/bootstrap-tagsinput.css") }}">
<link rel="stylesheet" href="{{ asset("assets/test/app.css") }}">

@endsection
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">งานวิจัย</h3>
            </div>
            <!-- /.box-header -->

            <div class="box">
              <div class="box-body">
                <div class="displayrecord">
                </div>
                <button type="button" class="btn btn-primary btndetail"><i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูล</button>
                <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
              </div>
            </div>


            <div id='showdetail'>
            <!-- form start -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <h3 class="box-title">@yield('subtitle')</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
            <div id = 'msgname'></div>

            <form role="form" id="form_data" name="form_data">
              <div class="form-group" id="j">
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

              <div class="form-group">
                <label>นักวิจัย</label>
                  <div class="displayresch">
                  @if(Auth::user()->role->slug == 'Admin')
                    <select name="researcher_id" id="researcher_id" class="form-control select2" style="width:350px">
                        <option value="">--- เลือกนักวิจัย ---</option>
                    </select>
                  @else
                    <select name="researcher_id" id="researcher_id" class="form-control select2" style="width:350px">
                        <option value="">--- เลือกนักวิจัย ---</option>
                        @foreach ($objresch as $key)
                            <option value="{{ $key->id }}">{{$key->headname}}{{$key->firstname}} {{$key->lastname}}</option>
                        @endforeach
                    </select>
                  @endif
                  </div>
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
                <div class="form-group">
                    <div id = 'taggroupdetail'></div>
                </div>
                <div class="form-group">
                  <label>สาขางานวิจัย</label>
                  <select name="isced_id" id="isced_id" class="form-control" style="width:350px">
                      <option value="">--- สาขางานวิจัย ---</option>
                      <option value="1000">การศึกษา</option>
                      <option value="2000">มนุษยศาสตร์และศิลปกรรมศาสตร์</option>
                      <option value="3000">สังคมศาสตร์ ธุรกิจ และกฎหมาย</option>
                      <option value="4000">วิทยาศาสตร์</option>
                      <option value="5000">วิศวกรรมศาสตร์ การผลิต และการก่อสร้าง</option>
                      <option value="6000">เกษตรศาสตร์</option>
                      <option value="7000">สุขภาพและสวัสดิการ</option>
                      <option value="8000">การบริการ</option>
                  </select>
                </div>

          <div class="form-group">
            <label>ข้อมูลงานวิจัย</label>
          </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> ชื่องานวิจัย(TH)</label></span>
                  <input type="text" class="form-control" name="title_th" id="title_th" placeholder="ชื่องานวิจัย (ภาษาไทย)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> ชื่องานวิจัย(EN)</label></span>
                  <input type="text" class="form-control" name="title_eng" id="title_eng" placeholder="ชื่องานวิจัย (ภาษาอังกฤษ)">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> วัตถุประสงค์</label></span>
                  <textarea class="form-control" id="propose" name="propose" placeholder="วัตถุประสงค์" style="height:150px"></textarea>
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> คำสำคัญ</label></span>
                  <input type="text" class="form-control"  name="keyword" id="keyword">
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> บทคัดย่อ</label></span>
                  <textarea class="form-control" id="abstract" name="abstract" placeholder="บทคัดย่อ" style="height:150px"></textarea>
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> ผู้ร่วมวิจัย</label></span>
                  <input type="text" class="contributor" id="contributor">
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> ผู้เชี่ยวชาญในพื้นที่</label></span>
                  <input type="text" class="expert" id="expert">
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:150px"> ปี พ.ศ.</label></span>
                  <input type="text" class="form-control" name="createyear" id="createyear" placeholder="ปี พ.ศ.(ที่ทำโครงการวิจัย)">
                </div>
                </div>
                <input type="hidden"  id="id">
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
            <form enctype="multipart/form-data" id="form_dataexp" name="form_dataexp" role="form" method="POST" action="" >
                <div class="form-group">
                <label>รายการไฟล์เอกสาร</label>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ชื่อไฟล์</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder=" ตั้งชื่อไฟล์">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ไฟล์</label></span>
                  <div id = 'file'></div>
                  <input type="file" class="form-control" name="filefield" id="filefield">
                </div>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  (ไฟล์ประเภท pdf, docs, exls, ppts, jpg, png ขนาดไม่เกิน 20 MB)
                </p>
                </div>

                <input type="hidden"  id="idexp" name="idexp">
                <input type="hidden"  id="research_id" name="research_id">
                <button type="button"  class="btn btn-primary saverecordexp">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-primary updaterecordexp">อัพเดทข้อมูล</button>
                <button type="button" class="btn btn-danger btncancelexp">ยกเลิก</button>
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
<!-- Select2 -->
<script src="{{ asset("assets/plugins/select2/select2.full.min.js") }}"></script>
<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<script type="text/javascript">
    $(function(){
      //Initialize Select2 Elements
      //$(".select2").select2();

      $('.updaterecord').hide();
      $('.btnback').hide();
      $('#showdetail').hide();
      $('.showdetailexp').hide();
      $('.btndetailexp').hide();

      //load center
      $('select[name="university_id"]').on('change', function() {
        var stateID = $(this).val();
        loadselect(stateID,'');
      });

      $('select[name="taggroup_id"]').on('change', function() {
        var id = $(this).val();
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
          $('#university_id').focus();
          $(".select2").select2();
          $('#msgname').html('');
          $('#msgnameexp').html('');
          $('#keyword').tagsinput('destroy');
          $('#keyword').tagsinput();
          $('.contributor').tagsinput('removeAll');
          $('.expert').tagsinput('removeAll');
          //var university_id = $('#university_id').val();
          //loadselect(university_id,'');

      });

      $('.btncancel').click(function(){
          $('#taggroupdetail').html('');
          $('.updaterecord').hide();
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
          $('select[name="researcher_id"]').empty();
          $('select[name="researcher_id"]').html('<option value="">--- เลือกนักวิจัย ---</option>');
          $(".select2").select2('');
          $('.contributor').tagsinput('removeAll');
          $('.expert').tagsinput('removeAll');
          $('#keyword').tagsinput();
          $('#keyword').tagsinput('destroy');
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
          //$('#msgnameexp').html('');
      });

      displaydata();

      $('body').delegate('.btndetailexp','click',function(){
        $('.showdetailexp').show();
        $('.updaterecordexp').hide();
        $('.btndetailexp').hide();
        $('#msgnameexp').html('');
      });

      $('body').delegate('.edit','click',function(){
        $('.updaterecord').show();
        $('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('.contributor').tagsinput('removeAll');
        $('.expert').tagsinput('removeAll');
        $('#keyword').tagsinput();
        $('#keyword').tagsinput('destroy');
        $('#name').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '{!! url('user/research') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.researcher_id);
              $('#id').val(e.id);
              $('#taggroup_id').val(e.taggroup_id);
              $('#isced_id').val(e.isced_id);
              //$('#researcher_id').val(e.researcher_id);
              $('#title_th').val(e.title_th);
              $('#title_eng').val(e.title_eng);
              $('#propose').val(e.propose);
              $('#keyword').val(e.keyword);
              $('#keyword').tagsinput();
              //$("input").tagsinput('test');
              $('#abstract').val(e.abstract);

              var tcon = e.contributor;
              //alert(tcon);
              if(tcon!=''){
              var con = new Array();
                con = tcon.split(",");
                for (a in con) {
                  var idr = con[a];
                  //alert($.isNumeric(idr));
                  if($.isNumeric(idr)){
                  $.ajax({
                      url : '{!! url('eis/researcher/name') !!}'+'/'+idr,
                      type : "get",
                      success : function(e)
                      {
                        //alert(e.id);
                        elt.tagsinput('add', { "value": e.id , "text": e.name});
                      }
                    });
                  }else{
                    elt.tagsinput('add', { "value": idr , "text": idr});
                  }
                }
              }

              var texp = e.expert;
              //alert(texp);
              if(texp!=''){
                var exp = new Array();
                exp = texp.split(",");
                for (a in exp) {
                  var ide = exp[a];
                  //alert(ide);
                  if($.isNumeric(ide)){
                  $.ajax({
                      url : '{!! url('eis/expert/name') !!}'+'/'+ide,
                      type : "get",
                      success : function(e)
                      {
                        eltexp.tagsinput('add', { "value": e.id , "text": e.name});
                      }
                    });
                  }else{
                    eltexp.tagsinput('add', { "value": ide , "text": ide});
                  }
                }
              }

              $('#createyear').val(e.createyear);
              $('select[name="researcher_id"]').empty();
              $('select[name="researcher_id"]').html('<option value="'+e.researcher_id+'">'+e.headname+e.firstname+' '+e.lastname+'</option>');

              $('#university_id').val(e.university_id);

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
        $('.contributor').tagsinput('removeAll');
        $('.expert').tagsinput('removeAll');
        $('#keyword').tagsinput('destroy');
        $('#keyword').tagsinput();
        $.ajax({
            url : '{!! url('user/research') !!}'+'/'+id,
            type : "POST",
            //asyncfalse
            data : {
              '_method':'DELETE',
              '_token': '{{ csrf_token() }}'
            },
            success : function(d)
            {
              //alert(d);
              $('#taggroupdetail').html('');
              $("#form_data")[0].reset();
              displaydata();
              $('#cresearch' ).html(d.objs);
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
        var research_id = $('#research_id').val();
        $('.updaterecordexp').hide();
        $('.saverecordexp').show();
        $('#showdetailexp').hide();
        //$('.btndetailexp').show();
        $.ajax({
            url : '{!! url('user/file') !!}'+'/'+id,
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
              displayexp(research_id);
              $('#research_id').val(research_id);
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
          var taggroup_id = $('#taggroup_id').val();
          var isced_id = $('#isced_id').val();
          var researcher_id = $('#researcher_id').val();
          var title_th = $('#title_th').val();
          var title_eng = $('#title_eng').val();
          var propose = $('#propose').val();
          var keyword = $('#keyword').val();
          var abstract = $('#abstract').val();
          var contributor = $('#contributor').val();
          var expert = $('#expert').val();
          var createyear = $('#createyear').val();
          //$('#new_group').val('error');
            //alert(researcher_id);
              $.ajax({
                  url : '{!! url('user/research') !!}',
                  type : "POST",
                  data : {
                    '_token': '{{ csrf_token() }}',
                    'taggroup_id' : taggroup_id,
                    'isced_id' : isced_id,
                    'researcher_id' : researcher_id,
                    'title_th' : title_th,
                    'title_eng' : title_eng,
                    'propose' : propose,
                    'keyword' : keyword,
                    'abstract' : abstract,
                    'contributor' : contributor,
                    'expert' : expert,
                    'createyear' : createyear,
                  },
                  success:function(re)
                  {
                    //alert(re);
                    if(re.check){
                      //alert('บันทึกข้อมูลสำเร็จ');
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      alert('เกิดข้อผิดพลาด');
                      //$( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
                    $('#taggroupdetail').html('');
                    $("#form_data")[0].reset();
                    $('#headname').focus();
                    $('#cresearch' ).html(re.objs);
                    $(".select2").select2();
                    $('.contributor').tagsinput('removeAll');
                    $('.expert').tagsinput('removeAll');
                    $('#keyword').tagsinput('destroy');
                    $('#keyword').tagsinput();
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

      $('.saverecordexp').click(function(){
          var research_id = $('#research_id').val();
              $.ajax({
                  url : '{!! url('user/file') !!}',
                  async:false,
                  type:'post',
                  processData: false,
                  contentType: false,
                  data:new FormData($("#form_dataexp")[0]),
                  success:function(re)
                  {
                    if(re == 0){
                      displaydata();
                      displayexp(research_id);
                      $( '#msgnameexp' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }
                    $("#form_dataexp")[0].reset();
                    $('#research_id').val(research_id);
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

    $('.updaterecord').click(function(){
      var id = $('#id').val();
      var taggroup_id = $('#taggroup_id').val();
      var isced_id = $('#isced_id').val();
      var researcher_id = $('#researcher_id').val();
      var title_th = $('#title_th').val();
      var title_eng = $('#title_eng').val();
      var propose = $('#propose').val();
      var keyword = $('#keyword').val();
      var abstract = $('#abstract').val();
      var contributor = $('#contributor').val();
      var expert = $('#expert').val();
      var createyear = $('#createyear').val();
            //alert(contributor);
            $.ajax({
              url : '{!! url('user/research') !!}'+'/'+id,
                type : "post",
                //async : false,
                data : {
                  '_method':'PUT',
                  '_token': '{{ csrf_token() }}',
                  'taggroup_id' : taggroup_id,
                  'isced_id' : isced_id,
                  'researcher_id' : researcher_id,
                  'title_th' : title_th,
                  'title_eng' : title_eng,
                  'propose' : propose,
                  'keyword' : keyword,
                  'abstract' : abstract,
                  'contributor' : contributor,
                  'expert' : expert,
                  'createyear' : createyear,
                },
                success : function(re)
                {
                  //alert(re);
                  if(re == 0){alert('แก้ไขข้อมูลสำเร็จ');}else{alert('เกิดข้อผิดพลาด');}
                  //$( '#msgname' ).html('<div class="alert alert-success">แก้ไขข้อมูลสำเร็จ</div>');
                  displaydata();
                  $('#taggroupdetail').html('');
                  $('.updaterecord').hide();
                  $('.saverecord').show();
                  $('#showdetail').hide();
                  $('.btndetail').show();
                  $("#form_data")[0].reset();
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

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('user/research/create') !!}',
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
        //alert(id);
        $.ajax({
          //url : '{!! url('user/research/create') !!}',
          url : '{!! url('user/file') !!}',
          type : "get",
          //asyncfalse
          data : {
            'id' : id,
          },
          success : function(s)
          {
            //alert(s);
            $('#research_id').val(id);
            //$('.displayexpert').html('');
            $('.displayexpert').html(s);
            //$("#example1").DataTable();
            //$(".select2").select2();
            $(".select2").select2();
          }
        });
  }

  function loadselect(id,idresch){
        $.ajax({
            url : '{!! url('ajaxresch') !!}'+'/'+id,
            type: "GET",
            success:function(s) {
              $('.displayresch').html(s);
              $('select[name="researcher_id"]').val(idresch);
              $(".select2").select2();
            }
        });
  }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{{ asset("assets/test/bootstrap-tagsinput.min.js") }}"></script>
<script type="text/javascript">
            var researcher = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              prefetch: {
                  url: "../datajson.json",
                  cache:false
              }
            });
            researcher.initialize();
            var elt = $('.contributor');
            elt.tagsinput({
              itemValue: 'value',
              itemText: 'text',
              typeaheadjs: {
                name: 'text',
                displayKey: 'text',
                source: researcher.ttAdapter()
              }
            });
                //elt.tagsinput('add', { "value": 1 , "text": "ภานุวัฒน์ ขันจา"   , "continent": "Europe"    });
                //elt.tagsinput('add', { "value": 4 , "text": "Washington000"  , "continent": "America"   });
                //elt.tagsinput('add', { "value": 7 , "text": "Sydney"      , "continent": "Australia" });
                //elt.tagsinput('add', { "value": 10, "text": "Beijing"     , "continent": "Asia"      });
                //elt.tagsinput('add', { "value": 13, "text": "Cairo"       , "continent": "Africa"    });
                var expert = new Bloodhound({
                  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
                  queryTokenizer: Bloodhound.tokenizers.whitespace,
                  prefetch: {
                      url: "../datajsonexp.json",
                      cache:false
                  }
                });
                expert.initialize();
                var eltexp = $('.expert');
                eltexp.tagsinput({
                  itemValue: 'value',
                  itemText: 'text',
                  typeaheadjs: {
                    name: 'text',
                    displayKey: 'text',
                    source: expert.ttAdapter()
                  }
                });
</script>
@endsection
