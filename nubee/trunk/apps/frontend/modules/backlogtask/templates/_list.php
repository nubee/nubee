<?php if($tasks->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="width40">Name</th>
      <th class="center width10">Priority</th>
      <th class="center width10">E</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tasks as $i => $task): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td><?php echo link_to($task, 'backlogtask_show', $task) ?></td>
      <td class="center"><?php echo format_priority($task->getPriority()) ?></td>
      <td class="center"><?php echo format_timestamp($task->getEstimate()) ?></td>
      <td class="center">
        <?php echo edit_link_to('backlogtask_edit', $task) ?>
        <?php echo delete_link_to('backlogtask_delete', $task) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No tasks yet') ?>
<?php endif; ?>