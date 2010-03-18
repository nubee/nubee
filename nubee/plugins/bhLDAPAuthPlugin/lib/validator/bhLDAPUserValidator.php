<?php

/* $Id: bhLDAPUserValidator.php 19104 2009-06-09 21:33:32Z Nathan.Vonnahme $ */
/* $URL: http://svn.symfony-project.com/plugins/bhLDAPAuthPlugin/branches/1.2_Doctrine/lib/validator/bhLDAPUserValidator.php $ */

class bhLDAPUserValidator extends sfGuardValidatorUser
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('username_field', 'username');
    $this->addOption('password_field', 'password');
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'The username and/or password is invalid.');
  }

  protected function doClean($values)
  {
    $username = isset($values[$this->getOption('username_field')]) ? $values[$this->getOption('username_field')] : '';
    bhLDAP::debug ('######## Username: ' . $username);
    $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';

    bhLDAP::debug ('######## User exists?');

    $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($username);
//    bhLDAP::debugDump($user, "user:");

    if (!$user) 
    {
      if(bhLDAP::checkPassword($username, $password)) {
        // pretend the user exists, then check AD password
        bhLDAP::debug('######## User does not exist. Creating dummy user.');
        $user = new sfGuardUser();
        $user->setUsername($username);
        $user->setSalt('unused');
        $user->setPassword('unused');
        $user->setUserProfile(new UserProfile());
        $user->save();
      }

      return array_merge($values, array('user' => $user));
    }

    // password is ok?
    bhLDAP::debug('######## Checking Password...');
    if ($user->checkPassword($password))
    {
      bhLDAP::debug('######## Check Password successful...');
      return array_merge($values, array('user' => $user));
    }

    bhLDAP::debug('######## Check Password failed...');

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
  }
}