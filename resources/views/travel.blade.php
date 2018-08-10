@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','Local Research Development')
@section('styles')


@endsection

<?php

use App\Counter;
use App\Infor;
use App\Models\Image;

if(Auth::user()){include ('makedata.php');}
include('data.php');

$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

@section('body')

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-android-globe"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">แหล่งธรรมชาติ</span>
              <span class="info-box-number">ทั้งหมด --</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-camera-retro"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">แหล่งวัฒนธรรม</span>
              <span class="info-box-number">--รายการ</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-android-boat"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ความสนใจพิเศษ</span>
              <span class="info-box-number">-- รายการ</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <!-- /.nav-tabs-custom -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                แหล่งท่องเที่ยว
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map5" style="height: 400px; width: 100%;">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d60839.40985735998!2d100.0711502001723!3d17.628211503933798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z4Liq4LiW4Liy4LiZ4LiX4Li14LmI4LiX4LmI4Lit4LiH4LmA4LiX4Li14LmI4Lii4Lin!5e0!3m2!1sth!2sth!4v1499051978562" width="900" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box (chat box) -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ข้อมูลแหล่งท่องเที่ยวภายในจังหวัด</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- select -->
              <div class="form-group" style="width:250px">
                <select class="form-control">
                  <option>--เลือกอำเภอ--</option>
                </select>
                <select class="form-control">
                  <option>--เลือกตำบล--</option>
                </select>

              </div>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>แหล่งท่องเที่ยว</th>
                  <th>สังกัด</th>
                  <th>ที่อยู่</th>
                  <th>ผู้ประสาน</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>แหล่งโบราณคดีเวียงเจ้าเงาะ</td>
                  <td>อบต.ทุ่งยั้ง</td>
                  <td>ตำบล ทุ่งยั้ง อำเภอ ลับแล อุตรดิตถ์ 53210์</td>
                  <td>-ี</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>พระฝาง</td>
                  <td>อบต.ผาจุก</td>
                  <td>15 5 ถนน โครงการบ้านพระฝาง ตำบล ผาจุก อำเภอเมืองอุตรดิตถ์ อุตรดิตถ์ 53000</td>
                  <td>093-267-6410</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>น้ำตกแม่พูล</td>
                  <td>อบต.แม่พูล</td>
                  <td>1043 ตำบล แม่พูล อำเภอ ลับแล อุตรดิตถ์ 53130</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>ไร่องุ่นคานาอัน</td>
                  <td>อบต.น้ำพี้</td>
                  <td>ตำบล น้ำพี้ อำเภอ ทองแสนขัน อุตรดิตถ์ 53230์</td>
                  <td>086 207 2096</td>
                </tr>

                <tr>
                  <td>5</td>
                  <td>น้ำตกวังดิน</td>
                  <td>อบต.ขุนฝาง</td>
                  <td>ตำบล ขุนฝาง อำเภอเมืองอุตรดิตถ์ อุตรดิตถ์ 53000์</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>เขื่อนสิริกิติ์</td>
                  <td>อบต.ผาเลือด</td>
                  <td>ตำบล ผาเลือด อำเภอ ท่าปลา อุตรดิตถ์ 53190์</td>
                  <td>055 461 136</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>อนุสาวรีย์เจ้าฟ้าฮ่ามกุมาร</td>
                  <td>อบต.ฝายหลวง</td>
                  <td>ตำบล ฝายหลวง อำเภอ ลับแล อุตรดิตถ์ 53130</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>บ้านไร่</td>
                  <td>เทศบาล ต.ศรีพนมมาศ</td>
                  <td>1041 ตำบล ศรีพนมมาศ อำเภอ ลับแล อุตรดิตถ์ 53130์</td>
                  <td>055 431 013</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>วัดพระแท่น</td>
                  <td>อบต.ทุ่งยั้ง</td>
                  <td>ตำบล ทุ่งยั้ง อำเภอ ลับแล อุตรดิตถ์ 53210</td>
                  <td>055 453 568</td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>โบราณสถานบ่อเหล็กน้ำพี้</td>
                  <td>อบต.น้ำพี้</td>
                  <td>ตำบล น้ำพี้ อำเภอ ทองแสนขัน อุตรดิตถ์ 53230์</td>
                  <td>-</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>ลำดับ</th>
                  <th>แหล่งท่องเที่ยว</th>
                  <th>สังกัด</th>
                  <th>ที่อยู่</th>
                  <th>ผู้ประสาน</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!-- right col -->
      </div>
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
