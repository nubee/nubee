<?php

if (sfConfig::get('app_bh_ldap_plugin_routes_register', true) && 
    in_array('bhLDAPAuth', sfConfig::get('sf_enabled_modules', array())))
{
  $this->dispatcher->connect('routing.load_configuration', array('bhLDAPAuthRouting', 'listenToRoutingLoadConfigurationEvent'));
}
