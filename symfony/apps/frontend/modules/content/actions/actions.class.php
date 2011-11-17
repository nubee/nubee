<?php

/**
 * content actions.
 *
 * @package    nubee
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class contentActions extends sfActions
{
  public function executeHome(sfWebRequest $request)
  {
  }

  public function executeDashboard(sfWebRequest $request)
  {
    $this->projects = Doctrine::getTable('Project')->findMostActive(5);
    $this->stories = Doctrine::getTable('Story')->findMostActive($this->getUser()->getGuardUser(), 5);

    $this->myProjects = Doctrine::getTable('Project')->findMineUncomplete($this->getUser()->getGuardUser());
    $this->myTasks = Doctrine::getTable('Task')->findMineUncomplete($this->getUser()->getGuardUser());
  }
}
