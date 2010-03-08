<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Iteration extends BaseIteration
{
  public function getProduct() {
    return $this->getProject()->getProduct();
  }

  public function getTasks() {
    return Doctrine::getTable('Task')->findByIteration($this);
  }

  public function countTasks() {
    return Doctrine::getTable('Task')->countByIteration($this);
  }

  public function countAvailableTasks() {
    return Doctrine::getTable('Task')->countAvailableByIteration($this);
  }

  public function getStories() {
    return Doctrine::getTable('Story')->findByIteration($this);
  }
}