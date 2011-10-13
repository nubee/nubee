<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('task' => $task)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('backlogtask', 'leftMenu', array('project' => $task->getProject())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <div class="actions">
    <?php echo edit_link_to2('Edit', 'backlogtask_edit', $task) ?>
    &nbsp;
    <?php echo delete_link_to2('Delete', 'backlogtask_delete', $task) ?>
  </div>
  <h1>
    Backlog Task: <?php echo $task->getName() ?>
  </h1>
</div>

<div class="section">
  <?php echo $task->getDescription() ?>
</div>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tbody>
      <tr>
        <th>Priority</th>
        <td><?php echo format_priority($task->getPriority()) ?></td>
      </tr>
      <tr>
        <th>Estimate</th>
        <td><?php echo format_timestamp($task->getEstimate()) ?></td>
      </tr>
    </tbody>
  </table>
</div>
