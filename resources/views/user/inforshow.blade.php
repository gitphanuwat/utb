@extends('layouts.template')
@section('title','ข่าวสาร&กิจกรรม')
@section('subtitle','แสดงข้อมูล')
@section('styles')

@endsection
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลข่าวสาร&กิจกรรม</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>{{$data->title}}</h3>
                <h5>From: {{$data->user->firstname}}
                  <span class="mailbox-read-time pull-right"><i class="fa fa-clock-o"></i>{{$data->updated_at}}</span></h5>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>{{$data->title}},</p>
                <p>{!! $data->detail !!}</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <ul class="mailbox-attachments clearfix">
                <?php
                $full_size_dir = Config::get('images.full_size');

                foreach ($files as $file) {
                  $fullfile = $full_size_dir.$file->filename;
                  $size = filesize($fullfile);
                  if(@is_array(getimagesize($fullfile))){
                    echo "
                    <li>
                        <span class='mailbox-attachment-icon' ><img src='".url('/files').'/'.$file->filename."' alt='Attachment' height='100'></span>
                        <div class='mailbox-attachment-info'>
                          <a href='".url('/files').'/'.$file->filename."' class='mailbox-attachment-name'><i class='fa fa-camera'></i>".substr($file->original_name,0,20)."</a>
                          <span class='mailbox-attachment-size'>
                            ".round(($size/1000), 2)." kB
                            <a href='".url('/files').'/'.$file->filename."' class='btn btn-default btn-xs pull-right'><i class='fa fa-cloud-download'></i></a>
                          </span>
                        </div>
                    </li>";

                  } else {
                    echo "
                    <li>
                        <span class='mailbox-attachment-icon'><i class='fa fa-file-text-o' style='font-size:96px'></i></span>
                        <div class='mailbox-attachment-info'>
                          <a href='".url('/files').'/'.$file->filename."' class='mailbox-attachment-name'><i class='fa fa-paperclip'></i> ".substr($file->original_name,0,20)."</a>
                            <span class='mailbox-attachment-size'>
                            ".round(($size/1000), 2)." kB
                              <a href='".url('/files').'/'.$file->filename."' class='btn btn-default btn-xs pull-right'><i class='fa fa-cloud-download'></i></a>
                            </span>
                        </div>
                    </li>";
                  }
                }

                ?>


              </ul>
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-left">
                <button type="button" class="btn btn-default btncancel"><i class="fa fa-reply"></i> ย้อนกลับ</button>
              </div>
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
              </div>
            </div>
            <!-- /.box-footer -->
          </div>
</div>
</div>
@endsection
@section('script')
{!! HTML::script('/packages/dropzone/dropzone.js') !!}
{!! HTML::script('/assets/js/dropzone-config2.js') !!}

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<script type="text/javascript">
    $(function(){
      //$('.detail').wysihtml5();
      //$('#detail').val('kkkkkkkk');

      $('.btncancel').click(function(){
            window.location.replace("{{url('user/infor')}}");
      });


});



</script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("assets/dist/js/pages/dashboard.js") }}"></script>


@endsection
