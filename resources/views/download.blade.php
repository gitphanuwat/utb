@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','ดาวน์โหลดเอกสาร')
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
        <h3 class="box-title">ดาวน์โหลดเอกสาร</h3>

        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="text" class="form-control input-sm" placeholder="ค้นหาเอกสาร">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
        </div>
        <!-- /.box-tools -->
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-android-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">หนังสือราชการ</span>
              <span class="info-box-number">--รายการ</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-android-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">มาตรฐานต่างๆ</span>
              <span class="info-box-number">--รายการ</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-android-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">แบบฟอร์ม</span>
              <span class="info-box-number">-- รายการ</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-android-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">เอกสารอื่นๆ</span>
              <span class="info-box-number">-- รายการ</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <!-- /.btn-group -->
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
              <td></td>
              <td class="mailbox-attachment"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">หนังสือภายใน</a></td>
              <td class="mailbox-subject"><b>บต.ฟากท่า</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">5 mins ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำร้องขอรับบริการข้อมูลข่าวสารของราชการ</a></td>
              <td class="mailbox-subject"><b>บต.ฟากท่า</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">28 mins ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำขอใบแทนใบอนุญาตหรือใบแทนใบรับรอง  </a></td>
              <td class="mailbox-subject"><b>อบต.ไผ่ล้อม</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">11 hours ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">แบบฟอร์มคำร้องขอหนังสือรับรองเงินเดือน</a></td>
              <td class="mailbox-subject"><b>อบต.คุ้งตะเภา</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">15 hours ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำขอมีบัตรประจำตัว หรือขอมีบัตรประจำตัวใหม่</a></td>
              <td class="mailbox-subject"><b>อบต.คุ้งตะเภา</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">Yesterday</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำขออนุญาตเปลี่ยนการใช้อาคาร  </a></td>
              <td class="mailbox-subject"><b>อบต.บ้านแก่ง</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">ใบแจ้งซ่อมไฟฟ้าสาธารณะ</a></td>
              <td class="mailbox-subject"><b>อบต.ชัยจุมพล</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">แบบฟอร์มใบลา</a></td>
              <td class="mailbox-subject"><b>อบต.งิ้วงาม</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำขอรับใบอนุญาต ประกอบกิจการโรงงาน</a></td>
              <td class="mailbox-subject"><b>อบต.งิ้วงาม</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำร้องขอสนับสนุนน้ำสำหรับการบริโภค / อุปโภค</a></td>
              <td class="mailbox-subject"><b>บต.ฟากท่า</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">2 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">การคัดเลือกผู้ประกอบวิชาชีพทางการศึกษาเพื่อรับรางวัลของคุรุสภา และสำนักงานคณะกรรมการส่งเสริมสวัสดิการและสวัสดิภาพครูและบุคลากรทางการศึกษา ประจำปี พ.ศ.2560</a></td>
              <td class="mailbox-subject"><b>กพส.</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">4 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">การโอนเงินภาษีท้องถิ่นที่จัดเก็บควบคู่กับภาษีธุรกิจเฉพาะให้แก่ อปท. ประจำเดือนพฤษภาคม 2560</a></td>
              <td class="mailbox-subject"><b>กพส.</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">12 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">แนวทางและมาตรการแก้ไขปัญหาหนี้ค่าสาธารณูปโภคค้างชำระของส่วนราชการ</a></td>
              <td class="mailbox-subject"><b>กพส.</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">12 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">การดำเนินงานโครงการ น้ำคือชีวิต : ศาสตร์พระราชาสู่แปลงเกษตรผสมผสานประชารัฐ</a></td>
              <td class="mailbox-subject"><bกพส.</b>
              </td>
              <td class="mailbox-attachment"></td>
              <td class="mailbox-date">14 days ago</td>
            </tr>
            <tr>
              <td></td>
              <td class="mailbox-star"><a href="#"><i class="ion ion-android-attach"></i></a></td>
              <td class="mailbox-name"><a href="read-mail.html">คำขอเปลี่ยนมาตรวัดน้ำ</a></td>
              <td class="mailbox-subject"><b>เทศบาล ต.ท่าเสา</b>
              </td>
              <td class="mailbox-attachment"></td>
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

          <!-- /.btn-group -->
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
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<script>
$('.sparkbar').each(function () {
  var $this = $(this);
  $this.sparkline('html', {
    type: 'bar',
    height: $this.data('height') ? $this.data('height') : '30',
    barColor: $this.data('color')
  });
});
</script>
@endsection
