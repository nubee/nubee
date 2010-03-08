<?php

class projectComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->projects = Doctrine::getTable('Project')->findByProductId($this->product->getId());
  }
}
