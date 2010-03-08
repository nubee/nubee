<?php if($stories->count() > 0) : ?>

<div id="treecontrol">
  <a title="Collapse the entire tree below" href="#"><img src="/images/minus.gif" alt="collapse" /> Collapse All</a>
  <a title="Expand the entire tree below" href="#"><img src="/images/plus.gif" alt="expand"/> Expand All</a>
  <a title="Toggle the tree below, opening closed branches, closing open branches" href="#">Toggle All</a>
</div>

<ul id="stories">
  <?php foreach ($stories as $i => $story): ?>
  <li><?php echo link_to($story, 'story_show', $story) ?>
    <ul>
      <?php foreach($story->getTasks() as $i => $task) : ?>
      <li>
        <span><?php echo link_to($task, 'task_show', $task) ?></span>
      </li>
      <?php endforeach; ?>
    </ul>
  </li>
  <?php endforeach; ?>
</ul>
<?php else : ?>
  <?php echo __('No stories yet') ?>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#stories").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "stories"
	});
});
</script>