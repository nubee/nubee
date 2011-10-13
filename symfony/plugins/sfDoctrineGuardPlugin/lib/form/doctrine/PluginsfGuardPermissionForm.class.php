<?php

/**
 * PluginsfGuardPermission form.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardPermissionForm.class.php 31270 2010-10-28 14:54:48Z Kris.Wallsmith $
 */
abstract class PluginsfGuardPermissionForm extends BasesfGuardPermissionForm
{
  /**
   * @see sfForm
   */
  protected function setupInheritance()
  {
    parent::setupInheritance();

    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['groups_list']->setLabel('Groups');
    $this->widgetSchema['users_list']->setLabel('Users');
  }
}
