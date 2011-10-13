<?php use_stylesheet('list') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs') ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('team', 'leftMenu') ?>
<?php end_slot() ?>

<div class="section">
  <h2>
    Teams
    <span class="actions">
      <?php echo add_link_to2('Add', '@team_new') ?>
    </span>
  </h2>

  <?php if($teams->count() > 0) : ?>
  <table class="list">
    <thead>
      <tr>
        <th class="width45">Name</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($teams as $team): ?>
      <tr>
        <td><?php echo link_to($team, 'team_show', $team) ?></td>
        <td class="center">
          <?php echo edit_link_to('team_edit', $team) ?>
          <?php echo delete_link_to('team_delete', $team) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else : ?>
    <?php echo __('No teams yet') ?>
  <?php endif; ?>
</div>