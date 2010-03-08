<div id="menu">
  <h3><?php echo $story ?></h3>
  <?php echo link_to('&laquo; Back to story', 'story_show', $story) ?>
  <br />
  <br />
  <?php if(count($tasks) > 0) : ?>
  <h3>Available Tasks</h3>
  <ul>
    <?php foreach ($tasks as $task): ?>
    <li>
      <?php echo link_to($task, 'task_show', $task) ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <br />
  <?php endif; ?>
  <?php echo link_to('Add a new task', '@task_new?story_id=' . $story->getId()) ?>

</div>
