@extends('layouts.template')
@section('title','ระบบสนับสนุนโจทย์วิจัย')
@section('subtitle','ค้นหาข้อมูล')
@section('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset("assets/plugins/morris/morris.css") }}">
@endsection
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

@section('body')
<div class="row">
<div class="col-md-12">

  <div id='showgraph2'>
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">สืบค้นข้อมูลเพื่อสนับสนุนโจทย์วิจัย</h3>
        </div>
        <div class="box-body with-border">
          <div class="row">
            <div class="col-lg-12">
                  <form action="{{ url('dss/topic') }}" method="POST" class="navbar-form pull-left" role="search">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      <i class="fa fa-bar-chart-o"></i>
                      <div class="form-group">
                          <div class="input-group">
                              <input type="text" name="search" value="{{ isset($search) ? $search : null }}" placeholder="คำค้น (จากหัวข้อหรือคำถามงานวิจัย)" class="form-control" size="60" />
                              <div class="input-group-addon" role="button" id="search">
                                  <i class="glyphicon glyphicon-search"></i>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">วิเคราะห์การตอบสนองคำค้น (จากข้อมูลระบบ)</h3>
        </div>
        <div class="box-body with-border">
            <div class="box-body chart-responsive">
              <div class="row">
                <div class="col-md-10">
                  <canvas id="areaChart" style="height:250px"></canvas>
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
                        <p>Data Respons</p>
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
              if($search){
              $display = "<h3>ข้อมูลจากการสืบค้น</h3>";

              $txt = $search;

              $sumresch = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
              ->where('title_th','LIKE',"%$search%")
              ->orwhere('title_eng','LIKE',"%$search%")
              ->groupBy('researchers.id')->get();

              $display .= "<h4>ข้อมูลนักวิจัย (จากความเชี่ยวชาญ)</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อนักวิจัย</th>
                  <th>ความเชี่ยวชาญ</th>
                  <th>สังกัด</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($sumresch as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profile?id=".$key->researcher_id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
                  <td>".$key->title_th."<br>".$key->title_eng."</td>
                  <td>".$key->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              $sumexp = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
              ->where('title_th','LIKE',"%$search%")
              ->orwhere('title_eng','LIKE',"%$search%")
              ->groupBy('experts.id')->get();
              $display .= "<h4>ข้อมูลผู้เชี่ยวชาญ (จากความเชี่ยวชาญ)</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อผู้เชี่ยวชาญ</th>
                  <th>ความเชี่ยวชาญ</th>
                  <th>สังกัด</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($sumexp as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profileexp?id=".$key->expert_id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
                  <td>$key->title_th<br>$key->title_eng</td>
                  <td>".$key->area->name." : ".$key->area->center->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              $sumres = Research::where('title_th','LIKE',"%$search%")
              ->orwhere('title_eng','LIKE',"%$search%")->get();
              $display .= "<h4>ข้อมูลงานวิจัย</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่องานวิจัย</th>
                  <th>นักวิจัย</th>
                  <th>สังกัด</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($sumres as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</a></td>
                  <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
                  <td>".$key->researcher->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              $sumcre = Creative::where('title','LIKE',"%$search%")->get();
              $display .= "<h4>ข้อมูลงานสร้างสรรค์</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อผลงานสร้างสรรค์</th>
                  <th>เจ้าของผลงาน</th>
                  <th>สังกัด</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($sumcre as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profilecreative?id=".$key->id."' target='blank'>".$key->title."</a></td>
                  <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
                  <td>".$key->researcher->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              $sumare = Area::leftJoin('problems','areas.id','=','problems.area_id')
              ->where('title','LIKE',"%$search%")
              ->groupBy('areas.id')->get();
              $display .= "<h4>ข้อมูลพื้นที่ชุมชน (จากปัญหาพื้นที่ชุมชน)</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>พื้นที่ชุมชน</th>
                  <th>สังกัด</th>
                  <th>มหาวิทยาลัย</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($sumare as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profilearea?id=".$key->area_id."' target='blank'>".$key->name."</td>
                  <td>".$key->center->name."</a></td>
                  <td>".$key->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              $sumpro = Problem::where('title','LIKE',"%$search%")->get();
              $display .= "<h4>ข้อมูลปัญหาชุมชน</h4>";
              $display .= "
              <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ปัญหาในพื้นที่</th>
                  <th>พื้นที่ชุมชน</th>
                  <th>สังกัด</th>
                </tr>
                </thead>
                <tbody>
              ";
              $i=1;
              foreach ($sumpro as $key) {
                $display .= "
                <tr>
                  <td width='50'>".$i++."</td>
                  <td><a href='../eis/profilepro?id=".$key->id."' target='blank'>".$key->title."</td>
                  <td>".$key->area->name."</a></td>
                  <td>".$key->area->center->university->name."</td>
                </tr>
                ";
              }
              $display .= "
                </tbody>
              </table>
              ";

              echo $display;
              }
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

@endsection
@section('script')
<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset("assets/plugins/morris/morris.min.js") }}"></script>

<!-- ChartJS 1.0.1 -->
<script src="{{ asset("assets/plugins/chartjs/Chart.min.js") }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/search.js') }}"></script>

<?php
$data = '
<script>
$(function () {

  var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
  var areaChart = new Chart(areaChartCanvas);

  var areaChartData = {
    labels: ["นักวิจัย", "ผู้เชี่ยวชาญ", "งานวิจัย", "งานสร้างสรรค์", "พื้นที่ชุมชน", "ปัญหาชุมชน"],
    datasets: [
      {
        label: "ข้อมูลในระบบ",
        fillColor: "rgba(210, 214, 222, 1)",
        strokeColor: "rgba(210, 214, 222, 1)",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [';

        $sumresch = Researcher::get();
        $sumexp = Expert::get();
        $sumres = Research::get();
        $sumcre = Creative::get();
        $sumarea = Area::get();
        $sumpro = Problem::get();

        $data .=count($sumresch).', '.count($sumexp).', '.count($sumres).', '
        .count($sumcre).', '.count($sumarea).', '.count($sumpro);
        //for respond
        $sumdata = count($sumresch)+count($sumexp)+count($sumres)+
        count($sumcre)+count($sumarea)+count($sumpro);

        $data .=']
      },
      {
        label: "ข้อมูลค้นพบ",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [';

        $txt = $search;

        if($search==''){$sumresch=0;}else{
          $sumresch = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
          ->where('title_th','LIKE',"%$search%")
          ->orwhere('title_eng','LIKE',"%$search%")
          ->groupBy('researchers.id')->count();
        }
        if($search==''){$sumexp=0;}else{
          $sumexp = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
          ->where('title_th','LIKE',"%$search%")
          ->orwhere('title_eng','LIKE',"%$search%")
          ->groupBy('experts.id')->count();
        }
        if($search==''){$sumres=0;}else{
          $sumres = Research::where('title_th','LIKE',"%$search%")->orwhere('title_eng','LIKE',"%$search%")->count();
        }
        if($search==''){$sumcre=0;}else{
          $sumcre = Creative::where('title','LIKE',"%$search%")->count();
        }
        if($search==''){$sumarea=0;}else{
          $sumarea = Area::leftJoin('problems','areas.id','=','problems.area_id')
          //->groupBy('area_id')
          ->where('problems.title','LIKE',"%$search%")->count();
        }
        if($search==''){$sumpro=0;}else{
          $sumpro = Problem::where('title','LIKE',"%$search%")->count();
        }

        $data .=$sumresch.', '.$sumexp.', '.$sumres.', '
        .$sumcre.', '.$sumarea.', '.$sumpro;

        //for respond
        $sumreal = $sumresch+$sumexp+$sumres+
        $sumcre+$sumarea+$sumpro;
        $datares = round(($sumreal*100)/$sumdata,2);


        $data .=']
      }
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

  areaChart.Line(areaChartData, areaChartOptions);

});

$(".datares").html("'.$datares.'");

</script>';
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


  });

    function displayresch(){
        $.ajax({
          url : '{!! url('dss/topic/showresch') !!}',
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
          url : '{!! url('dss/topic/showexp') !!}',
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
          url : '{!! url('dss/topic/showres') !!}',
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
          url : '{!! url('dss/topic/showcre') !!}',
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
          url : '{!! url('dss/topic/showare') !!}',
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
          url : '{!! url('dss/topic/showpro') !!}',
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

@endsection
