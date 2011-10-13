<?php

/**
 * team actions.
 *
 * @package    nubee
 * @subpackage team
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class teamActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->teams = Doctrine::getTable('Team')->findAll();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->team = Doctrine::getTable('Team')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->team);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TeamForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new TeamForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($team = Doctrine::getTable('Team')->find(array($request->getParameter('id'))), sprintf('Object team does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new TeamForm($team);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($team = Doctrine::getTable('Team')->find(array($request->getParameter('id'))), sprintf('Object team does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new TeamForm($team);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($team = Doctrine::getTable('Team')->find(array($request->getParameter('id'))), sprintf('Object team does not exist (%s).', array($request->getParameter('id'))));
    $team->delete();

    $this->redirect('@team');
  }

  public function executeAddUser(sfWebRequest $request)
  {
    $user = Doctrine::getTable('sfGuardUser')->find($request->getParameter('userId'));
    $this->forward404Unless($user);

    $this->team = $this->getRoute()->getObject();
    $this->team->addUser($user);

    $this->getUser()->setFlash('notice', 'User added successfully.');
    $this->redirect('@team_show?id=' . $this->team->getId());
  }

  public function executeRemoveUser(sfWebRequest $request)
  {
    $user = Doctrine::getTable('sfGuardUser')->find($request->getParameter('userId'));
    $this->forward404Unless($user);

    $this->team = $this->getRoute()->getObject();
    $this->team->removeUser($user);

    $this->getUser()->setFlash('notice', 'User removed successfully.');
    $this->redirect('@team_show?id=' . $this->team->getId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $team = $form->save();

      $this->redirect('@team');
    }
  }
}
