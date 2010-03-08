<?php

class teamComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->teams = Doctrine::getTable('Team')->findAll();
  }
}
