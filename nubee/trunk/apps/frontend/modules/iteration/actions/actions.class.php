<?php

/**
 * iteration actions.
 *
 * @package    nubee
 * @subpackage iteration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class iterationActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->iteration = Doctrine::getTable('Iteration')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->iteration);
  }

  public function executeNew(sfWebRequest $request)
  {
    $project = Doctrine::getTable('Project')->find($request->getParameter('project_id'));
    $iteration = new Iteration();
    $iteration->setProject($project);
    $this->form = new IterationForm($iteration);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $project = Doctrine::getTable('Project')->find($request->getParameter('project_id'));
    $iteration = new Iteration();
    $iteration->setProject($project);

    $this->form = new IterationForm($iteration);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($iteration = Doctrine::getTable('Iteration')->find(array($request->getParameter('id'))), sprintf('Object iteration does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new IterationForm($iteration);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($iteration = Doctrine::getTable('Iteration')->find(array($request->getParameter('id'))), sprintf('Object iteration does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new IterationForm($iteration);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($iteration = Doctrine::getTable('Iteration')->find(array($request->getParameter('id'))), sprintf('Object iteration does not exist (%s).', array($request->getParameter('id'))));
    $iteration->delete();

    $this->redirect($this->generateUrl('project_show', $iteration->getProject()));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $iteration = $form->save();

      $this->redirect('@iteration_show?id=' . $iteration->getId());
    }
  }
}
