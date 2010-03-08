<div class="breadcrumbs">
  <?php echo link_to($iteration->getProduct(), 'product_show', $iteration->getProduct()) ?> :
  <?php echo link_to($iteration->getProject(), 'project_show', $iteration->getProject()) ?> :
  <?php echo ($iteration->isNew() ? 'New iteration' : $iteration) ?>
</div>
