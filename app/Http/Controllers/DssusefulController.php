<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Researcher;
use App\Expert;
use App\Research;
use App\Creative;
use App\Area;
use App\Problem;
use App\University;
use App\Useful;

class DssusefulController extends Controller
{
  public function getUseful(Request $request)
  {
    $objuniver = University::lists('name','id');
    return view('dss.useful',compact('objuniver'));
  }

  public function getGraphtest(Request $request)
  {
    $data = '
    <script>
      alert(0);
    </script>
    ';
    return $data;
  }

  public function getGraphall(Request $request)
  {
    $iduni = $request['iduni'];
          $sumresch = Researcher::get();
          $sumexp = Expert::get();
          $sumres = Research::get();
          $sumcre = Creative::get();
          $sumarea = Area::get();
          $sumpro = Problem::get();

          $allresch = Useful::leftJoin('researchs','usefuls.research_id','=','researchs.id')
          ->where('researchs.researcher_id','<>','')
          ->groupBy('researchs.researcher_id')->get();
          $allexp = Useful::where('expert_id','<>','')
          ->groupBy('expert_id')->get();
          $allres = Useful::where('research_id','<>','')
          ->groupBy('research_id')->get();
          $allcre = Useful::where('creative_id','<>','')
          ->groupBy('creative_id')->get();
          $allarea = Useful::where('area_id','<>','')
          ->groupBy('area_id')->get();
          $allpro = Useful::where('problem_id','<>','')
          ->groupBy('problem_id')->get();

    //return view('dss.useful',compact('objuniver'));
    $data = '
    <script>

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

            $data .=count($sumresch).', '.count($sumexp).', '.count($sumres).', '
            .count($sumcre).', '.count($sumarea).', '.count($sumpro);
            //for respond
            $sumdata = count($sumresch)+count($sumexp)+count($sumres)+
            count($sumcre)+count($sumarea)+count($sumpro);

            $data .=']
          },
          {
            label: "การใช้ข้อมูล",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: [';



            $data .=count($allresch).', '.count($allexp).', '.count($allres).', '
            .count($allcre).', '.count($allarea).', '.count($allpro);

            //for respond
            $sumreal = count($allresch)+count($allexp)+count($allres)+
            count($allcre)+count($allarea)+count($allpro);

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


      var areaChartCanvas = $("#areaChart1").get(0).getContext("2d");

      var areaChart = new Chart(areaChartCanvas).Line(areaChartData, areaChartOptions);

      $(".datares").html("'.$datares.'");

    </script>';
    return $data;
  }

  public function getGraphuni(Request $request)
  {
    $iduni = $request['iduni'];

          $sumresch = Researcher::where('university_id','=',$iduni)->get();
          $sumexp = Expert::where('university_id','=',$iduni)->get();
          $sumres = Research::leftJoin('researchers','researchs.researcher_id','=','researchers.id')
          ->where('researchers.university_id','=',$iduni)->get();
          $sumcre = Creative::leftJoin('researchers','creatives.researcher_id','=','researchers.id')
          ->where('researchers.university_id','=',$iduni)->get();
          $sumarea = Area::where('university_id','=',$iduni)->get();
          $sumpro = Problem::leftJoin('areas','problems.area_id','=','areas.id')
          ->where('areas.university_id','=',$iduni)->get();

          $allresch = Useful::leftJoin('researchs','usefuls.research_id','=','researchs.id')
          ->leftJoin('researchers','researchs.researcher_id','=','researchers.id')
          ->where('researchs.researcher_id','<>','')
          ->where('researchers.university_id','=',$iduni)
          ->groupBy('researchs.researcher_id')->get();
          $allexp = Useful::leftJoin('experts','usefuls.expert_id','=','experts.id')
          ->where('experts.university_id','=',$iduni)
          ->where('usefuls.expert_id','<>','')
          ->groupBy('usefuls.expert_id')->get();
          $allres = Useful::leftJoin('researchs','usefuls.research_id','=','researchs.id')
          ->leftJoin('researchers','researchs.researcher_id','=','researchers.id')
          ->where('researchers.university_id','=',$iduni)
          ->where('usefuls.research_id','<>','')
          ->groupBy('usefuls.research_id')->get();
          $allcre = Useful::leftJoin('creatives','usefuls.creative_id','=','creatives.id')
          ->leftJoin('researchers','creatives.researcher_id','=','researchers.id')
          ->where('researchers.university_id','=',$iduni)
          ->where('usefuls.creative_id','<>','')
          ->groupBy('usefuls.creative_id')->get();
          $allarea = Useful::leftJoin('areas','usefuls.area_id','=','areas.id')
          ->where('areas.university_id','=',$iduni)
          ->where('usefuls.area_id','<>','')
          ->groupBy('usefuls.area_id')->get();
          $allpro = Useful::leftJoin('problems','usefuls.problem_id','=','problems.id')
          ->leftJoin('areas','problems.area_id','=','areas.id')
          ->where('areas.university_id','=',$iduni)
          ->where('usefuls.problem_id','<>','')
          ->groupBy('usefuls.problem_id')->get();

    //return view('dss.useful',compact('objuniver'));
    $data = '
    <script>

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

            $data .=count($sumresch).', '.count($sumexp).', '.count($sumres).', '
            .count($sumcre).', '.count($sumarea).', '.count($sumpro);
            //for respond
            $sumdata = count($sumresch)+count($sumexp)+count($sumres)+
            count($sumcre)+count($sumarea)+count($sumpro);

            $data .=']
          },
          {
            label: "การใช้ข้อมูล",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: [';



            $data .=count($allresch).', '.count($allexp).', '.count($allres).', '
            .count($allcre).', '.count($allarea).', '.count($allpro);

            //for respond
            $sumreal = count($allresch)+count($allexp)+count($allres)+
            count($allcre)+count($allarea)+count($allpro);

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


      var areaChartCanvas = $("#areaChart2").get(0).getContext("2d");

      var areaChart = new Chart(areaChartCanvas).Line(areaChartData, areaChartOptions);

      $(".datares").html("'.$datares.'");

    </script>';
    return $data;
  }

}
