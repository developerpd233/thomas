<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li <?php if($item->hasChildren()): ?><?php endif; ?> >
        <?php if($item->link): ?> <a <?php if($item->hasChildren()): ?> class="treeview" data-toggle="dropdown"
                            <?php endif; ?> href="<?php echo $item->url(); ?>">
            <?php echo $item->title; ?>

            <?php if($item->hasChildren()): ?> <span class="fa arrow"></span> <?php endif; ?>
        </a>
        <?php else: ?>
            <?php echo $item->title; ?>

        <?php endif; ?>
        <?php if($item->hasChildren()): ?>
            <ul class="treeview-menu">
                <?php echo $__env->make(config('laravel-menu.views.bootstrap-items'), array('items' => $item->children()), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
        <?php endif; ?>
    </li>
    <?php if($item->divider): ?>
        <li<?php echo Lavary\Menu\Builder::attributes($item->divider); ?>></li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>
    if (window.outerWidth <= 768) {
        jQuery('li').click(function () {
            jQuery('li').removeClass('active');
            jQuery(this).toggleClass('active');
        });
    }
</script>