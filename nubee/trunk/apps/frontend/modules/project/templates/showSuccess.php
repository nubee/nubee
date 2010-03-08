<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('project' => $project)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('project', 'leftMenu', array('product' => $project->getProduct())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <div class="actions">
    <?php echo edit_link_to2('Edit', 'project_edit', $project) ?>
    &nbsp;
    <?php echo delete_link_to2('Delete', 'project_delete', $project) ?>
  </div>
  <h1>
    Project: <?php echo $project->getName() ?>
  </h1>
</div>

<div class="section">
  <?php echo format_text($project->getDescription()) ?>
</div>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tr>
      <th>Number of iterations</th>
      <td>
        <?php echo $project->getIterations()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of stories</th>
      <td>
        <?php echo $project->getStories()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of tasks</th>
      <td>
        <?php echo $project->getTasks()->count() ?>
      </td>
    </tr>
  </table>
</div>

<div class="section">
  <div class="actions">
    <?php echo add_link_to2('Add iteration', '@iteration_new?project_id=' . $project->getId()) ?>
  </div>
  <h2>
    Iterations
  </h2>

  <?php include_partial('iteration/list', array('iterations' => $project->getIterations())) ?>
</div>

<div class="section">
  <div class="actions">
    <?php echo add_link_to2('Add task', '@backlogtask_new?project_id=' . $project->getId()) ?>
  </div>
  <h2>
    Backlog
  </h2>

  <?php include_partial('backlogtask/list', array('tasks' => $project->getBacklogTasks())) ?>
</div>

