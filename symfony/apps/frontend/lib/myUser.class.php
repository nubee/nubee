<?php

//class myUser extends bhLDAPAuthSecurityUser
class myUser extends sfGuardSecurityUser
{
  public function getFullName()
  {
    return $this->getGuardUser()->getFullName();
  }

  public function getId()
  {
    return $this->getGuardUser()->getId();
  }

  public function getProfile()
  {
    return $this->getGuardUser()->getProfile();
  }

  public function isAdministrator()
  {
    return $this->hasCredential('Administrator');
  }

  public function isManager()
  {
    return $this->isAdministrator() || $this->hasCredential('Manager');
  }

  public function isDeveloper()
  {
    return $this->isManager() || $this->hasCredential('Developer');
  }
}
