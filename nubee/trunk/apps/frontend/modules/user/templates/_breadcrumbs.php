<div class="breadcrumbs">
  <?php if(isset($user)) : ?>
    <?php echo link_to('Users', 'user') ?> :
    <?php echo ($user->isNew() ? 'New user' : $user->getFullName()) ?>
  <?php else : ?>
    <?php echo 'Users' ?>
  <?php endif; ?>
</div>