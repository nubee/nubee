<div id="menu">
  <h3><?php echo $project ?></h3>
  <?php echo link_to('&laquo; Back to project', 'project_show', $project) ?>
  <br />
  <br />
  <h3>Iterations</h3>
  <ul>
    <?php foreach ($iterations as $iteration): ?>
    <li>
      <?php echo link_to($iteration, 'iteration_show', $iteration) ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <br />
  <?php echo link_to('Add a new iteration', '@iteration_new?project_id=' . $project->getId()) ?>

</div>
