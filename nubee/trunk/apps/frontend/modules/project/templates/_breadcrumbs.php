<div class="breadcrumbs">
  <?php echo link_to($project->getProduct(), 'product_show', $project->getProduct()) ?> :
  <?php echo ($project->isNew() ? 'New project' : $project) ?>
</div>
