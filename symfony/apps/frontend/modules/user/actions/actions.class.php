<?php

/**
 * user actions.
 *
 * @package    nubee
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->users = Doctrine::getTable('sfGuardUser')->findAllOrdered();
  }

  public function executeShow(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $this->user = Doctrine::getTable('sfGuardUser')->find($id);
    $this->forward404Unless($this->user);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $this->user = Doctrine::getTable('sfGuardUser')->find($id);
    $this->forward404Unless($this->user);
    $this->form = new sfGuardUserForm($this->user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->user = Doctrine::getTable('sfGuardUser')->find($id);
    $this->forward404Unless($this->user);
    $this->form = new sfGuardUserForm($this->user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $id = $request->getParameter('id');
    $user = Doctrine::getTable('sfGuardUser')->find($id);

    $this->forward404Unless($user);
    $user->delete();

    $this->redirect('@user');
  }

  public function executeAddTeam(sfWebRequest $request)
  {
    $team = Doctrine::getTable('Team')->find($request->getParameter('teamId'));
    $this->forward404Unless($team);

    $this->user = $this->getRoute()->getObject();
    $this->user->addTeam($team);

    $this->getUser()->setFlash('notice', 'Team added successfully.');
    $this->redirect($this->generateUrl('user_show', $this->user));
  }

  public function executeRemoveTeam(sfWebRequest $request)
  {
    $team = Doctrine::getTable('Team')->find($request->getParameter('teamId'));
    $this->forward404Unless($team);

    $this->user = $this->getRoute()->getObject();
    $this->user->removeTeam($team);
    
    $this->getUser()->setFlash('notice', 'Team removed successfully.');
    $this->redirect($this->generateUrl('user_show', $this->user));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName()));
    
    if ($form->isValid()) {
      $form->save();

      $this->redirect('@user');
    }
  }
}
