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

  <!-- /.col -->
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">ปัญหาในพื้นที่ชุมชน</h3>

        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="text" class="form-control input-sm" placeholder="Search Mail">
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
              <td class="mailbox-name"><a href="read-mail.html">อบต.ขุนฝาง</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">5 mins ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.คุ้งตะเภา</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">28 mins ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.งิ้วงาม</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">11 hours ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.แสนตอ</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">15 hours ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.น้ำอ่าง</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">Yesterday</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.บ้านแก่ง</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต. หาดสองแคว</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.บ่อทอง</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.ป่าคาย</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.ท่าสัก</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.บ้านโคน</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">4 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.ชัยจุมพล</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">12 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.ไผ่ล้อม</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">12 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.ท่าปลา</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
              </td>
              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
              <td class="mailbox-date">14 days ago</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">อบต.ฟากท่า</a></td>
              <td class="mailbox-subject"><b>Test Topic Problem</b> - Trying to find a solution to this problem...
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
