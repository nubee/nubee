<?php
/**
 * E-mail template used when password was changed
 *
 * @param sfGuardUser $user     the sfGuardUser object
 * @param string      $password plain password
 */
?>
<?php use_helper('I18N') ?>
<?php echo __('Hi %first_name%', array('%first_name%' => $user->getFirstName()), 'sf_guard') ?>,

<?php echo __('Below you will find your username and new password:', null, 'sf_guard') ?>

<?php echo __('Username', null, 'sf_guard') ?>: <?php echo $user->getUsername() ?> 

<?php echo __('Password', null, 'sf_guard') ?>: <?php echo $password ?>