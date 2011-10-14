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
    unset(
      $this['algorithm'], 
      $this['salt'], 
      $this['last_login'], 
      $this['created_at'], 
      $this['updated_at']
    );

    $user = sfContext::getInstance()->getUser();
    
    if(!$user->isSuperAdmin())
      unset($this['is_super_admin']);

    if(!$user->isAdministrator()) {
      unset($this['is_active'], $this['is_super_admin'], $this['groups_list'], $this['permissions_list']);
    }
    else {
      $this->widgetSchema['groups_list']->setLabel('Groups');
      $this->widgetSchema['permissions_list']->setLabel('Permissions');
    }
    
    if(!$user->isManager()) {
      unset($this['teams_list']);
    }
    else {
      $this->widgetSchema['teams_list']->setLabel('Teams');
    }

    if(!$this->isNew()) {
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
    
    if($this->isNew()) {
      $this->widgetSchema->moveField('username', sfWidgetFormSchema::FIRST);
      $this->widgetSchema->moveField('password', sfWidgetFormSchema::AFTER, 'username');
      $this->widgetSchema->moveField('confirm_password', sfWidgetFormSchema::AFTER, 'password');
    }
    
    $this->widgetSchema['first_name']->setAttribute('class', 'width200f');
    $this->widgetSchema['last_name']->setAttribute('class', 'width200f');
    $this->widgetSchema['email_address']->setAttribute('class', 'width200f');
//    $this->widgetSchema['password']->setAttribute('class', 'width200f');
//    $this->widgetSchema['confirm_password']->setAttribute('class', 'width200f');

    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('confirm_password', sfValidatorSchemaCompare::EQUAL, 'password'));
    
    $this->embedRelation('Profile');
  }
}