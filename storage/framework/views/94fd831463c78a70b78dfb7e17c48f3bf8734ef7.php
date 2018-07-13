<?php $__env->startSection('title','ผู้เชี่ยวชาญท้องถิ่น'); ?>
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
use App\Expert;
$col = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6',
        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#39CCCC', '#d2d6de', '#932ab6'];
?>

<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
  <div id='showgraph1'>
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">ผู้เชี่ยวชาญท้องถิ่นทั้งหมด (<?php echo count($objexpert);?> คน)</h3>
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
                          $sumexp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
                          ->where('areas.university_id', $iduni)
                          ->get();

                            echo "<li><a data-id='".$key->id."' href='#' class='btn btn-block btn-social btn-default btn-xs btnexpertor' >
                            <span>".count($sumexp)."</span> ม.".mb_substr($key->name,17,30,'UTF-8')."
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
          <h3 class="box-title">ผู้เชี่ยวชาญท้องถิ่น (จำแนกตามความเชี่ยวชาญ)</h3>
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
                          <span>".count($key->expertlist->where('researcher_id',0))."</span><span style='color:".$col[$i]."'> ".mb_substr($key->groupname,0,15,'UTF-8')."..</span>
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
                              <th>ชื่อผู้เชี่ยวชาญ</th>
                              <th>สังกัด</th>
                              <th>ความเชี่ยวชาญ</th>
                            </tr>
                            </thead>
                            <tbody>
                          ";
                          $i=1;
                          foreach ($objexpert as $key) {
                            $display .= "
                            <tr>
                              <td>".$i++."</td>
                              <td><a href='profileexp?id=".$key->id."'>".$key->headname.$key->firstname." ".$key->lastname."</a>
                              </td>
                              <td>".$key->area->name."</td>
                              <td><a data-id='$key->id' href='#' class='btn btn-primary btn-xs expshow'>Expert <span class='badge'>".count($key->expertlist)."</span></a>
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
        $iduni = $obj->id;
        $sumexp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
        ->where('areas.university_id', $iduni)
        ->get();
          $data .= "{y: '".$obj->name."', a: ".count($sumexp)."},";
      }
      $data .= "],
      barColors: ['#00c0ef'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['ผู้เชี่ยวชาญ'],
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
          $cexpertlist = Expertlist::leftJoin('experts', 'expertlists.expert_id', '=', 'experts.id')
          ->leftJoin('areas','experts.area_id','=','areas.id')
          ->leftJoin('universitys','areas.university_id','=','universitys.id')
          ->where('areas.university_id', $iduni)
          ->where('expertlists.taggroup_id', $idtag)
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

      $('body').delegate('.expshow','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displayexp(id);
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

      $('body').delegate('.btnexpertor','click',function(){
        $('#showgraph1').hide();
        $('#showgraph2').hide();
        $('.displayrecord').hide();
        $('.displaydetail').show();
        $('.btnback').show();
        var id = $(this).data('id');
        displayexpertor(id);
      });

  });

    function displayexp(id){
        $.ajax({
          url : '<?php echo url('eis/expert/showexpertlist'); ?>',
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

  function displayexpertor(id){
      $.ajax({
        url : '<?php echo url('eis/expert/showexpertor'); ?>',
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
      url : '<?php echo url('eis/expert/showgroupexp'); ?>',
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