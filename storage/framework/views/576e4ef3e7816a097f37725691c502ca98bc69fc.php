<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $__env->yieldContent('page_title'); ?>
  </h1>
        <?php if(Breadcrumbs::renderIfExists()): ?>
            <?php echo Breadcrumbs::render(); ?>

        <?php endif; ?>
</section>