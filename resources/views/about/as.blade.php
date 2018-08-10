@extends('layouts.template')
@section('title','เกี่ยวกับระบบ')
@section('subtitle','ผู้รับผิดชอบระบบและการติดต่อสื่อสาร.')
@section('styles')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">
@endsection
@section('body')
<?php
  Use App\University;
  $objuni = University::get();
?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
          <div class="box-header with-border">
            <div class="user-block">
              <img src="{{url('images/lrd_logo.png')}}" alt="User Image">
              <span class="username"><a href="#">Lrd System.</a></span>
              <span class="description">Local Research Development System</span>
            </div>
            <!-- /.user-block -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <p>การจัดการความรู้และเสริมพลังเครือข่ายมหาวิทยาลัยราชภัฏเพื่อการพัฒนาชุมชนท้องถิ่น</p>
            <p>โดยความร่วมมือระหว่างเครือข่ายมหาวิทยาลัยราชภัฏกับชุมชนท้องถิ่น
              เพื่อการพัฒนาระบบฐานข้อมูลและกลไกการสนับสนุนการวิจัยเชิงพื้นที่ให้เกิดรูปธรรมการทำงานร่วมกัน
              ของนักวิชาการในเครือข่ายมหาวิทยาลัยราชภัฏ และเครือข่ายองค์กรปกครองส่วนท้องถิ่น โดยมี
            <b>เครือข่ายมหาวิทยาลัยราชภัฏ ทั้งหมด {{count($objuni)}} แห่ง</b></p>
          </div>
          <!-- /.box-body -->
          <div class="box-footer box-comments">
            <div class="box-comment">
              <!-- User image -->
              <div class="comment-text">
                    <span class="username">
                      ข้อมูลติดต่อสื่อสาร
                    </span><!-- /.username -->
                    <pre>
                <?php
                $i=1;
                foreach ($objuni as $key) {
                  echo '<p>'.$i++.'. '.$key->name.', เบอร์โทร '.$key->tel.', อีเมล์ '.$key->email.'</p>';
                  foreach ($key->center as $cen) {
                    echo '<p>&emsp;&emsp;&emsp;ศูนย์ - '.$cen->name.', เบอร์โทร '.$cen->tel.', อีเมล์ '.$cen->email.'</p>';
                  }
                }
                ?>
              </pre>
              </div>
              <!-- /.comment-text -->
            </div>
          </div>
          <!-- /.box-footer -->
        </div>
    </div>
  </div>

  @endsection

  @section('script')
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

  @endsection
