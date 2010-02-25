<div id="menu">
  <h1><?php echo $project ?></h1>
  <?php echo link_to('&laquo; Back to project', 'project_show', $project) ?>
  <br />
  <br />
  <h2>Backlog Tasks</h2>
  <ul>
    <?php foreach ($tasks as $task): ?>
    <li>
      <?php echo link_to($task, 'backlogtask_show', $task) ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <br />
  <?php echo link_to('Add a new backlog task', '@backlogtask_new?project_id=' . $project->getId()) ?>

</div>
