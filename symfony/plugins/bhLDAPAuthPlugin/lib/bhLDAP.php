<?php

// $Id: bhLDAP.php 19104 2009-06-09 21:33:32Z Nathan.Vonnahme $
// $URL: http://svn.symfony-project.com/plugins/bhLDAPAuthPlugin/branches/1.2_Doctrine/lib/bhLDAP.php $
require_once 'adLDAP.php';

class bhLDAP 
{
  protected static $ldap = null;
  protected static $config = null;

  public static function getLDAP() 
  {
    if (self::$ldap === null) {
      $c = self::getConfig();
      self::$ldap = new adLDAP($c['adLDAP']);
      self::debugDump(self::$ldap, 'configured adLDAP object');

    }
    
    return self::$ldap;
  }


  public static function getConfig()
  {
    if (self::$config === null) {
      $config = sfYaml::load(sfConfig::get('sf_config_dir') . '/LDAPAuth.yml');
      self::debugDump($config, 'original parsed yaml');

      self::$config = $config;
    }
    
    return self::$config;
  }

  public static function checkPassword($username, $password)
  {
    self::debug("########  hello bhLDAP::checkPassword()!");

    $return = self::getLDAP()->authenticate($username, $password);
    self::debug( "$username password OK? [$return]");

    # authz takes place in apps/frontend/lib/myUser.class.php, 
    # which points to this plugin's lib/user/bhLDAPAuthSecurityUser.class.php

    return $return;
  }

  # this works around a PHP_NOTICE error in adLDAP's user_groups function
  public static function getUserGroups($username, $recursive = null) {
    $ldap = self::getLDAP();

    self::debugDump($ldap->_recursive_groups, "_recursive_groups setting");
    self::debugDump($recursive, "passed in \$recursive var");

    if ($recursive === null) {
      //use the default option if they haven't set it
      self::debug("using recursive option (" . $ldap->_recursive_groups . ") from config file or default config");
      $recursive = $ldap->_recursive_groups;
    }

    self::debug("getting group memberships for $username");
    $filter="cn=".$username;
    $fields=array("cn");

    $sr = ldap_search($ldap->_conn,$ldap->_base_dn,$filter,$fields);
    if (!$sr) return array();

    $entries = ldap_get_entries($ldap->_conn, $sr);
    self::debugDump($entries, 'Entries: ');
    if (!(count($entries) && array_key_exists('memberof', $entries[0])))
      return array();
    self::debugDump($entries, "group entries for $username");

    $groups = $ldap->nice_names($entries[0]['memberof']);

    if($recursive) {
      self::debug("checking recursive group memberships");
      foreach ($groups as $id => $group_name) {
        $extra_groups=@$ldap->recursive_groups($group_name);
        $groups=array_merge($groups,$extra_groups);
      }
    }

    return $groups;
  }

  public static function getUserCredentials($user)
  {
    $credentials = array();
    //    self::debugDump($user, "user");
    $username = $user->getUsername();

    $ldap = self::getLDAP();
    self::debug("looking up user groups for $username");

    // look up credentials using AD groups
//    $memberships = self::getUserGroupsLC($username);
//    self::debugDump($memberships, 'Memberships: ');

    $config = self::getConfig();
//    self::debugDump($config, 'Config: ');

    foreach ($config['groupMappings'] as $credential => $ad_groups) {
      foreach ($ad_groups as $group) {
        $users = self::getUsersInGroup($group);

        if(self::userInGroup($username, $users)) {
          self::debug("$username in group $group");
          $credentials[] = $credential;
        }
        else
          self::debug("$username not in group $group");
      }
    }

    $credentials = array_unique($credentials);
    self::debugDump($credentials, "credentials for $username");

    return $credentials;
  }

  public static function getUsersInGroup($group) {
    $filter = "cn=" . $group;
    $fields = array("memberuid");

    $ldap = self::getLDAP();
    $sr = ldap_search($ldap->_conn, 'ou=Groups,dc=domain,dc=com', $filter, $fields);

//    self::debugDump($sr, 'Result: ');
    if (!$sr)
      return array();

    $entries = ldap_get_entries($ldap->_conn, $sr);
//    self::debugDump($entries, 'Entries: ');
    if (!(count($entries) && array_key_exists('memberuid', $entries[0])))
      return array();

    return $entries[0]['memberuid'];
  }

  public static function userInGroup($username, $users) {
    self::debugDump($users, 'Users: ');

    if (!count($users))
      return false;

    foreach ($users as $id => $user) {
      if($user == $username)
        return true;
    }

    return false;
  }
  
  /**
   * Print a string to the log using 'debug' level.  For printf-style
   * debugging.  
   * 
   * @param      string $m      The string to log
   * @return     nothing
   */ 
  public static function debug ($m) {
    if (sfConfig::has('sf_logging_enabled') && sfConfig::get('sf_logging_enabled')) {
        if ($logger = sfContext::getInstance()->getLogger()) {
          $logger->debug($m);
        }
    }
    elseif (sfConfig::has('bhLDAP_echo_debugging') && sfConfig::get('bhLDAP_echo_debugging')) {
    	echo "# $m\n";
    }
    else {
//     	echo $m;
    }
}

  /**
   * Dump a data structure to the log at the 'debug' level.  Uses
   * print_r() formatting.
   * 
   * @param      mixed $v         The variable/data structure to dump
   * @param      string $label    An optional label to print in front of the dump
   * @return     nothing
   */ 
  public static function debugDump ($v, $label = "var dump") {
    self::debug("$label:  " . print_r($v, true));
  }
}
