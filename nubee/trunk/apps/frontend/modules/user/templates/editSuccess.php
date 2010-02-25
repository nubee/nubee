<h1>
  Edit User: <?php echo $userProfile->getFullName() ?> (<?php echo $userProfile->getUsername() ?>)
</h1>

<?php include_partial('form', array('form' => $form)) ?>
