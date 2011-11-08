<?php if($tasks->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="width55">Name</th>
      <th class="center width10">Status</th>
      <th class="center width15">Priority</th>
      <th class="center width5">OE</th>
      <th class="center width5">CE</th>
      <th class="center width5">EL</th>
      <th class="center width5">ES</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tasks as $i => $task): ?>
    <tr class="<?php echo ($task->getStatus() . ' ' . (fmod($i, 2) ? 'even' : 'odd')) ?>">
      <td class="left"><?php echo link_to($task, 'task_show', $task) ?></td>
      <td class="center">
        <span class="progressBar" id="pb<?php echo $task->getId() ?>">
          <?php
            $estimate = $task->getCurrentEstimate();
            $left = $task->getEffortLeft();

            echo ($estimate != 0 ? (($estimate - $left) / $estimate) * 100 : 0);
          ?>
        </span>
      </td>
      <td class="center"><?php echo format_priority($task->getPriority()) ?></td>
      <td class="center"><?php echo format_timestamp($task->getOriginalEstimate(), 'h') ?></td>
      <td class="center">
        <span class="<?php echo ($task->getCurrentEstimate() == 0 ? 'warning ' : '') ?><?php echo get_estimate_class($task) ?>">
          <?php echo format_timestamp($task->getCurrentEstimate(), 'h') ?>
        </span>
      </td>
      <td class="center"><?php echo format_timestamp($task->getEffortLeft(), 'h') ?></td>
      <td class="center"><?php echo format_timestamp($task->getEffortSpent(), 'h') ?></td>
      <td class="center">
        <?php echo edit_link_to('task_edit', $task) ?>
        <?php echo delete_link_to('task_delete', $task) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No tasks yet') ?>
<?php endif; ?>

<script type="text/javascript">
  $().ready(function() {
    $('.progressBar').each(function() {
      $(this).progressBar({
        showText: false,
        steps: 5,
        boxImage		: '/images/progressbar.gif',
        barImage		: {
          0:  '/images/progressbg_red.gif',
          30: '/images/progressbg_orange.gif',
          70: '/images/progressbg_green.gif'
        }
      });
    });
  });
</script>