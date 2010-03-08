<?php use_stylesheet('details') ?>
<?php use_stylesheet('list') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('team' => $team)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('team', 'leftMenu') ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <div class="actions">
    <?php echo edit_link_to2('Edit', 'team_edit', $team) ?>
  </div>
  <h1>
    Team: <?php echo $team ?>
  </h1>
</div>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tbody>
      <tr>
        <th>Number of users:</th>
        <td><?php echo $team->getUsers()->count() ?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="section">
  <h2>Users</h2>
  <?php if($team->getUsers()->count() > 0) : ?>
  <table class="list">
    <thead>
      <tr>
        <th class="width15">Name</th>
        <th class="width45">Role</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($team->getUsers() as $user): ?>
      <tr>
        <td><?php echo link_to($user->getUsername(), 'user_show', $user) ?></td>
        <td><?php echo $user->getGroups()->get(0) ?></td>
        <td class="center">
          <?php echo link_to(image_tag('icons/delete.png'),
            '@team_removeUser?id=' . $team->getId() . '&userId=' . $user->getId(),
            array('method' => 'put', 'confirm' => 'Are you sure?')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else : ?>
    <?php echo __('No users yet') ?>
  <?php endif; ?>
</div>

<?php if($team->getAvailableUsers()->count() > 0) : ?>
<div class="section">
  <h2>Available Users</h2>
  <table class="list">
    <thead>
      <tr>
        <th class="width15">Name</th>
        <th class="width45">Role</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($team->getAvailableUsers() as $user): ?>
      <tr>
        <td><?php echo link_to($user->getUsername(), 'user_show', $user) ?></td>
        <td><?php echo $user->getGroups()->get(0) ?></td>
        <td class="center">
          <?php echo link_to(image_tag('icons/add.png'),
            '@team_addUser?id=' . $team->getId() . '&userId=' . $user->getId(),
            array('method' => 'put')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>
