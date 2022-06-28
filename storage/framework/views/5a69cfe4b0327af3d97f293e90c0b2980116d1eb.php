<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li<?php $lm_attrs = $item->attr(); ob_start(); ?> <?php if($item->hasChildren()): ?>class ="dropdown"<?php endif; ?> <?php echo \Lavary\Menu\Builder::mergeStatic(ob_get_clean(), $lm_attrs); ?>>
    <?php if($item->link): ?> <a<?php $lm_attrs = $item->link->attr(); ob_start(); ?> <?php if($item->hasChildren()): ?> class="dropdown-toggle" data-toggle="dropdown" <?php endif; ?> <?php echo \Lavary\Menu\Builder::mergeStatic(ob_get_clean(), $lm_attrs); ?> href="<?php echo $item->url(); ?>">
      <?php echo $item->title; ?>

      <?php if($item->hasChildren()): ?> <b class="caret"></b> <?php endif; ?>
    </a>
    <?php else: ?>
      <?php echo $item->title; ?>

    <?php endif; ?>
    <?php if($item->hasChildren()): ?>
      <ul class="dropdown-menu">
        <?php echo $__env->make(config('laravel-menu.views.bootstrap-items'), 
array('items' => $item->children()), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </ul> 
    <?php endif; ?>
  </li>
  <?php if($item->divider): ?>
  	<li<?php echo Lavary\Menu\Builder::attributes($item->divider); ?>></li>
  <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
