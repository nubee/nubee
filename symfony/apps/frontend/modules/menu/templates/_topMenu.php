<div id="topMenu">
  <?php if($sf_user->isAuthenticated()) : ?>
    <ul style="float:right">
      <li>Welcome, <span class="strong"><?php echo $sf_user->getFullName() ?></span></li>
      <li>|</li>
      <li><?php echo link_to('Edit profile', 'user_edit', $sf_user->getGuardUser()) ?></li>
      <li>|</li>
      <li><?php echo link_to('Logout', '@logout') ?></li>
    </ul>
  <?php endif; ?>
  <ul>
    <?php if($sf_user->isAuthenticated()) : ?>
      <li><?php echo link_to('Dashboard', '@homepage') ?></li>
      <li>|</li>
      <li><?php echo link_to('Products', '@product') ?></li>
      <?php if($sf_user->hasCredential('Administrator')) : ?>
        <li>|</li>
        <li><?php echo link_to('Teams', '@team') ?></li>
        <li>|</li>
        <li><?php echo link_to('Users', '@user') ?></li>
      <?php endif; ?>
    <?php else: ?>
      <li><?php echo link_to('Login', '@login') ?></li>
    <?php endif; ?>
    <li>|</li>
    <li><?php echo link_to('Documentation', '@docs') ?></li>
  </ul>
</div>
