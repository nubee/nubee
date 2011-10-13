<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>
<?php use_stylesheet('user') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('user' => $user)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('user', 'leftMenu', array('user' => $user)) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    User: <?php echo $user->getFullName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'user_edit', $user) ?>
    </span>
  </h1>
</div>

<div class="section">
  <h2>Details</h2>

  <div id="picture">
    <?php echo image_tag($user->getPicture(), array('alt_title' => $user->getFullName())) ?>
  </div>
  <table class="details">
    <tbody>
      <tr>
        <th>Username:</th>
        <td><?php echo $user->getUserName() ?></td>
      </tr>
      <tr>
        <th>First name:</th>
        <td><?php echo $user->getFirstName() ?></td>
      </tr>
      <tr>
        <th>Last name:</th>
        <td><?php echo $user->getLastName() ?></td>
      </tr>
      <tr>
        <th>Email:</th>
        <td><?php echo $user->getEmailAddress() ?></td>
      </tr>
      <tr>
        <th>Last login:</th>
        <td><?php echo $user->getLastLogin() ?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="section">
  <h2>Teams</h2>
  <?php if($user->getTeams()->count() > 0) : ?>
  <table class="list">
    <thead>
      <tr>
        <th class="width45">Name</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($user->getTeams() as $team): ?>
      <tr>
        <td><?php echo link_to($team, 'team_show', $team) ?></td>
        <td class="center">
          <?php echo link_to(image_tag('icons/delete.png'),
            '@user_removeTeam?id=' . $user->getId() . '&teamId=' . $team->getId(),
            array('method' => 'put', 'confirm' => 'Are you sure?')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else : ?>
    <?php echo __('No teams yet') ?>
  <?php endif; ?>
</div>

<?php if($user->getAvailableTeams()->count() > 0) : ?>
<div class="section">
  <h2>Available Teams</h2>
  <table class="list">
    <thead>
      <tr>
        <th class="width45">Name</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($user->getAvailableTeams() as $team): ?>
      <tr>
        <td><?php echo link_to($team, 'team_show', $team) ?></td>
        <td class="center">
          <?php echo link_to(image_tag('icons/add.png'),
            '@user_addTeam?id=' . $user->getId() . '&teamId=' . $team->getId(),
            array('method' => 'put')) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>
