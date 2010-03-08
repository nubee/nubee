<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('iteration' => $iteration)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('iteration', 'leftMenu', array('project' => $iteration->getProject())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <div class="actions">
    <?php echo edit_link_to2('Edit', 'iteration_edit', $iteration) ?>
    &nbsp;
    <?php echo delete_link_to2('Delete', 'iteration_delete', $iteration) ?>
  </div>
  <h1>
    Iteration: <?php echo $iteration->getName() ?>
  </h1>
</div>

<div class="section">
  <?php echo format_text($iteration->getDescription()) ?>
</div>

<div class="section">
  <h2>
    Details
  </h2>
  <table class="details">
    <tr>
      <th>Number of stories</th>
      <td>
        <?php echo $iteration->getStories()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of tasks</th>
      <td>
        <?php echo __('%available% of %total%', array(
          '%available%' => $iteration->countAvailableTasks(),
          '%total%' => $iteration->countTasks()
        )) ?>
      </td>
    </tr>
  </table>
</div>

<div class="section">
  <div class="actions">
    <?php echo add_link_to2('Add', '@story_new?iteration_id=' . $iteration->getId()) ?>
  </div>
  <h2>
    Stories
  </h2>
  <?php include_partial('story/list', array('stories' => $iteration->getStories())); ?>
</div>
