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
    $this->userProfiles = Doctrine::getTable('UserProfile')->findAllOrdered();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->userProfile = Doctrine::getTable('UserProfile')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->userProfile);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UserProfileForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new UserProfileForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->userProfile = Doctrine::getTable('UserProfile')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->userProfile);
    $this->form = new UserProfileForm($this->userProfile);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->userProfile = Doctrine::getTable('UserProfile')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->userProfile);
    $this->form = new UserProfileForm($this->userProfile);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($userProfile = Doctrine::getTable('UserProfile')->find(array($request->getParameter('id'))), sprintf('Object userProfile does not exist (%s).', array($request->getParameter('id'))));
    $userProfile->delete();

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
    
    if ($form->isValid())
    {
      $userProfile = $form->save();

      $this->redirect('@user');
    }
  }
}
