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
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td colspan="8">
        <ul class="story">
          <li>
            <table style="width: 100%">
              <tr>
                <td class="left width40"><?php echo link_to($story, 'story_show', $story) ?></td>
                <td class="center width10"><?php echo format_priority($story->getPriority()) ?></td>
                <td class="center width10"><?php echo $story->getTasks()->count() ?></td>
                <td class="center width5"><?php echo format_timestamp($story->getOriginalEstimate()) ?></td>
                <td class="center width5"><?php echo format_timestamp($story->getCurrentEstimate()) ?></td>
                <td class="center width5"><?php echo format_timestamp($story->getEffortLeft()) ?></td>
                <td class="center width5"><?php echo format_timestamp($story->getEffortSpent()) ?></td>
                <td class="center width5">
                  <?php echo edit_link_to('story_edit', $story) ?>
                  <?php echo delete_link_to('story_delete', $story) ?>
                </td>
              </tr>
            </table>
            <ul>
                <?php foreach($story->getTasks() as $i => $task) : ?>
              <li>
                <table style="width: 100%">
                  <tr class="<?php echo $task->getStatus() ?>">
                    <td class="left" colspan="8"><?php echo link_to($task, 'task_show', $task) ?></td>
                  </tr>
                </table>
              </li>
                <?php endforeach; ?>
            </ul>
          </li>
        </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No stories yet') ?>
<?php endif; ?>


<script type="text/javascript">
$(document).ready(function(){
	$(".story").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "cookie"
  });
});
</script>