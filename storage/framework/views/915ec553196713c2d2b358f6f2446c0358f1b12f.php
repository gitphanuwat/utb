<?php $__env->startSection('title','ค้นหาข้อมูล'); ?>
<?php $__env->startSection('subtitle','ข้อมูล'); ?>
<?php $__env->startSection('body'); ?>
<?php
	function highlightKeywords($text, $keyword) {
		$wordsAry = explode(" ", $keyword);
		$wordsCount = count($wordsAry);

		for($i=0;$i<$wordsCount;$i++) {
			$highlighted_text = "<span style='font-weight:bold;color:red;'>$wordsAry[$i]</span>";
			$text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
		}

		return $text;
	}
?>
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">ค้นหาข้อมูล</h3>
    </div>
    <div class="box-body">
        <h4>นักวิจัย, งานวิจัย, ผู้เชี่ยวชาญ, ผลงานสร้างสรรค์, ปัญหาชุมชน</h4>
        <form action="<?php echo e(url('search')); ?>" method="POST" class="navbar-form pull-left" role="search">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="search" value="<?php echo e(isset($search) ? $search : null); ?>" placeholder="search" class="form-control" size="60"/>
                    <div class="input-group-addon" role="button" id="search">
                        <i class="glyphicon glyphicon-search"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
		<?php if($search): ?>
		<div class="box-body">
			<div class="displaysearch">ผลการค้นหา : <span style='font-weight:bold;color:red;font-size:20px;'><?php echo e($search); ?></span>
				หรือ <a href="<?php echo e(url('question')); ?>" class="btn btn-primary btn-xs btnsearch">ส่งข้อมูลให้นักวิจัย</a>
			</div>
		</div>
		<?php endif; ?>
</div>

<?php if($search): ?>
<div class="box box-defult">
  <div class="box-header with-border">
    <h3 class="box-title">ค้นหาข้อมูลภายในระบบ</h3>
  </div>

  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-condensed">
            <tbody>
              ค้นพบนักวิจัย <span class="label label-default"><?php echo e(count($researchers)); ?></span> รายการ
              <?php foreach($researchers as $obj): ?>
                  <tr>
                      <td><a href="eis/profile?id=<?php echo e($obj->id); ?>">
                        <?php echo e($obj->headname); ?><?php echo highlightKeywords($obj->firstname,$search).' '; ?> <?php echo highlightKeywords($obj->lastname,$search); ?></a></td>
                      <td><?php echo e($obj->university->name); ?></td>
                      <td><?php echo highlightKeywords($obj->email,$search); ?></td>
                      <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
          <table class="table table-condensed">
              <tbody>
                ค้นพบงานวิจัย <span class="label label-default"><?php echo e(count($researchs)); ?></span> รายการ
                <?php foreach($researchs as $obj): ?>
                    <tr>
                        <td><a href="eis/profileresearch?id=<?php echo e($obj->id); ?>">
                          <?php echo highlightKeywords($obj->title_th,$search); ?></a></td>
                        <td><?php echo highlightKeywords($obj->title_eng,$search); ?></td>
                        <td><?php echo highlightKeywords($obj->propose,$search); ?></td>
                        <td><?php echo highlightKeywords($obj->keyword,$search); ?></td>
                        <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
    </div>

  <div class="box-body">
  <div class="table-responsive">
      <table class="table table-condensed">
          <tbody>
            ค้นพบผู้เชี่ยวชาญ <span class="label label-default"><?php echo e(count($experts)); ?></span> รายการ
            <?php foreach($experts as $obj): ?>
                <tr>
                    <td><a href="eis/profileexp?id=<?php echo e($obj->id); ?>">
                      <?php echo e($obj->headname); ?><?php echo highlightKeywords($obj->firstname,$search).' '; ?> <?php echo highlightKeywords($obj->lastname,$search); ?></a></td>
                    <td><?php echo e($obj->area->name); ?>,<?php echo e($obj->area->center->name); ?>,<?php echo e($obj->area->center->university->name); ?></td>
                    <td><?php echo highlightKeywords($obj->email,$search); ?></td>
                    <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
    </div>
  </div>

  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-condensed">
            <tbody>
              ค้นพบความเชี่ยวชาญ <span class="label label-default"><?php echo e(count($expertlists)); ?></span> รายการ
              <?php foreach($expertlists as $obj): ?>
              <?php
                if($obj->expert_id!=0){
                  $id=$obj->expert_id;
                  $link='profileexp';
                }else{
                  $id=$obj->researcher_id;
                  $link='profile';
                }
              ?>
                  <tr>
                      <td><a href="eis/<?php echo e($link); ?>?id=<?php echo e($id); ?>">
                        <?php echo highlightKeywords($obj->title_th,$search); ?></a></td>
                      <td><?php echo highlightKeywords($obj->title_eng,$search); ?></td>
                      <td><?php echo highlightKeywords($obj->detail,$search); ?></td>
                      <td><?php echo e($id); ?></td>
                      <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                      <td></td>
                      <td></td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    </div>

    <div class="box-body">
      <div class="table-responsive">
          <table class="table table-condensed">
              <tbody>
                ค้นพบผลงานสร้างสรรค์ <span class="label label-default"><?php echo e(count($creatives)); ?></span> รายการ
                <?php foreach($creatives as $obj): ?>
                    <tr>
                        <td><a href="eis/profilecreative?id=<?php echo e($obj->id); ?>">
                          <?php echo highlightKeywords($obj->title,$search); ?></a></td>
                          <td><?php echo highlightKeywords($obj->keyword,$search); ?></td>
                        <td><?php echo highlightKeywords($obj->abstract,$search); ?></td>
                        <td></td>
                        <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>

      <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed">
                <tbody>
                  ค้นพบพื้นที่ชุมชน <span class="label label-default"><?php echo e(count($problems)); ?></span> รายการ
                  <?php foreach($problems as $obj): ?>
                      <tr>
                          <td><a href="eis/profilearea?id=<?php echo e($obj->area_id); ?>">
                            <?php echo highlightKeywords($obj->name,$search); ?></a></td>
                          <td><a href="eis/profilepro?id=<?php echo e($obj->id); ?>">
                            <?php echo highlightKeywords($obj->title,$search); ?></a></td>
                          <td><?php echo highlightKeywords($obj->detail,$search); ?></td>
                          <td><?php echo highlightKeywords($obj->instruct,$search); ?></td>
                          <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>

        <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed">
                <tbody>
                  ค้นพบผลการใช้ระบบ <span class="label label-default"><?php echo e(count($usefuls)); ?></span> รายการ
                  <?php foreach($usefuls as $obj): ?>
                      <tr>
                          <td><a href="eis/profileuseful?id=<?php echo e($obj->id); ?>">
                            <?php echo highlightKeywords($obj->title,$search); ?></a></td>
                          <td><?php echo highlightKeywords($obj->detial,$search); ?></td>
                          <td><?php echo highlightKeywords($obj->keyman,$search); ?></td>
                          <td><?php echo e(date('d.m.Y - H:i:s', strtotime($obj->created_at))); ?></td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/search.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>