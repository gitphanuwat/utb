<?php $__env->startSection('title','พื้นที่ชุมชน'); ?>
<?php $__env->startSection('subtitle','รายงานข้อมูล'); ?>
<?php $__env->startSection('styles'); ?>
<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo e(asset("assets/plugins/morris/morris.css")); ?>">
<?php $__env->stopSection(); ?>
<?php
use App\University;
use App\Taggroup;
use App\Research;
use App\Researcher;
use App\Expertlist;
use App\Problem;
$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
  <div id='showgraph1'>
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">ข้อมูลพื้นที่ชุมชนทั้งหมด ( <?php echo count($objarea);?> พื้นที่ )</h3>
          </div>
          <div class="box-body with-border">
              <div class="box-body chart-responsive">
                <div class="row">
                  <div class="col-md-10">
                      <div class="chart" id="bar-chart1" style="height: 300px;"></div>
                  </div>
                  <div class="col-md-2">
                    <ul class="chart-legend clearfix">
                    <?php
                        $sumtag = University::get();
                        $i=0;
                        foreach ($sumtag as $key) {
                            echo "<li><a data-id='".$key->id."' href='#' class='btn btn-block btn-social btn-default btn-xs btnarea' >
                            <span>".count($key->area)."</span> ม.".mb_substr($key->name,17,30,'UTF-8')."
                            </a></li>";
                            $i++;
                        }
                    ?>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
      </div>
  </div>
  <div id='showgraph2'>
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ปัญหาในพื้นที่ชุมชน (จำแนกตามกลุ่มปัญหา)</h3>
        </div>
        <div class="box-body with-border">
            <div class="box-body chart-responsive">
              <div class="row">
                <div class="col-md-10">
                    <div class="chart" id="bar-chart2" style="height: 300px;"></div>
                </div>
                <div class="col-md-2">
                  <ul class="chart-legend clearfix">
                  <?php
                      $sumtag = Taggroup::get();
                      //$sumexpert = Expertlist::
                      $i=0;
                      foreach ($sumtag as $key) {

                          //echo "<li><span class='external-event bg-$col[$i]'>".count($key->expertlist->where('expert_id','=',0))."</span> ".mb_substr($key->groupname,0,15,'UTF-8')."..</li><br>";
                          echo "<li><a data-id='".$key->id."' href='#' class='btn btn-block btn-social btn-default btn-xs btngroup'>
                          <span>".count($key->problem)."</span><span style='color:".$col[$i]."'> ".mb_substr($key->groupname,0,15,'UTF-8')."..</span>
                          </a></li>";

                          $i++;
                      }
                  ?>
                  </ul>
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
                          $display="
                          <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                              <th>ลำดับ</th>
                              <th>พื้นที่ชุมชน</th>
                              <th>ศูนย์เครือข่าย</th>
                              <th>มหาวิทยาลัย</th>
                              <th>ผู้เชี่ยวชาญ</th>
                              <th>ปัญหาในพื้นที่</th>
                            </tr>
                            </thead>
                            <tbody>
                          ";
                          $i=1;
                          foreach ($objarea as $key) {
                            $display .= "
                            <tr>
                              <td>".$i++."</td>
                              <td><a href='profilearea?id=".$key->id."'>".$key->name."</a></td>
                              <td>".$key->center->name."</td>
                              <td>".$key->university->name."</td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnexp'>Expert <span class='badge'>".count($key->expert)."</span></a>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnpro'>Problem <span class='badge'>".count($key->problem)."</span></a>
                              </td>
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


<?php $data="
<script>
  $(function () {
    var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [";

      $gobjuniver = University::get();
      foreach ($gobjuniver as $obj) {
          $data .= "{y: '".$obj->name."', a: ".count($obj->area)."},";
      }
      $data .= "],
      barColors: ['#00c0ef'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['พื้นที่'],
      hideHover: 'auto'
    });
  });
</script>";
echo $data;
?>

<!-- page script -->
<?php
$data = ";
<script>
  $(function () {
    'use strict';
    var bar = new Morris.Bar({
      element: 'bar-chart2',
      resize: true,

      data: [";
      $gobjuniver = University::get();
      $gobjtaggroup = Taggroup::get();

      foreach ($gobjuniver as $obj) {
        $data .= "{y: '".$obj->name."(".count($obj->researcher).")"."',";
        $iduni = $obj->id;
        foreach ($gobjtaggroup as $objtag1){
          $idtag = $objtag1->id;
          $cexpertlist = Problem::leftJoin('areas', 'problems.area_id', '=', 'areas.id')
          ->where('areas.university_id', $iduni)
          ->where('problems.taggroup_id', $idtag)
          //->groupBy('researcher_id')
          ->get();
          //$data .=$objtag1->id.": 5, ";
          $data .= $objtag1->id.": ".count($cexpertlist).", ";

        }
        $data .="},";
      }
      $data .="],

      barColors: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'],
      xkey: 'y',

      ykeys: [";
      foreach ($gobjtaggroup as $objtag2) {
        $data .="'".$objtag2->id."',";
      }
      $data .="],

      labels: [";
      foreach ($gobjtaggroup as $objtag3) {
        $data .="'".$objtag3->groupname."',";
      }
      $data .="],
      hideHover: 'auto'
    });
  });
</script>
";
echo $data;
?>

<script type="text/javascript">
    $(function(){
      $("#example1").DataTable();
      $('.btnback').hide();

      $('.btnback').click(function(){
        $('#showgraph1').show();
        $('#showgraph2').show();
        $('.displaydetail').hide();
        $('.displayrecord').show();
        $('.btnback').hide();
      });

      $('body').delegate('.btnshow','click',function(){
        var id = $(this).data('id');
        alert(id);
        //displayexp(id);
      });


      $('body').delegate('.btnexp','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displayexp(id);
      });

      $('body').delegate('.btnpro','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('#showdetail').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaypro(id);
      });

      $('body').delegate('.btngroup','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaygroup(id);
      });

      $('body').delegate('.btnarea','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displayarea(id);
      });

  });

function displayexp(id){
      $.ajax({
        url : '<?php echo url('eis/area/showexp'); ?>',
        type : "get",
        //asyncfalse
        data : {
          'id' : id,
        },
        success : function(s)
        {
          $('.displaydetail').html(s);
        }
      });
}

function displaypro(id){
      $.ajax({
        url : '<?php echo url('eis/area/showpro'); ?>',
        type : "get",
        //asyncfalse
        data : {
          'id' : id,
        },
        success : function(s)
        {
          $('.displaydetail').html(s);
        }
      });
}

function displaygroup(id){
    //alert(0);
    $.ajax({
      url : '<?php echo url('eis/area/showgroup'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
      }
    });
}

function displayarea(id){
    $.ajax({
      url : '<?php echo url('eis/area/showarea'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
      }
    });
}

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>