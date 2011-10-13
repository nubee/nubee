<?php
/**
 */
class PluginsfGuardForgotPasswordTable extends Doctrine_Table
{
  /**
   * Delete records for a given user
   *
   * @param object $user The user object
   *
   * @return void
   */
  public function deleteByUser($user)
  {
    $this->createQuery('p')
      ->delete()
      ->where('p.user_id = ?', $user->id)
      ->execute();
  }
}