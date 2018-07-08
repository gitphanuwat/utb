@extends('layouts.template')
@section('title','บทความวิชาการ')
@section('subtitle','จัดการข้อมูล')
@section('body')

<div class="row">
         <div class="col-lg-12">
             <h1 class="page-header">@yield('page_heading')</h1>
         </div>
         <!-- /.col-lg-12 -->
 </div>
   @include('errors.list')
 <div class="row">
   <div class="col-lg-12">
     <div id = 'msgname'>This message.</div>
  <form class="form-horizontal" role="form" method="POST">
    @include('Article._form',['submitButtonText' => 'Add Article'])
  </form>
  </div>
</div>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$('#btn-add').click(function(){
  //alert("test");
      var formData = {
          _token: $('#_token').val(),
          title: $('#title').val(),
          body: $('#body').val(),
          published_at: $('#published_at').val()
      }
      $.ajax({
         type:'POST',
         url:'<?= url('user/article') ?>',
         //datatype:'json',
         data:formData,
         success:function(data){
            //alert('Insert OK');
            $("#msgname").html("Insert OK");
         },
         error:function(err){
           //alert(err.value.0);
            if( err.status === 422 ) {
              var errors = err.responseJSON; //this will get the errors response data.
              errorsHtml = '<div class="alert alert-danger"><ul>';
              $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
              });
              errorsHtml += '</ul></di>';
              $( '#msgname' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
            }
          }
      });
      //alert("test");
  });
</script>


@stop
