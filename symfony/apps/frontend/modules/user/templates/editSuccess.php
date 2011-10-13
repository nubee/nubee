<h1>
  Edit User: <?php echo $user->getFullName() ?> (<?php echo $user->getUsername() ?>)
</h1>

<?php include_partial('form', array('form' => $form)) ?>
