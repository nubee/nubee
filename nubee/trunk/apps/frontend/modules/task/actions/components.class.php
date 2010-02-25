<?php

class taskComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->tasks = Doctrine::getTable('Task')->findByStoryId($this->story->getId());
  }
}
