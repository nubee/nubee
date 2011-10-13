<?php

class iterationComponents extends sfComponents
{
  public function executeLeftMenu(sfWebRequest $request)
  {
    $this->iterations = Doctrine::getTable('Iteration')->findByProjectId($this->project->getId());
  }
}
