<div id="menu">
<?php if(isset($user) && !$user->isNew()) : ?>
  <h3>User details</h3>
  <div id="picture">
    <?php echo image_tag($user->getPicture(), array('alt_title' => $user->getFullName())) ?>
  </div>
<?php else : ?>
  <h3>Users</h3>
  <table class="details">
    <tbody>
      <tr>
        <th>Number of users:</th>
        <td><?php echo $users->count() ?></td>
      </tr>
    </tbody>
  </table>
<?php endif; ?>
</div>
