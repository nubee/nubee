<?php

class backlogtaskComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->tasks = Doctrine::getTable('BacklogTask')->findByProjectId($this->project->getId());
  }
}
