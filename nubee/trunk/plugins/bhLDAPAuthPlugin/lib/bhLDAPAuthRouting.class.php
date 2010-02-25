<?php

// $Id: bhLDAPAuthRouting.class.php 19104 2009-06-09 21:33:32Z Nathan.Vonnahme $
// $URL: http://svn.symfony-project.com/plugins/bhLDAPAuthPlugin/branches/1.2_Doctrine/lib/bhLDAPAuthRouting.class.php $


/**
 *
 * @package    bhLDAPAuthPlugin
 * @subpackage plugin
 * @author     Nathan Vonnahme
 * @version    SVN: $Id: bhLDAPAuthRouting.class.php 19104 2009-06-09 21:33:32Z Nathan.Vonnahme $
 */

class bhLDAPAuthRouting extends sfGuardRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();   

    $r->prependRoute('bh_ldap_signin', new sfRoute('/login', array('module' => 'bhLDAPAuth', 'action' => 'signin')));
    $r->prependRoute('sf_guard_signin', new sfRoute('/login', array('module' => 'bhLDAPAuth', 'action' => 'signin')));

    parent::listenToRoutingLoadConfigurationEvent($event);
  }
}
