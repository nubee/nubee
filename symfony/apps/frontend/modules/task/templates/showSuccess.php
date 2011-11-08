<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('task' => $task)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('task', 'leftMenu', array('story' => $task->getStory())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    Task: <?php echo $task->getName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'task_edit', $task) ?>
      &nbsp;
      <?php echo delete_link_to2('Delete', 'task_delete', $task) ?>
    </span>
  </h1>
</div>

<div class="section">
  <?php echo format_text($task->getDescription()) ?>
</div>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tbody>
      <tr>
        <th>Status</th>
        <td><?php echo $task->formatStatus() ?></td>
      </tr>
      <tr>
        <th>Priority</th>
        <td><?php echo format_priority($task->getPriority()) ?></td>
      </tr>
      <tr>
        <th>Original estimate</th>
        <td><?php echo format_timestamp($task->getOriginalEstimate(), 'h') ?></td>
      </tr>
      <tr>
        <th>Current estimate</th>
        <td class="<?php echo get_estimate_class($task) ?>"><?php echo format_timestamp($task->getCurrentEstimate(), 'h') ?></td>
      </tr>
      <tr>
        <th>Effort spent</th>
        <td><?php echo format_timestamp($task->getEffortSpent(), 'h') ?></td>
      </tr>
      <tr>
        <th>Effort left</th>
        <td><?php echo format_timestamp($task->getEffortLeft(), 'h') ?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="section">
  <h2>
    Working Units
  </h2>

  <?php if($task->getCurrentEstimate() == 0) : ?>
    <div class="warning">Task estimate is 0:00</div>
  <?php else : ?>
    <?php include_partial('workingunit/list', array('workingUnits' => $task->getWorkingUnits())) ?>
  <?php endif; ?>
</div>

<?php if(!$task->isDone()) : ?>
<div class="section">
  <?php include_partial('workingunit/form', array('task' => $task, 'form' => $form)) ?>
</div>
<?php endif; ?>
