<div class="breadcrumbs">
  <?php echo link_to($task->getProduct(), 'product_show', $task->getProduct()) ?> :
  <?php echo link_to($task->getProject(), 'project_show', $task->getProject()) ?> :
  <?php echo ($task->isNew() ? 'New backlog task' : $task) ?>
</div>