@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','แบบสำรวจข้อมูล')
@section('styles')


@endsection

<?php
use App\Counter;
use App\Infor;
use App\Models\Image;
?>

@section('body')

<div class="row">
  <div class="col-md-3">
    <a href="compose.html" class="btn btn-primary btn-block margin-bottom">ส่งข้อร้องเรียน</a>

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">กล่องข้อความ</h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="#"><i class="fa fa-inbox"></i> ข้อร้องเรียนใหม่
            <span class="label label-primary pull-right">12</span></a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> กำลังดำเนินการ</a></li>
          <li><a href="#"><i class="fa fa-file-text-o"></i> ดำเนินการแล้วเสร็จ</a></li>
          <li><a href="#"><i class="fa fa-filter"></i> องค์ความรู้ <span class="label label-warning pull-right">65</span></a>
          </li>
          <li><a href="#"><i class="fa fa-trash-o"></i> ยกเลิก</a></li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /. box -->
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">สารสนเทศ</h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li><a href="#"><i class="fa fa-circle-o text-red"></i> สถิติข้อร้องเรียน</a></li>
          <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> สถิติดำเนินการ</a></li>
          <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> สถิติหน่วยงาน</a></li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">ข้อร้องเรียนในระบบ</h3>

        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="text" class="form-control input-sm" placeholder="ค้นหาข้อร้องเรียน">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
          </div>
          <!-- /.btn-group -->
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
          <div class="pull-right">
            1-50/200
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
            </div>
            <!-- /.btn-group -->
          </div>
          <!-- /.pull-right -->
        </div>
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">5 mins ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - กำลังดำเนินการ...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">28 mins ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ดำเนินการแล้วเสร็จ...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">11 hours ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">15 hours ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">Yesterday</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - เอกสารเผยแพร่...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - เอกสารเผยแพร่...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - กำลังดำเนินการ...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - กำลังดำเนินการ...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">4 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">12 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ดำเนินการแล้วเสร็จ...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">12 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">14 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">Test Data</a></td>
              <td class="mailbox-subject"><b>Test Topic Complaint</b> - ข้อร้องเรียนใหม่...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">15 days ago</td>
            </tr>
            </tbody>
          </table>
          <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer no-padding">
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
          </div>
          <!-- /.btn-group -->
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
          <div class="pull-right">
            1-50/200
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
            </div>
            <!-- /.btn-group -->
          </div>
          <!-- /.pull-right -->
        </div>
      </div>
    </div>
    <!-- /. box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->


@endsection

@section('script')
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection
