<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('iteration' => $iteration)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('iteration', 'leftMenu', array('project' => $iteration->getProject())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    Iteration: <?php echo $iteration->getName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'iteration_edit', $iteration) ?>
      &nbsp;
      <?php echo delete_link_to2('Delete', 'iteration_delete', $iteration) ?>
    </span>
  </h1>
</div>

<div class="section">
  <?php echo format_text($iteration->getDescription()) ?>
</div>

<?php include_partial('content/effortChart', array('id' => 'chart', 'item' => $iteration, 'children' => $iteration->getStories(), 'length' => 60*8)) ?>

<div class="section">
  <h2>
    Details
  </h2>
  <table class="details">
    <tr>
      <th>Manager</th>
      <td><?php echo link_to($iteration->getManager(), 'user_show', $iteration->getManager()) ?></td>
    </tr>
    <tr>
      <th>Start date</th>
      <td><?php echo format_date($iteration->getStartDate(), 'dd/M/yyyy') ?></td>
    </tr>
    <tr>
      <th>End date</th>
      <td><?php echo format_date($iteration->getEndDate(), 'dd/M/yyyy') ?></td>
    </tr>
    <tr>
      <th>Original estimate</th>
      <td><?php echo format_timestamp($iteration->getOriginalEstimate(), 'd') ?></td>
    </tr>
    <tr>
      <th>Current estimate</th>
      <td class="<?php echo get_estimate_class($iteration) ?>"><?php echo format_timestamp($iteration->getCurrentEstimate(), 'd') ?></td>
    </tr>
    <tr>
      <th>Effort spent</th>
      <td><?php echo format_timestamp($iteration->getEffortSpent(), 'd') ?></td>
    </tr>
    <tr>
      <th>Effort left</th>
      <td><?php echo format_timestamp($iteration->getEffortLeft(), 'd') ?></td>
    </tr>
    <tr>
      <th>Number of stories</th>
      <td>
        <?php echo $iteration->getStories()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of left tasks</th>
      <td>
        <?php echo __('%available% of %total%', array(
          '%available%' => $iteration->countAvailableTasks(),
          '%total%' => $iteration->countTasks()
        )) ?>
      </td>
    </tr>
    <tr>
      <th>Members</th>
      <td>
        <ul>
          <?php if($iteration->hasMembers()) : ?>
          <?php foreach($iteration->getMembers() as $user) : ?>
          <li><?php echo link_to($user, 'user_show', $user) ?></li>
          <?php endforeach; ?>
          <?php else : ?>
          No members assigned to this project
          <?php endif; ?>
      </td>
    </tr>    
  </table>
</div>

<div class="clear"></div>

<div class="section">
  <h2>
    Stories
    <span class="actions">
      <?php echo add_link_to2('Add', '@story_new?iteration_id=' . $iteration->getId()) ?>
    </span>
  </h2>
  <?php include_partial('story/list', array('stories' => $iteration->getStories())); ?>
</div>
