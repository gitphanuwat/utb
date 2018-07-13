<?php $__env->startSection('title','สารสนเทศเชิงระบบ'); ?>
<?php $__env->startSection('subtitle','รายงานข้อมูล'); ?>
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

use App\University;
use App\Taggroup;

$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">

  <div id='showgraph2'>
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ข้อมูลระบบ (จำแนกตามหน่วยงาน)</h3>
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
                          <span>".count($sumresch)."</span><span style='color:".$col[$i]."'> นักวิจัย</span>
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumexp'>
                          <span>".count($sumexp)."</span><span style='color:".$col[$i]."'> ผู้เชี่ยวชาญ</span>
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumres'>
                          <span>".count($sumres)."</span><span style='color:".$col[$i]."'> งานวิจัย</span>
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumcre'>
                          <span>".count($sumcre)."</span><span style='color:".$col[$i]."'> งานสร้างสรรค์</span>
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumare'>
                          <span>".count($sumarea)."</span><span style='color:".$col[$i]."'> พื้นที่ชุมชน</span>
                          </a></li>";
                          $i++;
                          echo "<li><a data-id='' href='#' class='btn btn-block btn-social btn-default btn-xs btnsumpro'>
                          <span>".count($sumpro)."</span><span style='color:".$col[$i]."'> ปัญหาชุมชม</span>
                          </a></li>";
                          $i++;
                      //}
                  ?>
                  </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id='showgraph1'>
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">ข้อมูลระบบ (จำแนกตามกลุ่มงาน)</h3>
          </div>
          <div class="box-body with-border">
              <div class="box-body chart-responsive">
                <div class="row">
                  <div class="col-md-10">
                      <canvas id="lineChart" style="height:300px"></canvas>
                  </div>
                  <div class="col-md-2">
                    <ul class="chart-legend clearfix">

                      <?php
                          $sumtag = Taggroup::get();
                          //$sumexpert = Expertlist::
                          $i=0;
                          foreach ($sumtag as $key) {
                            $idtag = $key->id;
                            //$resch = Researcher::get();
                            $resch = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
                            ->where('expertlists.taggroup_id',$idtag)->get();
                            $expt = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
                            ->where('expertlists.taggroup_id',$idtag)->get();
                            $res = Research::where('taggroup_id',$idtag)->get();
                            $cre = Creative::where('taggroup_id',$idtag)->get();
                            $area = Area::leftJoin('problems','areas.id','=','problems.area_id')
                            ->where('problems.taggroup_id',$idtag)->get();
                            $pro = Problem::where('taggroup_id',$idtag)->get();
                            $sum = count($resch)+count($expt)+count($res)+count($cre)+count($area)+count($pro);
                              //echo "<li><span class='external-event bg-$col[$i]'>".count($key->expertlist->where('expert_id','=',0))."</span> ".mb_substr($key->groupname,0,15,'UTF-8')."..</li><br>";
                              echo "<li><a data-id='".$key->id."' href='#' class='btn btn-block btn-social btn-default btn-xs btngroup'>
                              <span>".$sum."</span><span style='color:".$col[$i]."'> ".mb_substr($key->groupname,0,15,'UTF-8')."..</span>
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
                          <table class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อกลุ่มงาน</th>
                                <th>นักวิจัย<br>(ความเชี่ยวชาญ)</th>
                                <th>ผู้เชี่ยวชาญ<br>(ความเชี่ยวชาญ)</th>
                                <th>งานวิจัย</th>
                                <th>งานสร้างสรรค์</th>
                                <th>พื้นที่ชุมชน</th>
                                <th>ปัญหา</th>
                            </tr>
                            </thead>
                            <tbody>
                          ";
                          $i=1;
                          foreach ($objtag as $key) {
                            $idtag = $key->id;
                            //$resch = Researcher::get();
                            $resch = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
                            ->where('expertlists.taggroup_id',$idtag)->get();
                            $expt = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
                            ->where('expertlists.taggroup_id',$idtag)->get();
                            $res = Research::where('taggroup_id',$idtag)->get();
                            $cre = Creative::where('taggroup_id',$idtag)->get();
                            $area = Area::leftJoin('problems','areas.id','=','problems.area_id')
                            ->where('problems.taggroup_id',$idtag)
                            ->groupBy('area_id')
                            ->get();
                            $pro = Problem::where('taggroup_id',$idtag)->get();

                            $display .= "
                            <tr>
                              <td>".$i++."</td>
                              <td>".$key->groupname."</td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnresch'>Researcher <span class='badge'>".count($resch)."</span></a></td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnexp'>Expert <span class='badge'>".count($expt)."</span></a></td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnres'>Research <span class='badge'>".count($res)."</span></a></td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btncre'>Creative <span class='badge'>".count($cre)."</span></a></td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnare'>Area <span class='badge'>".count($area)."</span></a></td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs btnpro'>Problem <span class='badge'>".count($pro)."</span></a></td>
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

<!-- ChartJS 1.0.1 -->
<script src="<?php echo e(asset("assets/plugins/chartjs/Chart.min.js")); ?>"></script>

<?php
$i=0;
$obtag = Taggroup::get();
$data ='
<script>
$(function () {
  var areaChartData = {
  labels: ["นักวิจัย", "ผู้เชี่ยวชาญ", "งานวิจัย", "งานสร้างสรรค์", "พื้นที่ชุมชน", "ปัญหาชุมชน"],
  datasets: [';
  foreach ($obtag as $key) {
    $idtag = $key->id;
    $resch = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
    ->where('expertlists.taggroup_id',$idtag)->get();
    $expt = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
    ->where('expertlists.taggroup_id',$idtag)->get();
    $area = Area::leftJoin('problems','areas.id','=','problems.area_id')
    ->where('problems.taggroup_id',$idtag)->get();

    $data .='
    {
      label: "'.$key->groupname.'",
      fillColor: "'.$col[$i].'",
      strokeColor: "'.$col[$i].'",
      pointColor: "'.$col[$i].'",
      pointStrokeColor: "'.$col[$i].'",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "'.$col[$i].'",
      data: [';

      $data .=count($resch).',';
      $data .=count($expt).',';
      $data .=count($key->research).',';
      $data .=count($key->creative).',';
      $data .=count($area).',';
      $data .=count($key->problem).',';

      $data .='
      ]
    },';
    $i++;
  }
  $data .='
  ]
};

  var areaChartOptions = {
    showScale: true,
    scaleShowGridLines: false,
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleGridLineWidth: 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve: true,
    bezierCurveTension: 0.3,
    pointDot: true,
    pointDotRadius: 4,
    pointDotStrokeWidth: 1,
    pointHitDetectionRadius: 20,
    datasetStroke: true,
    datasetStrokeWidth: 2,
    datasetFill: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
    maintainAspectRatio: true,
    responsive: true
  };

var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
var lineChart = new Chart(lineChartCanvas);
var lineChartOptions = areaChartOptions;
lineChartOptions.datasetFill = false;
lineChart.Line(areaChartData, lineChartOptions);

});
</script>';
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
      $objuniver = University::get();
      $i=1;
      foreach ($objuniver as $obj) {
        $iduni = $obj->id;

        $objresearcher = Researcher::where('university_id',$iduni)->get();
        $objexpert = Expert::leftJoin('areas','experts.area_id','=','areas.id')
        ->where('areas.university_id',$iduni)->get();
        $objresearch = Research::leftJoin('researchers','researchs.researcher_id','=','researchers.id')
        ->where('researchers.university_id',$iduni)->get();
        $objcreative = Creative::leftJoin('researchers','creatives.researcher_id','=','researchers.id')
        ->where('researchers.university_id',$iduni)->get();
        $objarea = Area::where('university_id',$iduni)->get();
        $objproblem = Problem::leftJoin('areas','problems.area_id','=','areas.id')
        ->where('areas.university_id',$iduni)->get();
        //

        $data .= "{y: '".$obj->name."',";
        //foreach ($gobjtaggroup as $objtag1){

          //$data .=$objtag1->id.": 5, ";
          $data .= "1 : ".count($objresearcher).", ";
          $data .= "2 : ".count($objexpert).", ";
          $data .= "3 : ".count($objresearch).", ";
          $data .= "4 : ".count($objcreative).", ";
          $data .= "5 : ".count($objarea).", ";
          $data .= "6 : ".count($objproblem).", ";

        //}
        $data .="},";
      }
      $data .="],

      barColors: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'],
      xkey: 'y',

      ykeys: [";
      //foreach ($gobjtaggroup as $objtag2) {
        $data .="'1','2','3','4','5','6'";
      //}
      $data .="],

      labels: [";
      //foreach ($gobjtaggroup as $objtag3) {
        $data .="'นักวิจัย','ผู้เชี่ยวชาญ','งานวิจัย','งานสร้างสรรค์','พื้นที่ชุมชน','ปัญหาชุมชน'";
      //}
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
      $('.btnback').hide();

      $('.btnback').click(function(){
        $('#showgraph1').show();
        $('#showgraph2').show();
          $('.displaydetail').hide();
          $('.displayrecord').show();
          $('.btnback').hide();
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

      $('body').delegate('.btngroup','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaygroup(id);
      });

      $('body').delegate('.btnresch','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaylistresch(id);
      });

      $('body').delegate('.btnexp','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaylistexp(id);
      });

      $('body').delegate('.btnres','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaylistres(id);
      });

      $('body').delegate('.btncre','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaylistcre(id);
      });

      $('body').delegate('.btnare','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaylistare(id);
      });

      $('body').delegate('.btnpro','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaylistpro(id);
      });

  });

    function displayresch(){
        $.ajax({
          url : '<?php echo url('dss/system/showresch'); ?>',
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
          url : '<?php echo url('dss/system/showexp'); ?>',
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
          url : '<?php echo url('dss/system/showres'); ?>',
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
          url : '<?php echo url('dss/system/showcre'); ?>',
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
          url : '<?php echo url('dss/system/showare'); ?>',
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
          url : '<?php echo url('dss/system/showpro'); ?>',
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


function displaygroup(id){
    $.ajax({
      url : '<?php echo url('dss/system/showgroup'); ?>',
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

function displaylistresch(id){
  //alert(id);
    $.ajax({
      url : '<?php echo url('dss/system/listresch'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
        $("#example1").DataTable();
      }
    });
}

function displaylistexp(id){
    $.ajax({
      url : '<?php echo url('dss/system/listexp'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
        $("#example1").DataTable();
      }
    });
}

function displaylistres(id){
    $.ajax({
      url : '<?php echo url('dss/system/listres'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
        $("#example1").DataTable();
      }
    });
}

function displaylistcre(id){
  //alert(id);
    $.ajax({
      url : '<?php echo url('dss/system/listcre'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
        $("#example1").DataTable();
      }
    });
}

function displaylistare(id){
  //alert(id);
    $.ajax({
      url : '<?php echo url('dss/system/listare'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
      success : function(s)
      {
        $('.displaydetail').html(s);
        $("#example1").DataTable();
      }
    });
}

function displaylistpro(id){
  //alert(id);
    $.ajax({
      url : '<?php echo url('dss/system/listpro'); ?>',
      type : "get",
      //asyncfalse
      data : {
        'id' : id,
      },
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