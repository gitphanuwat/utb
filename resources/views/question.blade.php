@extends('layouts.template')
@section('title','ข้อมูลปัญหาในพื้นที่ชุมชน')
@section('subtitle','ส่งหัวข้อปัญหา')
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">หัวข้อปัญหาในชุมชน</h3>
            </div>
            <!-- /.box-header -->
            <div id='showdetail'>
            <!-- form start -->

            <div id = 'msgname'></div>

            <form role="form" id="form_data" name="form_data">
              <div class="box-body">

                <div class="form-group">
                  <label>หัวข้อ</label>
                  <input type="text" class="form-control" name="topic" id="topic"  placeholder="หัวข้อปัญหา" value="{{ session()->get('sess_search') }}">
                </div>
                <div class="form-group">
                  <label>รายละเอียด</label>
                  <textarea class="textarea" id="detail" name="detail" value="รายละเอียด" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="form-group">
                  <label>ที่อยู่ชุมชน</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="ที่อยู่">
                </div>
                <div class="form-group">
                  <label>เบอร์โทรติดต่อ</label>
                  <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรติดต่อ">
                </div>
                <div class="form-group">
                  <label>อีเมล์</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์ติดต่อ">
                </div>
                <div class="form-group">
                  <label>ชื่อผู้ส่ง</label>
                  <input type="text" class="form-control" name="sender" id="sender" placeholder="ชื่อผู้ส่งข้อมูล">
                </div>
                <div class="form-group">
                  <label>นักวิจัยและผู้เชี่ยวชาญที่แนะนำ</label>
                  <div class="showresearcher"></div>
                </div>

                <input type="hidden"  id="id">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <button type="button"  class="btn btn-primary saverecord">ส่งข้อมูล</button>
                <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>
              </div>
              <div id="loading" align="center">
                  <img src="{{url('images/ajax-loader.gif')}}" align="absmiddle" />
              </div>
            </form>
          </div>
          </div>
</div>
</div>
@endsection
@section('script')

<script type="text/javascript">
    $(function(){
      $("#loading").hide();
      $('.btncancel').click(function(){
          window.history.back();
      });
      displaydata();
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
                    savedata();
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
                  url : '{!! url('question/sendquest') !!}',
                  type : "post",
                  data : $('form#form_data').serialize(),
                  success:function(re)
                  {
                    if(re == 0){
                      displaydata();
                      alert('ส่งข้อความสำเร็จ');
                      window.history.back();
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
        url : '{!! url('question/showresearcher') !!}',
        type : "get",
        data : {},
        success : function(s)
        {
          //alert(s);
          $('.showresearcher').html(s);
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
