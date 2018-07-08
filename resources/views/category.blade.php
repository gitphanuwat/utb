@extends('layouts.templatehome')
@section('title','ศูนย์จัดการเครือข่าย')
@section('subtitle','จัดการข้อมูล')
@section('body')
<!-- Main content -->
<section class="content">

  <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >
  <div class="form-group">
    <label for="catagry_name">Name</label>
     <input type="hidden" name="_token" value="{{ csrf_token()}}">
    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
    <p class="invalid">Enter Catagory Name.</p>
  </div>
  <div class="form-group">
    <label for="catagry_name">Logo</label>
    <input type="file"  class="form-control" name="logo" id="logo">
    <p class="invalid">Enter Catagory Logo.</p>
</div>

</form>
<div class="modelFootr">
  <button type="button" class="addbtn">Add</button>
  <button type="button" class="cnclbtn">Reset</button>
</div>



</section>
<!-- /.content -->
@endsection
@section('script')
<script type="text/javascript">

/*Add new catagory Event*/
$(".addbtn").click(function(){
  //alert('test');
$.ajax({
      //url:'add-catagory',
      url : '{!! url('add-catagory') !!}',
      //dataType:'json',
      async:false,
      type:'post',
      processData: false,
      contentType: false,
      data:new FormData($("#upload_form")[0]),

      success:function(response){
        alert(response);
      },
      error:function(err){
        alert(err.status);
      }
    });
 });
/*Add new catagory Event*/

</script>

@endsection
