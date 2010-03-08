<?php
// auto-generated by sfViewConfigHandler
// date: 2010/03/01 07:45:57
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('common.css', '', array ());
  $response->addStylesheet('layout.css', '', array ());
  $response->addStylesheet('header.css', '', array ());
  $response->addStylesheet('footer.css', '', array ());
  $response->addStylesheet('topmenu.css', '', array ());
  $response->addStylesheet('leftmenu.css', '', array ());
  $response->addStylesheet('actions.css', '', array ());
  $response->addStylesheet('breadcrumbs.css', '', array ());
  $response->addStylesheet('sections.css', '', array ());
  $response->addStylesheet('list.css', '', array ());
  $response->addStylesheet('details.css', '', array ());
  $response->addStylesheet('wikipage.css', '', array ());
  $response->addStylesheet('jquery.treeview.css', '', array ());
  $response->addJavascript('jquery-1.3.2.min.js', '', array ());
  $response->addJavascript('jquery.corner.js', '', array ());
  $response->addJavascript('jquery.cookie.js', '', array ());
  $response->addJavascript('jquery.qtip-1.0.0-rc3.min.js', '', array ());
  $response->addJavascript('jquery.treeview.js', '', array ());


