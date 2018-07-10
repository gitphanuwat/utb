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
  <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">อบจ.</span>
                      <span class="info-box-number">{{$cresearcher}}</span>
                      <a href="{{url('/eis/researcher')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">เทศบาล.</span>
                      <span class="info-box-number">{{$cexpert}}</span>
                      <a href="{{url('/eis/researcher')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">อบต.</span>
                      <span class="info-box-number">{{$cresearch}}</span>
                      <a href="{{url('/eis/researcher')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">อื่นๆ.</span>
                      <span class="info-box-number">{{$ccreative}}</span>
                      <a href="{{url('/eis/researcher')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
  </div>

  <!-- Main row -->
  <div class="row">
          <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->

      <!-- /.box (chat box) -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">ข้อมูลหน่วยงานภายในจังหวัด</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- select -->
          <div class="form-group" style="width:250px">
            <select class="form-control">
              <option>--เลือกอำเภอ--</option>
            </select>
          </div>

          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อหน่วยงาน</th>
              <th>ประเภทหน่วยงาน</th>
              <th>ที่อยู่</th>
              <th>เว็บไซต์</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>อบจ.อุตรดิตถ์</td>
              <td>อบจ.</td>
              <td>11/15 ถนนประชานิมิตร ต.ท่าอิฐ อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.uttaradit-pao.go.th</td>
            </tr>
            <tr>
              <td>2</td>
              <td>เทศบาลเมืองอุตรดิตถ์</td>
              <td>เทศบาลเมือง</td>
              <td>ถนนประชานิมิตร ต.ท่าอิฐ อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.uttaraditcity.go.th</td>
            </tr>
            <tr>
              <td>3</td>
              <td>อบต.หาดงิ้ว</td>
              <td>อบต.</td>
              <td>99 หมู่ 3 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.hadngiw.go.th</td>
            </tr>
            <tr>
              <td>4</td>
              <td>อบต.วังดิน</td>
              <td>อบต.</td>
              <td>99/1 หมู่ 6 ต.ป่าเซ่า อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.pasaouttaradit.go.th</td>
            </tr>

            <tr>
              <td>5</td>
              <td>อบต.บ้านด่านนาขาม</td>
              <td>อบต.</td>
              <td>392 หมู่ 5 ต.บ้านด่านนาขาม อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.bdnk.go.th</td>
            </tr>
            <tr>
              <td>6</td>
              <td>อบต.แสนตอ</td>
              <td>อบต.</td>
              <td>99/1 หมู่ 6 ต.ป่าเซ่า อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.pasaouttaradit.go.th</td>
            </tr>
            <tr>
              <td>7</td>
              <td>อบต.หาดงิ้ว</td>
              <td>อบต.</td>
              <td>99 หมู่ 3 ต.หาดงิ้ว อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.hadngiw.go.th</td>
            </tr>
            <tr>
              <td>8</td>
              <td>เทศบาลตำบลหาดกรวด</td>
              <td>เทศบาลตำบล</td>
              <td>200 หมู่ 3 ต.บ้านด่าน อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.bandan.go.th</td>
            </tr>
            <tr>
              <td>9</td>
              <td>เทศบาลตำบลน้ำริด</td>
              <td>เทศบาลตำบล</td>
              <td>214 หมู่ 4 ต.งิ้วงาม อ.เมือง จ.อุตรดิตถ์</td>
              <td>http:/www.ngew-ngam.go.th</td>
            </tr>
            <tr>
              <td>10</td>
              <td>เทศบาลตำบลท่าเสา</td>
              <td>เทศบาลตำบล</td>
              <td>1 หมู่ 10 ต.ท่าเสา อ.เมือง จ.อุตรดิตถ์</td>
              <td>www.thasao.go.th</td>
            </tr>
            <tr>
              <td>11</td>
              <td>All others</td>
              <td>-</td>
              <td>-</td>
              <td>U</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อหน่วยงาน</th>
              <th>ประเภทหน่วยงาน</th>
              <th>ที่อยู่</th>
              <th>เว็บไซต์</th>
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
  <!-- /.row (main row) -->
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
