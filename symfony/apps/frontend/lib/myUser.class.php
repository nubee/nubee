<?php

//class myUser extends bhLDAPAuthSecurityUser
class myUser extends sfGuardSecurityUser
{
  public function getFullName()
  {
    return $this->getUserProfile()->getFullName();
  }

  public function getId()
  {
    return $this->getGuardUser()->getId();
  }

  public function getUserProfile()
  {
    return $this->getGuardUser()->getUserProfile();
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
