<?php if($stories->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="left width40">Name</th>
      <th class="center width10">Priority</th>
      <th class="center width10">Tasks</th>
      <th class="center width5">OE</th>
      <th class="center width5">CE</th>
      <th class="center width5">EL</th>
      <th class="center width5">ES</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($stories as $i => $story): ?>
      <tr class="<?php echo ($story->countAvailableTasks() == 0 ? 'done' : '') ?>">
        <td class="left"><?php echo link_to($story->formatName(isset($showCompleteName) && $showCompleteName), 'story_show', $story) ?></td>
        <td class="center"><?php echo format_priority($story->getPriority()) ?></td>
        <td class="center">
          <span class="progressbar" id="pb<?php echo $story->getId() ?>">
            <?php
              $total = $story->countTasks();
              $available = $story->countAvailableTasks();
              echo (($total - $available)/ $total) * 100;
            ?>
          </span>
        </td>
        <td class="center"><?php echo format_timestamp($story->getOriginalEstimate(), 'd') ?></td>
        <td class="center <?php echo get_estimate_class($story) ?>"><?php echo format_timestamp($story->getCurrentEstimate(), 'd') ?></td>
        <td class="center"><?php echo format_timestamp($story->getEffortLeft(), 'd') ?></td>
        <td class="center"><?php echo format_timestamp($story->getEffortSpent(), 'd') ?></td>
        <td class="center">
          <?php echo edit_link_to('story_edit', $story) ?>
          <?php echo delete_link_to('story_delete', $story) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No stories yet') ?>
<?php endif; ?>

<script type="text/javascript">
  $().ready(function() {
    $('.progressbar').each(function() {
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