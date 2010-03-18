<?php

/**
 * product actions.
 *
 * @package    nubee
 * @subpackage product
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->products = Doctrine::getTable('Product')->findAll();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->products = Doctrine::getTable('Product')->findAll();
    $this->product = Doctrine::getTable('Product')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->product);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProductForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ProductForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($product = Doctrine::getTable('Product')->find(array($request->getParameter('id'))), sprintf('Object product does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new ProductForm($product);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($product = Doctrine::getTable('Product')->find(array($request->getParameter('id'))), sprintf('Object product does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new ProductForm($product);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($product = Doctrine::getTable('Product')->find(array($request->getParameter('id'))), sprintf('Object product does not exist (%s).', array($request->getParameter('id'))));
    $product->delete();

    $this->redirect('product/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $product = $form->save();

      $this->redirect('@product_show?id=' . $product->getId());
    }
  }
}
