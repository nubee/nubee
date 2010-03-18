<?php

/*  $URL: http://svn.symfony-project.com/plugins/bhLDAPAuthPlugin/branches/1.2_Doctrine/modules/bhLDAPAuth/actions/actions.class.php $ */

  // Doctrine-specifics here
require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');


/**
 *
 * @package    bhLDAPAuthPlugin
 * @subpackage plugin
 * @author     Nathan Vonnahme
 * @version    SVN: $Id: actions.class.php 19104 2009-06-09 21:33:32Z Nathan.Vonnahme $
 */
class bhLDAPAuthActions extends BasesfGuardAuthActions
{

  public function executeSignin($request)
  {
    bhLDAP::debug("########  hello bhLDAPAuthActions::executeSignin");

    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      bhLDAP::debug("########  logged in!  redirectifying to homepage");
      return $this->redirect('@homepage');
    }

/*     bhLDAP::debugDump($user, 'the user'); */


    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'bhLDAPAuthFormSignin');
    $this->form = new $class();

    bhLDAP::debug("########  Request Method = " . $request->getMethod());


    if ($request->isMethod('post'))
    {
      bhLDAP::debug("########  a login attempt!  signing in (if validation passed) and redirectifying to homepage or wherever");

      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
        $this->getUser()->signIn($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

        // always redirect to a URL set in app.yml
        // or to the referer
        // or to the homepage
        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage'));

        return $this->redirect($signinUrl);
      }
    
    }
    else
    {
      bhLDAP::debug("########  not a POST!  redirecting to signin form");

      if ($this->getRequest()->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }


      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      if ($this->getModuleName() != ($module = sfConfig::get('sf_login_module')))
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
  }
}
