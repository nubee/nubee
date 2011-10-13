<?php use_stylesheet('list') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs') ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('user', 'leftMenu') ?>
<?php end_slot() ?>

<div class="section">
  <h2>
    Users
    <span class="actions">
      <?php echo add_link_to2('Add', '@user_new') ?>
    </span>
  </h2>

  <?php if($users->count() > 0) : ?>
  <table class="list">
    <thead>
      <tr>
        <th class="width15">Username</th>
        <th class="width15">Full Name</th>
        <th class="left width55">Email</th>
        <th class="left width20">Teams</th>
        <th class="left width20">Groups</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
      <tr>
        <td><?php echo link_to($user->getUsername(), 'user_show', $user) ?></td>
        <td><?php echo link_to($user->getFullName(), 'user_show', $user) ?></td>
        <td class="left"><?php echo $user->getEmailAddress() ?></td>
        <td class="left">
          <?php foreach($user->getTeams() as $team) : ?>
            <?php echo $team; ?>
          <?php endforeach ?>
        </td>
        <td class="left">
          <?php foreach($user->getGroups() as $group) : ?>
            <?php echo $group; ?>
          <?php endforeach ?>
        </td>
        <td class="center">
          <?php echo edit_link_to('user_edit', $user) ?>
          <?php echo delete_link_to('user_delete', $user) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else : ?>
    <?php echo __('No users yet') ?>
  <?php endif; ?>
</div>