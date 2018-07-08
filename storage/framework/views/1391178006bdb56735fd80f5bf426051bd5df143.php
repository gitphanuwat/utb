<?php $__env->startSection('title','การใช้ประโยชน์'); ?>
<?php $__env->startSection('subtitle','รายงานการใช้ข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>
<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/morris/morris.css")); ?>">
<?php $__env->stopSection(); ?>
<?php
use App\Researcher;
use App\Research;
use App\Expert;
use App\Expertlist;
use App\Creative;
use App\Area;
use App\Problem;
use App\Useful;

use App\University;

$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">

  <div id='showgraph2'>

    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">การใช้ประโยชน์ (จากข้อมูลระบบ)</h3>
        </div>
        <div class="box-body with-border">
          <label>มหาวิทยาลัย</label>
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="">--- เลือกทั้งหมด ---</option>
              <?php foreach($objuniver as $key => $value): ?>
                  <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
              <?php endforeach; ?>
          </select>

            <div class="box-body chart-responsive">
              <div class="row">
                <div class="col-md-10">

                  <canvas id="areaChart1" style="height:250px"></canvas>
                  <canvas id="areaChart2" style="height:250px"></canvas>
                </div>
                <div class="col-md-2">
                  <ul class="chart-legend clearfix">
                    <li>ข้อมูลในระบบ</li>
                  <?php
                  $sumresch = Researcher::get();
                  $sumexp = Expert::get();
                  $sumres = Research::get();
                  $sumcre = Creative::get();
                  $sumarea = Area::get();
                  $sumpro = Problem::get();
                      //$sumexpert = Expertlist::
                      $i=0;
                      //foreach ($sumtag as $key) {

                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumresch'>
                          <span>".count($sumresch)."</span>นักวิจัย
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumexp'>
                          <span>".count($sumexp)."</span>ผู้เชี่ยวชาญ
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumres'>
                          <span>".count($sumres)."</span>งานวิจัย
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumcre'>
                          <span>".count($sumcre)."</span>งานสร้างสรรค์
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumare'>
                          <span>".count($sumarea)."</span>พื้นที่ชุมชน
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumpro'>
                          <span>".count($sumpro)."</span>ปัญหาชุมชม
                          </a></li>";
                          $i++;
                      //}
                  ?>
                  </ul>
                  <br><br>

                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h3><div class="datares"></div>%</h3>
                        <p>Data Usefuls</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box-primary">
          <div class="box-body">
            <div class="displayrecord">
              <?php
              $display = "<h3>ข้อมูลจากการใช้ประโยชน์</h3>";

              $objuseful = Useful::orderby('title')->get();

              $display .= "<h4>ข้อมูลโครงการ (จากการใช้ประโยชน์)</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อโครงการ</th>
                  <th>ปัญหาชุมชน</th>
                  <th>พื้นที่ชุมชน</th>
                  <th>สังกัด</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($objuseful as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profileuseful?id=".$key->id."'>".$key->title."</a></td>
                  <td>".@$key->problem->title."</td>
                  <td>".$key->area->name."</td>
                  <td>".$key->area->center->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              echo $display;
              ?>
            </div>
            <button type="button" class="btn btn-primary btnback"><i class="fa fa-fw fa-reply"></i> ย้อนกลับ</button>
          </div>
        </div>

        <div class="box box-primary">
          <div class="box-body">
            <div class="displaydetail"></div>
          </div>
        </div>
      </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset("assets/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo e(asset("assets/plugins/morris/morris.min.js")); ?>"></script>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo e(asset("assets/plugins/chartjs/Chart.min.js")); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/js/search.js')); ?>"></script>

<script type="text/javascript">
    $(function(){

      displaygraph();
      $('.btnback').hide();

      $('.btnback').click(function(){
        $('#showgraph1').show();
        $('#showgraph2').show();
          $('.displaydetail').hide();
          $('.displayrecord').show();
          $('.btnback').hide();
      });

      //load graph
      $('select[name="university_id"]').on('change', function() {
        //$("#areaChart").html('');

        var stateID = $(this).val();
        displaygraph(stateID);
      });

      $('body').delegate('.btnsumresch','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        //var id = $(this).data('id');
        displayresch();
      });

      $('body').delegate('.btnsumexp','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        displayexp();
      });

      $('body').delegate('.btnsumres','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        displayres();
      });

      $('body').delegate('.btnsumcre','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        displaycre();
      });

      $('body').delegate('.btnsumare','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        displayare();
      });

      $('body').delegate('.btnsumpro','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        displaypro();
      });


  });

  function displaygraph(iduni){
    //alert(iduni);
    if(!iduni){
      $.ajax({
        url : '<?php echo url('dss/useful/showgraphall'); ?>',
        type : "get",
        //asyncfalse
        data : {
                  'iduni' : iduni,
                },
        success : function(s)
        {
          //$('#areaChart').destroy();
          $("#areaChart2").hide()
          $("#areaChart1").show()
          $("#areaChart1").html(s)
          //$('.datares').html(s);
        }
      });
    }else{
      $.ajax({
        url : '<?php echo url('dss/useful/showgraphuni'); ?>',
        type : "get",
        //asyncfalse
        data : {
                  'iduni' : iduni,
                },
        success : function(s)
        {
          //$('#areaChart').destroy();
          $("#areaChart1").hide();
          $("#areaChart2").show();
          $("#areaChart2").html(s)
          //$('.datares').html(s);
        }
      });
    }
  }

    function displayresch(){
        $.ajax({
          url : '<?php echo url('dss/topic/showresch'); ?>',
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            $('.displaydetail').html(s);
            $("#example1").DataTable();
          }
        });
    }

    function displayexp(){
        $.ajax({
          url : '<?php echo url('dss/topic/showexp'); ?>',
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            $('.displaydetail').html(s);
            $("#example1").DataTable();
          }
        });
    }

    function displayres(){
        $.ajax({
          url : '<?php echo url('dss/topic/showres'); ?>',
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            $('.displaydetail').html(s);
            $("#example1").DataTable();
          }
        });
    }

    function displaycre(){
        $.ajax({
          url : '<?php echo url('dss/topic/showcre'); ?>',
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            $('.displaydetail').html(s);
            $("#example1").DataTable();
          }
        });
    }

    function displayare(){
        $.ajax({
          url : '<?php echo url('dss/topic/showare'); ?>',
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            $('.displaydetail').html(s);
            $("#example1").DataTable();
          }
        });
    }

    function displaypro(){
        $.ajax({
          url : '<?php echo url('dss/topic/showpro'); ?>',
          type : "get",
          //asyncfalse
          data : {},
          success : function(s)
          {
            $('.displaydetail').html(s);
            $("#example1").DataTable();
          }
        });
    }





</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>