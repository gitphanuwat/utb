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
<!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ด้านการพัฒนา</span>
            <span class="info-box-number">5 เรื่อง<small>%</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ด้านการส่งเสริม</span>
            <span class="info-box-number">6 เรื่อง</span>
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
          <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">การดูแลและป้องกัน</span>
            <span class="info-box-number">7 เรื่อง</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ด้านการให้บริการ</span>
            <span class="info-box-number">2 เรื่อง</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">แบบสำรวจล่าสุด</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>รหัส</th>
                  <th>เรื่อง</th>
                  <th>ผลคะแนนมากที่สุด</th>
                  <th>ผลคะแนนทั้งหมด</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR9842</a></td>
                  <td>สาธารณูปโภคที่ควรพัฒนามากที่สุด..</td>
                  <td><span class="label label-success">ถนนในชุมชน..</span></td>
                  <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR9838</a></td>
                  <td>ช่องทางการให้บริการข่าวสารข้อมูล..</td>
                  <td><span class="label label-warning">การประชาสัมพันธ์ผ่าน..</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR7437</a></td>
                  <td>การส่งเสริมกิจกรรมชุมชนในด้านใดที่..</td>
                  <td><span class="label label-danger">ประชาสัมพันธ์แหล่งท่อง..</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR7429</a></td>
                  <td>การป้องกันและบรรเทาสาธารณภัย...</td>
                  <td><span class="label label-info">น้ำท่วมและทางระบบายน้ำ..</span></td>
                  <td>
                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR7425</a></td>
                  <td>TEST</td>
                  <td><span class="label label-warning">TEST</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR7424</a></td>
                  <td>TEST</td>
                  <td><span class="label label-danger">TEST</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">OR7423</a></td>
                  <td>TEST</td>
                  <td><span class="label label-success">TEST</span></td>
                  <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">แยบสอบถามใหม่</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">แบบสอบถามทั้งหมด</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">แบบสำรวจ-คนตอบล่าสุด</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">สาธารณูปโภคที่ควร..
                    <span class="label label-warning pull-right">42 คะแนน</span></a>
                      <span class="product-description">
                        การจัดการถังขยะในชุมชน...
                      </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">การให้บริการข่าวสารข้อมูลในชุมชน
                    <span class="label label-info pull-right">33 คะแนน</span></a>
                      <span class="product-description">
                        เสียงตามสายภายในหมู่บ้าน
                      </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">TEST <span class="label label-danger pull-right">25 คะแนน</span></a>
                      <span class="product-description">
                        TEST...
                      </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">TEST
                    <span class="label label-success pull-right">10 คะแนน</span></a>
                      <span class="product-description">
                        TEST...
                      </span>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="javascript:void(0)" class="uppercase">ดูแบบสอบถามทั้งหมด</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>


    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">รายละเอียด</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        -
      </div>
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
