<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('story' => $story)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('story', 'leftMenu', array('iteration' => $story->getIteration())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <div class="actions">
    <?php echo edit_link_to2('Edit', 'story_edit', $story) ?>
    &nbsp;
    <?php echo delete_link_to2('Delete', 'story_delete', $story) ?>
  </div>
  <h1>
    Story: <?php echo $story->getName() ?>
  </h1>
</div>

<div class="section">
  <?php echo $story->getDescription() ?>
</div>

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
      <td><?php echo format_timestamp($story->getCurrentEstimate()) ?></td>
    </tr>
    <tr>
      <th>Effort spent</th>
      <td><?php echo format_timestamp($story->getEffortSpent()) ?></td>
    </tr>
    <tr>
      <th>Effort left</th>
      <td><?php echo format_timestamp($story->getEffortLeft()) ?></td>
    </tr>
  </table>
</div>

<div class="section">
  <div class="actions">
    <?php echo add_link_to2('Add', '@task_new?story_id=' . $story->getId()) ?>
  </div>
  <h2>
    Tasks
  </h2>

  <?php include_partial('task/list', Array('tasks' => $story->getTasks())) ?>
</div>
