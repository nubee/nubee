<?php

class myUser extends bhLDAPAuthSecurityUser
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
