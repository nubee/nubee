<?php

class userComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->users = Doctrine::getTable('UserProfile')->findAll();
  }
}
