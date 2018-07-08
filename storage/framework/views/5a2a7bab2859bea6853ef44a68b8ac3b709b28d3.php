<?php
use App\Expert;
use App\Researcher;
use App\Research;
use App\Creative;
use App\Area;
use App\Problem;
?>

<?php $__env->startSection('title','ตรวจสอบการบันทึกข้อมูล'); ?>
<?php $__env->startSection('subtitle','แสดงรายการบันทึกข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ตรวจสอบการบันทึกข้อมูล</h3>
            </div>

            <div class='showdetail'>
            <div class="box">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th width='60'>ลำดับ</th>
                      <th>มหาวิทยาลัย</th>
                      <th>ศจค.</th>
                      <th>ผู้เชี่ยวชาญ<br>(ความเชี่ยวชาญ)</th>
                      <th>นักวิจัย<br>(ความเชี่ยวชาญ)</th>
                      <th>งานวิจัย<br>(เอกสารงานวิจัย)</th>
                      <th>งานสร้างสรรค์<br>(เอกสารผลงาน)</th>
                      <th>พื้นที่<br>(ข้อมูลพื้นฐาน)</th>
                      <th>ปัญหา<br>(การดำเนินการ)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $i=0;
                    ?>
                    <?php foreach($objuni as $key): ?>
                    <?php
                    $cobjexp = 0;
                    $objexp = Expert::where('university_id',$key->id)->get();
                    foreach ($objexp as $exp) {
                      if(count($exp->expertlist)!=0){
                        $cobjexp++;
                      }
                    }
                    $cobjrech = 0;
                    $objrech = Researcher::where('university_id',$key->id)->get();
                    foreach ($objrech as $rech) {
                      if(count($rech->expertlist)!=0){
                        $cobjrech++;
                      }
                    }
                    $cobjres = 0;
                    $objres = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
                    ->where('researchers.university_id',$key->id)
                    ->select('researchs.*')
                    ->get();
                    foreach ($objres as $res) {
                      if(count($res->doc)!=0){
                        $cobjres++;
                      }
                    }
                    $cobjcre = 0;
                    $objcre = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
                    ->where('researchers.university_id',$key->id)->get();
                    foreach ($objcre as $cre) {
                      if($cre->file!=''){
                        $cobjcre++;
                      }
                    }
                    $cobjare = 0;
                    $objare = Area::where('university_id',$key->id)->get();
                    foreach ($objare as $are) {
                      if($are->context!=''){
                        $cobjare++;
                      }
                    }
                    $cobjpro = 0;
                    $objpro = Problem::leftjoin('areas','problems.area_id','=','areas.id')
                    ->where('areas.university_id',$key->id)->get();
                    foreach ($objpro as $pro) {
                      if($pro->status == 4){
                        $cobjpro++;
                      }
                    }

                    ?>
                      <tr>
                        <td><?php echo e(++$i); ?></td>
                        <td><?php echo e($key->name); ?></td>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class='btn btn-default btn-xs btncenter'><?php echo e(count($key->center)); ?></a></td>
                        <?php
                        $cl='btn-default';$c1=0;
                        @$c1=$cobjexp/count($objexp);
                        if($c1>0.75){$cl='btn-info';}else if($c1>0.5){$cl='btn-success';}else if($c1>0.25){$cl='btn-warning';}else{$cl='btn-danger';} ?>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class="btn <?php echo e($cl); ?> btn-xs btnexp"><?php echo e(count($objexp)); ?>(<?php echo e($cobjexp); ?>)</a></td>
                        <?php
                        $cl='btn-default';
                        @$c=$cobjrech/count($key->researcher);
                        if($c>0.75){$cl='btn-info';}else if($c>0.5){$cl='btn-success';}else if($c>0.25){$cl='btn-warning';}else{$cl='btn-danger';} ?>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class='btn <?php echo e($cl); ?> btn-xs btnrech'><?php echo e(count($key->researcher)); ?>(<?php echo e($cobjrech); ?>)</a></td>
                        <?php
                        $cl='btn-default';
                        @$c=$cobjres/count($objres);
                        if($c>0.75){$cl='btn-info';}else if($c>0.5){$cl='btn-success';}else if($c>0.25){$cl='btn-warning';}else{$cl='btn-danger';} ?>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class='btn <?php echo e($cl); ?> btn-xs btnres'><?php echo e(count($objres)); ?>(<?php echo e($cobjres); ?>)</a></td>
                        <?php
                        $cl='btn-default';
                        @$c=$cobjcre/count($objcre);
                        if($c>0.75){$cl='btn-info';}else if($c>0.5){$cl='btn-success';}else if($c>0.25){$cl='btn-warning';}else{$cl='btn-danger';} ?>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class='btn <?php echo e($cl); ?> btn-xs btncre'><?php echo e(count($objcre)); ?>(<?php echo e($cobjcre); ?>)</a></td>
                        <?php
                        $cl='btn-default';
                        @$c=$cobjare/count($key->area);
                        if($c>0.75){$cl='btn-info';}else if($c>0.5){$cl='btn-success';}else if($c>0.25){$cl='btn-warning';}else{$cl='btn-danger';} ?>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class='btn <?php echo e($cl); ?> btn-xs btnare'><?php echo e(count($key->area)); ?>(<?php echo e($cobjare); ?>)</a></td>
                        <?php
                        $cl='btn-default';
                        @$c=$cobjpro/count($objpro);
                        if($c>0.75){$cl='btn-info';}else if($c>0.5){$cl='btn-success';}else if($c>0.25){$cl='btn-warning';}else{$cl='btn-danger';} ?>
                        <td><a data-id="<?php echo e($key->id); ?>" href='#cen' class='btn <?php echo e($cl); ?> btn-xs btnpro'><?php echo e(count($objpro)); ?>(<?php echo e($cobjpro); ?>)</a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="btn-group btn-group-xs" role="group" aria-label="success">
                <button type="button" class="btn btn-danger"><25%</button>
                <button type="button" class="btn btn-warning"><50%</button>
                <button type="button" class="btn btn-success"><75%</button>
                <button type="button" class="btn btn-info">>75%</button>
              </div>
            </div>
            </div>

            <div class='detailcenter' id='cen'>
            <div class="box">
              <div class="showcenter">
              </div>
            </div>
            </div>

            <div class='detailarea' id='are'>
            <div class="box">
              <div class="showarea">
              </div>
            </div>
            </div>

          </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(function(){
      //displaydata();

      $('.showcenter').hide();
      $('.showarea').hide();

      $('.btncenter').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadcenter(iduni);
      });
      $('.btnexp').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadexp(iduni);
      });
      $('.btnrech').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadrech(iduni);
      });
      $('.btnres').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadres(iduni);
      });
      $('.btncre').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadcre(iduni);
      });
      $('.btnare').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadare(iduni);
      });
      $('.btnpro').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadpro(iduni);
      });
      //$('.btnarea').click(function(){
      $('body').delegate('.btnarea','click',function(){
          $('.showarea').show();
          var idcen = $(this).data('id');
          loadarea(idcen);
          //alert(idcen);
      });

    });
    function loadcenter(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getcenter'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
//Recheck
    function loadexp(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getexp'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadrech(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getrech'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadres(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getres'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadcre(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getcre'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadare(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getare'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadpro(iduni){
      //alert(iduni);
        $.ajax({
          url : '<?php echo url('analyze/getpro'); ?>',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }

    function loadarea(idcen){
      //alert(idcen);
        $.ajax({
          url : '<?php echo url('analyze/getarea'); ?>',
          type : "get",
          data : {
            'idcen' : idcen,
          },
          success : function(s)
          {
            $('.showarea').html(s);
          }
        });
  }

    function displaydata(){
      //alert(0);
      $.ajax({
        url : '<?php echo url('analyze/getstruct'); ?>',
        type : "get",
        data : {},
        success : function(s)
        {
          $('.showdetail').html(s);
          //if(re == 0){alert('save');}else{alert('not save');}
          //$("#example1").DataTable();
        }
      });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>