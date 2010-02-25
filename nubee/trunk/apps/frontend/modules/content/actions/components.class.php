<?php

class contentComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->products = Doctrine::getTable('Product')->findAll();
    $this->teams = Doctrine::getTable('Team')->findAll();
    $this->users = Doctrine::getTable('sfGuardUser')->findAll();
  }
}
