<?php

class storyComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->stories = Doctrine::getTable('Story')->findByIterationId($this->iteration->getId());
  }
}
