<?php

/**
 * sfGuardUser form.
 *
 * @package    form
 * @subpackage sfGuardUser
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    unset($this['algorithm'], $this['salt'], 
      $this['last_login'], $this['created_at'], $this['updated_at']);

    $user = sfContext::getInstance()->getUser();
    if(!$user->isSuperAdmin())
      unset($this['is_super_admin']);

    if(!$user->isAdministrator())
      unset($this['is_super_admin'], $this['groups_list'], $this['permissions_list']);

    if($this->isNew()) {

    }
    else {
      unset($this['username']);
    }

    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['confirm_password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema->moveField('confirm_password', sfWidgetFormSchema::AFTER, 'password');

    $this->validatorSchema['password'] = new sfValidatorString(array(
      'max_length' => 255,
      'required' => false));
    $this->validatorSchema['confirm_password'] = new sfValidatorString(array(
      'max_length' => 255,
      'required' => false));

    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('confirm_password', sfValidatorSchemaCompare::EQUAL, 'password'));
  }
}