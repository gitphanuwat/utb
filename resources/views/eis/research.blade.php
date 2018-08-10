@extends('layouts.template')
@section('title','งานวิจัย')
@section('subtitle','รายงานข้อมูล')
@section('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset("assets/plugins/morris/morris.css") }}">
@endsection
<?php
use App\University;
use App\Taggroup;
use App\Research;
use App\Researcher;
use App\Expertlist;
use App\Expert;
$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

@section('body')
<div class="row">
<div class="col-md-12">
  <div id='showgraph1'>
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">งานวิจัยทั้งหมด ( {{ count($objres)}} เรื่อง )</h3>
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

                          $iduni = $key->id;
                          $sumres = Research::leftJoin('researchers', 'researchs.researcher_id', '=', 'researchers.id')
                          ->where('researchers.University_id',$iduni)
                          ->get();

                            echo "<li><a data-id='".$key->id."' href='#' class='btn btn-block btn-social btn-default btn-xs btnresearch' >
                            <span>".count($sumres)."</span> ม.".mb_substr($key->name,17,30,'UTF-8')."
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
          <h3 class="box-title">งานวิจัย (จำแนกตามกลุ่ม)</h3>
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
                          echo "<li><a data-id='".$key->id."' href='#' class='btn btn-block btn-social btn-default btn-xs btngroup'>
                          <span>".count($key->research)."</span><span style='color:".$col[$i]."'> ".mb_substr($key->groupname,0,15,'UTF-8')."..</span>
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
                              <th>ชื่องานวิจัย</th>
                              <th style='width:200px'>ชื่อนักวิจัย</th>
                              <th>เอกสาร</th>
                            </tr>
                            </thead>
                            <tbody>
                          ";
                          $i=1;
                          foreach ($objres as $key) {
                            $display .= "
                            <tr>
                              <td width='50'>".$i++."</td>
                              <td><a href='profileresearch?id=".$key->id."'>".$key->title_th."</a></td>
                              <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs docshow'>Document <span class='badge'>".count($key->doc)."</span></a>
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

@endsection
@section('script')

<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>


<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset("assets/plugins/morris/morris.min.js") }}"></script>


<?php $data="
<script>
  $(function () {
    var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [";
      $gobjuniver = University::get();
      foreach ($gobjuniver as $obj) {
        $iduni = $obj->id;

        $sumres = Research::leftJoin('researchers', 'researchs.researcher_id', '=', 'researchers.id')
        ->where('researchers.University_id',$iduni)
        ->get();
          $data .= "{y: '".$obj->name."', a: ".count($sumres)."},";
      }
      $data .= "],
      barColors: ['#00c0ef'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['งานวิจัย'],
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
        $iduni = $obj->id;
        $data .= "{y: '".$obj->name."',";
        foreach ($gobjtaggroup as $objtag1){
          $idtag = $objtag1->id;

          $cresearch = Research::leftJoin('researchers', 'researchs.researcher_id', '=', 'researchers.id')
          ->where('researchers.University_id',$iduni)
          ->get();

          $cresearch = Research::leftJoin('researchers', 'researchs.researcher_id', '=', 'researchers.id')
          //->leftJoin('areas','experts.area_id','=','areas.id')
          //->leftJoin('universitys','areas.university_id','=','universitys.id')
          //->where('areas.university_id', $iduni)
          ->where('researchers.university_id',$iduni)
          ->where('researchs.taggroup_id', $idtag)
          //->groupBy('researcher_id')
          ->get();
          //$data .=$objtag1->id.": 5, ";
          $data .= $objtag1->id.": ".count($cresearch).", ";

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

      $('body').delegate('.docshow','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displaydoc(id);
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

      $('body').delegate('.btnresearch','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displayresearch(id);
      });

  });

  function displayresearch(id){
      $.ajax({
        url : '{!! url('eis/research/showresearch') !!}',
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
    $.ajax({
      url : '{!! url('eis/research/showgroup') !!}',
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

function displaydoc(id){
    $.ajax({
      url : '{!! url('eis/research/showdoc') !!}',
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

@endsection
