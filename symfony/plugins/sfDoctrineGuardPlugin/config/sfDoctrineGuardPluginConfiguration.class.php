<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfDoctrineGuardPlugin configuration.
 * 
 * @package    sfDoctrineGuardPlugin
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfDoctrineGuardPluginConfiguration.class.php 30723 2010-08-22 09:51:02Z gimler $
 */
class sfDoctrineGuardPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (sfConfig::get('app_sf_guard_plugin_routes_register', true))
    {
      $enabledModules = sfConfig::get('sf_enabled_modules', array());
      if (in_array('sfGuardAuth', $enabledModules))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfGuardRouting', 'listenToRoutingLoadConfigurationEvent'));
      }

      foreach (array('sfGuardUser', 'sfGuardGroup', 'sfGuardPermission', 'sfGuardRegister', 'sfGuardForgotPassword') as $module)
      {
        if (in_array($module, $enabledModules))
        {
          $this->dispatcher->connect('routing.load_configuration', array('sfGuardRouting', 'addRouteFor'.str_replace('sfGuard', '', $module)));
        }
      }
    }
  }
}
