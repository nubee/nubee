<?php

class productComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->products = Doctrine::getTable('Product')->findAll();
  }
}
