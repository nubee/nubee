<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Project extends BaseProject
{
  public function formatName($showComplete) {
    $name = $this->getName();
    
    if($showComplete)
      return sprintf('%s - %s', $this->getProduct()->formatName($showComplete), $name);
    
    return $name;
  }
  
  public function hasMembers() {
    return $this->getMembers()->count() > 0;
  }  
  
  public function getStories()
  {
    return Doctrine::getTable('Story')->findByProject($this);
  }

  public function getTasks()
  {
    return Doctrine::getTable('Task')->findByProject($this);
  }

  public function countBacklogTasks()
  {
    return $this->getBacklogTasks()->count();
  }

  public function countTasks()
  {
    return Doctrine::getTable('Task')->countByProject($this);
  }

  public function countAvailableTasks()
  {
    return Doctrine::getTable('Task')->countAvailableByProject($this);
  }

  public function isEnabled()
  {
    if($this->getStatus() == 'enabled')
      return true;

    return false;
  }

  public function isDisabled()
  {
    if($this->getStatus() == 'disabled')
      return true;

    return false;
  }
  
  public function getEffortLeft() {
    $timestamp = 0;
    foreach($this->getTasks() as $task)
      $timestamp += $task->getEffortLeft();
    return $timestamp;
  }

  public function getOriginalEstimate() {
    $timestamp = 0;
    foreach($this->getTasks() as $task)
      $timestamp += $task->getOriginalEstimate();
    return $timestamp;
  }

  public function getCurrentEstimate() {
    $timestamp = 0;
    foreach($this->getTasks() as $task)
      $timestamp += $task->getCurrentEstimate();
    return $timestamp;
  }

  public function getEffortSpent() {
    $timestamp = 0;
    foreach($this->getTasks() as $task)
      $timestamp += $task->getEffortSpent();
    return $timestamp;
  }  
  
  public function getStartDate() {
    $date = null;
    
    foreach($this->getIterations() as $iteration) {
      $startDate = strtotime($iteration->getStartDate());
      
      if(!$date || $date > $startDate)
        $date = $startDate;
    }
    
    return date('Y-m-d', $date);
  }
  
  public function getEndDate() {
    $date = null;
    
    foreach($this->getIterations() as $iteration) {
      $endDate = strtotime($iteration->getEndDate());
      
      if(!$date || $date <= $endDate)
        $date = $endDate;
    }
    
    return date('Y-m-d', $date);
  }

}