<?php

/**
 * project actions.
 *
 * @package    nubee
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class projectActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->project = Doctrine::getTable('Project')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->project);
  }

  public function executeNew(sfWebRequest $request)
  {
    $product = Doctrine::getTable('Product')->find($request->getParameter('product_id'));
    $this->forward404Unless($product);
    $project = new Project();
    $project->setProduct($product);
    $this->form = new ProjectForm($project);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $product = Doctrine::getTable('Product')->find($request->getParameter('product_id'));
    $project = new Project();
    $project->setProduct($product);

    $this->form = new ProjectForm($project);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($project = Doctrine::getTable('Project')->find(array($request->getParameter('id'))), sprintf('Object project does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new ProjectForm($project);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($project = Doctrine::getTable('Project')->find(array($request->getParameter('id'))), sprintf('Object project does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new ProjectForm($project);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($project = Doctrine::getTable('Project')->find(array($request->getParameter('id'))), sprintf('Object project does not exist (%s).', array($request->getParameter('id'))));
    $project->delete();

    $this->redirect('@project');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $project = $form->save();

      $this->redirect('@project_show?id=' . $project->getId());
    }
  }
}
