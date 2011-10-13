<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Project extends BaseProject
{
  public function getStories() {
    return Doctrine::getTable('Story')->findByProject($this);
  }

  public function getTasks() {
    return Doctrine::getTable('Task')->findByProject($this);
  }

  public function countBacklogTasks() {
    return $this->getBacklogTasks()->count();
  }

  public function isEnabled() {
    if($this->getStatus() == 'enabled')
      return true;

    return false;
  }

  public function isDisabled() {
    if($this->getStatus() == 'disabled')
      return true;

    return false;
  }

}