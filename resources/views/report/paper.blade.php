@extends('layouts.template')
@section('title','บทความวิชาการ')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">บทความวิชาการ</h3>
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

            <form enctype="multipart/form-data" id="form_data" name="form_data" role="form" method="POST">
                <div class="form-group">
                  <label>นักวิจัย</label>
                  <select name="researcher_id" id="researcher_id" class="form-control" style="width:350px">
                      <option value="">--- เลือกนักวิจัย ---</option>
                      @foreach ($objrsc as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                  </select>
                </div>
          <div class="form-group">
            <label>ข้อมูลบทความวิชาการ</label>
          </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ชื่อบทความ</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="ชื่อบทความ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> คำสำคัญ</label></span>
                  <input type="text" class="form-control" name="keyword" id="keyword" placeholder="คำสำคัญ">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> บทคัดย่อ</label></span>
                  <textarea class="form-control" id="abstract" name="abstract" placeholder="บทคัดย่อ"></textarea>
                </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> ไฟล์</label></span>
                  <input type="text"  id="fileold" name="fileold">
                  <input type="file" class="form-control" name="file" id="file">
                </div>
                </div>

                <input type="text"  id="id" name="id">
                <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
            </form>
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
      $('.btnback').hide();
      $('#showdetail').hide();
      $('.showdetailexp').hide();
      $('.btndetailexp').hide();

      $('.btndetail').click(function(){
          $('#showdetail').show();
          $('.btndetail').hide();
          $('#university_id').focus();
      });

      $('.btncancel').click(function(){
          $('.saverecord').show();
          $('.btndetail').show();
          $('#showdetail').hide();
          $('#msgname').html('');
      });

      displaydata();


      $('body').delegate('.edit','click',function(){
        //$('.saverecord').hide();
        $('#showdetail').show();
        $('.btndetail').hide();
        $('#msgname').html('');
        $('#title').focus();
        var id = $(this).data('id');
        $.ajax({
            url : '{!! url('user/paper') !!}'+'/'+id+'/edit',
            type : "get",
            //asyncfalse
            data : {
              '_token': '{{ csrf_token() }}'
            },
            success : function(e)
            {
              //alert(e.id);
              $('#id').val(e.id);
              $('#researcher_id').val(e.researcher_id);
              $('#title').val(e.title);
              $('#keyword').val(e.keyword);
              $('#abstract').val(e.abstract);
              $('#fileold').val(e.file);
            }
        });

      });

      $('body').delegate('.delete','click',function(){
        if(confirm("ท่านต้องการลบรายการนี้หรือไม่ ?")){
        var id = $(this).data('id');
        $('.saverecord').show();
        $('#showdetail').hide();
        $('.btndetail').show();
        $.ajax({
            url : '{!! url('user/paper') !!}'+'/'+id,
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
              $('#cpaper' ).html(d.objs);
            }
        });
      }
      });
  });


      $('.saverecord').click(function(){
        //alert('hell save');
              $.ajax({
                  url : '{!! url('user/paper') !!}',
                  async:false,
                  type:'post',
                  processData: false,
                  contentType: false,
                  data:new FormData($("#form_data")[0]),

                  success:function(re)
                  {
                    //alert(re);
                    if(re.check){
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }
                    $("#form_data")[0].reset();
                    $('#cpaper' ).html(re.objs);
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


    function displaydata(){
      //alert(0);
      $.ajax({
        url : '{!! url('user/paper/create') !!}',
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
</script>

@endsection
