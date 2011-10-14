<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('story' => $story)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('story', 'leftMenu', array('iteration' => $story->getIteration())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    Story: <?php echo $story->getName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'story_edit', $story) ?>
      &nbsp;
      <?php echo delete_link_to2('Delete', 'story_delete', $story) ?>
    </span>
  </h1>
</div>

<div class="section">
  <?php echo format_text($story->getDescription()) ?>
</div>

<div id="chart_box" style="width:600px;float: right;margin-bottom: 20px;">
  <div id="chart" ></div>
</div>

<?php include_partial('content/effortChart', array('item' => $story, 'children' => $story->getTasks())) ?>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tr>
      <th>Priority</th>
      <td><?php echo format_priority($story->getPriority()) ?></td>
    </tr>
    <tr>
      <th>Original estimate</th>
      <td><?php echo format_timestamp($story->getOriginalEstimate()) ?></td>
    </tr>
    <tr>
      <th>Current estimate</th>
      <td class="<?php echo get_estimate_class($story) ?>"><?php echo format_timestamp($story->getCurrentEstimate()) ?></td>
    </tr>
    <tr>
      <th>Effort spent</th>
      <td><?php echo format_timestamp($story->getEffortSpent()) ?></td>
    </tr>
    <tr>
      <th>Effort left</th>
      <td><?php echo format_timestamp($story->getEffortLeft()) ?></td>
    </tr>
    <tr>
      <th>Number of left tasks</th>
      <td>
        <?php echo __('%available% of %total%', array(
          '%available%' => $story->countAvailableTasks(),
          '%total%' => $story->countTasks()
        )) ?>
      </td>
    </tr>    
  </table>
</div>

<div class="clear"></div>

<div class="section">
  <h2>
    Tasks
    <span class="actions">
      <?php echo add_link_to2('Add', '@task_new?story_id=' . $story->getId()) ?>
    </span>
  </h2>

  <?php include_partial('task/list', Array('tasks' => $story->getTasks())) ?>
</div>
