<?php if($projects->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="left width50">Name</th>
      <th class="center width10">Version</th>
      <th class="center width5">Status</th>
      <th class="center width10">Iterations</th>
      <th class="center width10">Stories</th>
      <th class="center width10">Tasks</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($projects as $i => $project): ?>
    <tr class="<?php echo (fmod($i, 2) ? 'even' : 'odd')
      . ($project->isDisabled() ? ' disabled'  : '') ?>">
      <td class="left"><?php echo link_to($project, 'project_show', $project) ?></td>
      <td class="center"><?php echo $project->getVersion() ?></td>
      <td class="center"><?php echo format_status($project->isEnabled()) ?></td>
      <td class="center"><?php echo $project->getIterations()->count() ?></td>
      <td class="center"><?php echo $project->getStories()->count() ?></td>
      <td class="center"><?php echo $project->getTasks()->count() ?></td>
      <td class="center">
        <?php echo edit_link_to('project_edit', $project) ?>
        <?php echo delete_link_to('project_delete', $project) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No projects yet') ?>
<?php endif; ?>
