<?php

class backlogtaskActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->task = Doctrine::getTable('BacklogTask')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->task);
  }

  public function executeNew(sfWebRequest $request)
  {
    $project = Doctrine::getTable('Project')->find($request->getParameter('project_id'));
    $task = new BacklogTask();
    $task->setProject($project);
    $this->form = new BacklogTaskForm($task);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $project = Doctrine::getTable('Project')->find($request->getParameter('project_id'));
    $task = new BacklogTask();
    $task->setProject($project);
    $this->form = new BacklogTaskForm($task);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($task = Doctrine::getTable('BacklogTask')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new BacklogTaskForm($task);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($task = Doctrine::getTable('BacklogTask')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new BacklogTaskForm($task);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($task = Doctrine::getTable('BacklogTask')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', array($request->getParameter('id'))));
    $task->delete();

    $this->redirect($this->generateRoute('backlog_show', $task->getProject()));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $task = $form->save();

      $this->redirect('@backlogtask_show?id=' . $task->getId());
    }
  }
}
