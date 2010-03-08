<div class="breadcrumbs">
  <?php echo link_to($story->getProduct(), 'product_show', $story->getProduct()) ?> :
  <?php echo link_to($story->getProject(), 'project_show', $story->getProject()) ?> :
  <?php echo link_to($story->getIteration(), 'iteration_show', $story->getIteration()) ?> :
  <?php echo ($story->isNew() ? 'New story' : $story) ?>
</div>
