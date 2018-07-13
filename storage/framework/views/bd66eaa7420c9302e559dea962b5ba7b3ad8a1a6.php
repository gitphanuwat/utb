<?php $__env->startSection('title','ข่าวสาร&กิจกรรม'); ?>
<?php $__env->startSection('subtitle','จัดการข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>

<?php echo HTML::style('/packages/dropzone/dropzone.css'); ?>


<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $__env->yieldContent('subtitle'); ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
            <div id = 'msgname'></div>

          <div class="form-group">
            <label>ข้อมูลข่าวสารหรือกิจกรรม</label>
          </div>

          <form action="<?php echo e(url('user/infor/'.$data->id)); ?>" id="form_data" name="form_data" role="form" method="POST">
            <?php echo e(method_field('PUT')); ?>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> หัวเรื่อง</label></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="หัวเรื่อง" value="<?php echo e($data->title); ?>">
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><label style="width:100px"> รายละเอียด</label></span>
                  <textarea class="textarea" id="detail" name="detail" placeholder="รายละเอียด" style="width: 100%; height: 225px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $data->detail; ?></textarea>
                </div>
                </div>

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" > <label style="width:100px"> ผู้ส่งข้อมูล</label></span>
                  <input type="text" class="form-control" name="keyman" id="keyman" value="<?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>" disabled="true">
                </div>
                </div>

                <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>">
                <input type="hidden"  id="id" value="<?php echo e($data->id); ?>">
                <input type="hidden" class="form-control" name="file_id" id="file_id" value="<?php echo e($data->file_id); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />

          </form>
          <div class="panel panel-info">
            <div class="panel-heading">
              ไฟล์เอกสารหรือภาพประกอบ
            </div>
            <div class="panel-body">
              <form enctype="multipart/form-data" class="dropzone" action="<?php echo e(url('user/upload')); ?>" method="post" id="real-dropzone">
              <div class="dz-message">
              </div>
              <div class="fallback">
                  <input name="file" type="file" multiple />
              </div>
              <div class="dropzone-previews" id="dropzonePreview"></div>
              <h4 style="text-align: center;color:#428bca;"> Drop images or files in this area  <span class="glyphicon glyphicon-hand-down"></span></h4>
              <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>">
              <input type="hidden"  id="id" value="<?php echo e($data->id); ?>">
              <input type="hidden" class="form-control" name="file_id" id="file_id" value="<?php echo e($data->file_id); ?>">
              <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
              </form>
          </div>
        </div>

        <button type="button"  class="btn btn-primary saverecord">บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-danger btncancel">ยกเลิก</button>

      </div>
      </div>

      <div id="preview-template" style="display: none;">

          <div class="dz-preview dz-file-preview">
              <div class="dz-image"><img data-dz-thumbnail=""></div>
              <input type="hidden" class="serverfilename"/>

              <div class="dz-details">
                  <div class="dz-size"><span data-dz-size=""></span></div>
                  <div class="dz-filename"><span data-dz-name=""></span></div>
              </div>
              <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
              <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

              <div class="dz-success-mark">
                  <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                      <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                      <title>Check</title>
                      <desc>Created with Sketch.</desc>
                      <defs></defs>
                      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                          <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                      </g>
                  </svg>
              </div>

              <div class="dz-error-mark">
                  <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                      <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                      <title>error</title>
                      <desc>Created with Sketch.</desc>
                      <defs></defs>
                      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                          <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                              <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                          </g>
                      </g>
                  </svg>
              </div>

          </div>
      </div>
      <?php echo Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']); ?>

          </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo HTML::script('/packages/dropzone/dropzone.js'); ?>

<?php echo HTML::script('/assets/js/dropzone-config2.js'); ?>


<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>

<script type="text/javascript">
    $(function(){
      $('#detail').wysihtml5();
      //$('#detail').val('kkkkkkkk');

      $('.btncancel').click(function(){
            window.location.replace("<?php echo e(url('user/infor')); ?>");
      });
      $('.saverecord').click(function(){
        $("#form_data")[0].submit();
      });

      $('body').delegate('.saverecord1','click',function(){
          var user_id = $('#user_id').val();
          var title = $('#title').val();
          var detail = $('#detail').val();
          var file_id = $('#file_id').val();
              $.ajax({
                  url : '<?php echo url('user/infor'); ?>',
                  type : "POST",
                  data : {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'user_id' : user_id,
                    'title' : title,
                    'detail' : detail,
                    'file_id' : file_id,
                  },
                  success:function(re)
                  {
                    alert(re.objs);
                    if(re.check){
                      //alert('บันทึกข้อมูลสำเร็จ');
                      displaydata();
                      $( '#msgname' ).html('<div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>');
                    }else{
                      alert('เกิดข้อผิดพลาด');
                      //$( '#msgname' ).html('<div class="alert alert-danger">เกิดข้อผิดพลาด</div>');
                    }
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
});

  Dropzone.options.myDropzone = {
      init: function() {
          thisDropzone = this;
          <!-- 4 -->
          $.get('upload.php', function(data) {
              <!-- 5 -->
              $.each(data, function(key,value){
                  var mockFile = { name: value.name, size: value.size };
                  thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                  thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "uploads/"+value.name);
              });
          });
      }
  };

</script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")); ?>"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>