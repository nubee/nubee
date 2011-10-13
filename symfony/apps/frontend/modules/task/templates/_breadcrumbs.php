<div class="breadcrumbs">
  <?php echo link_to($task->getProduct(), 'product_show', $task->getProduct()) ?> :
  <?php echo link_to($task->getProject(), 'project_show', $task->getProject()) ?> :
  <?php echo link_to($task->getIteration(), 'iteration_show', $task->getIteration()) ?> :
  <?php echo link_to($task->getStory(), 'story_show', $task->getStory()) ?> :
  <?php echo ($task->isNew() ? 'New task' : $task) ?>
</div>