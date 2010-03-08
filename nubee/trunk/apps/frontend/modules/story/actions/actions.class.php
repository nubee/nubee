<?php

class storyActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->story = Doctrine::getTable('Story')->find($request->getParameter('id'));
    $this->forward404Unless($this->story);
  }

  public function executeNew(sfWebRequest $request)
  {
    $iteration = Doctrine::getTable('Iteration')->find($request->getParameter('iteration_id'));
    $story = new Story();
    $story->setIteration($iteration);
    
    $this->form = new StoryForm($story);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $iteration = Doctrine::getTable('Iteration')->find($request->getParameter('iteration_id'));
    $story = new Story();
    $story->setIteration($iteration);
    $this->form = new StoryForm($story);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($story = Doctrine::getTable('Story')->find(array($request->getParameter('id'))), sprintf('Object story does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new StoryForm($story);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($story = Doctrine::getTable('Story')->find(array($request->getParameter('id'))), sprintf('Object story does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new StoryForm($story);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($story = Doctrine::getTable('Story')->find(array($request->getParameter('id'))), sprintf('Object story does not exist (%s).', array($request->getParameter('id'))));
    $story->delete();

    $this->redirect('@iteration_show?id=' . $story->getIteration()->getId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    
    if ($form->isValid())
    {
      $story = $form->save();

      $this->redirect($this->generateUrl('story_show', $story));
    }
  }
}
