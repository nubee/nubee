<?php use_stylesheet('list') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs') ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('user', 'leftMenu') ?>
<?php end_slot() ?>

<div class="section">
  <div class="actions">
    <?php echo add_link_to2('Add', '@user_new') ?>
  </div>
  <h2>
    Users
  </h2>

  <?php if($userProfiles->count() > 0) : ?>
  <table class="list">
    <thead>
      <tr>
        <th class="width15">Username</th>
        <th class="width15">Full Name</th>
        <th class="left width55">Email</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($userProfiles as $userProfile): ?>
      <tr>
        <td><?php echo link_to($userProfile->getUsername(), 'user_show', $userProfile) ?></td>
        <td><?php echo link_to($userProfile->getFullName(), 'user_show', $userProfile) ?></td>
        <td class="left"><?php echo $userProfile->getEmail() ?></td>
        <td class="center">
          <?php echo edit_link_to('user_edit', $userProfile) ?>
          <?php echo delete_link_to('user_delete', $userProfile) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else : ?>
    <?php echo __('No users yet') ?>
  <?php endif; ?>
</div>