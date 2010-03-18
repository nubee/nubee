<?php

/**
 * working_unit actions.
 *
 * @package    nubee
 * @subpackage working_unit
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class workingunitActions extends sfActions
{
  public function executeCreate(sfWebRequest $request)
  {
    $form = new WorkingUnitForm();
    $form->bind($request->getParameter($form->getName()));

    $task = Doctrine::getTable('Task')->find($form->getValue('task_id'));
    print_r($form->getValues());
    die();
    $this->forward404Unless($task);

    if($form->isValid()) {
      $workingUnit = $form->updateObject();
      $workingUnit->setUser($this->getUser()->getGuardUser());
      $task->addWorkingUnit($workingUnit);

      $this->redirect($this->generateUrl('task_show', $task));
    }

    $this->getUser()->setFlash('error', 'Can\'t add effort');
    $this->redirect($this->generateUrl('task_show', $task));
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $workingUnit = Doctrine::getTable('WorkingUnit')->find($request->getParameter('id'));
    $this->forward404Unless($workingUnit);
    $task = $workingUnit->getTask();
    $task->removeWorkingUnit($workingUnit);

    $this->redirect('@task_show?id=' . $task->getId());
  }
}
