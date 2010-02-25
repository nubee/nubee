<?php

/**
 * task actions.
 *
 * @package    nubee
 * @subpackage task
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class taskActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->task = Doctrine::getTable('Task')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->task);

    $workingUnit = new WorkingUnit();
    $workingUnit->setTaskId($this->task->getId());
    $this->form = new WorkingUnitForm($workingUnit);
  }

  public function executeNew(sfWebRequest $request)
  {
    $story = Doctrine::getTable('Story')->find($request->getParameter('story_id'));
    $task = new Task();
    $task->setStoryId($story);
    $this->form = new TaskForm($task);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $story = Doctrine::getTable('Story')->find($request->getParameter('story_id'));
    $task = new Task();
    $task->setStoryId($story);
    $this->form = new TaskForm($task);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($task = Doctrine::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new TaskForm($task);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($task = Doctrine::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new TaskForm($task);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($task = Doctrine::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', array($request->getParameter('id'))));
    $task->delete();

    $this->redirect('@story_show?id=' . $task->getStory()->getId());
  }

  public function executeAddWorkingUnit(sfWebRequest $request)
  {
    $form = new WorkingUnitForm();
    $form->bind($request->getParameter($form->getName()));

    $this->task = Doctrine::getTable('Task')->find($form->getValue('task_id'));
    $this->forward404Unless($this->task);
    
    if($form->isValid()) {
      $workingUnit = $form->updateObject();
      $workingUnit->setUserId($this->getUser()->getId());
      $workingUnit->save();

      $this->redirect($this->generateUrl('task_show', $this->task));
    }

    $this->form = $form;
    $this->setTemplate('show');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $task = $form->save();

      $this->redirect('@task_show?id='.$task->getId());
    }
  }
}
