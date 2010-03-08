<?php

class bhLDAPAuthSecurityUser extends sfGuardSecurityUser
{
  public function signIn($user, $remember = false, $con = null)
  {
    $return = parent::signIn($user, $remember, $con);
    bhLDAP::debug("########  hello bhLDAPAuthSecurityUser.class.php signIn()!");

    // signin
    # This either sets or overrides the parent::signIn function above
    #$this->setAttribute('user_id', $user->getId(), 'sfGuardSecurityUser');
    #$this->setAuthenticated(true);
    #$this->clearCredentials();
    #$this->addCredentials($user->getAllPermissionNames());

    bhLDAP::debug("######## bhLDAPAuthSecurityUser id: " . $user->getID());

    bhLDAP::debug("######## bhLDAPAuthSecurityUser Clearing Credentials...");
    $this->clearCredentials();

    bhLDAP::debug("######## bhLDAPAuthSecurityUser Fetching Credentials...");
    //bhLDAP::debugDump($user, "######## $user");
    $credentials = bhLDAP::getUserCredentials($user);

    bhLDAP::debug("######## bhLDAPAuthSecurityUser Adding Credentials...");
    $this->addCredentials($credentials);

    bhLDAP::debug("######## bhLDAPAuthSecurityUser return...");
//    die();
    return($return);
  }
}


