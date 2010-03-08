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
}
