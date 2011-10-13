<?php

/**
 * PluginsfGuardUser tests.
 */
include dirname(__FILE__).'/../../../../../../test/bootstrap/unit.php';

$t = new lime_test(14);

$databaseManager = new sfDatabaseManager($configuration);

$table = Doctrine_Core::getTable('sfGuardUser');
$table->createQuery()
  ->delete()
  ->where('username = ?', 'active_user')
  ->execute();

$tableGroup = Doctrine_Core::getTable('sfGuardGroup');
$tableGroup->createQuery()
  ->delete()
  ->where('name = ?', 'test-group')
  ->execute();

$tablePermission = Doctrine_Core::getTable('sfGuardPermission');
$tablePermission->createQuery()
  ->delete()
  ->where('name = ?', 'test-permission')
  ->execute();

$activeUser = new sfGuardUser();
$activeUser->first_name = 'John';
$activeUser->last_name = 'Doe';
$activeUser->email_address = 'email2@test.com';
$activeUser->username = 'active_user';
$activeUser->password = 'password';
$activeUser->is_active = true;
$activeUser->save();

// ->__toString()
$t->diag('output functions');

$t->is((string) $activeUser, 'John Doe (active_user)', '->__toString() returns the full name and the username');
$t->is($activeUser->getName(), 'John Doe', '->getName() returns the full name of the user');


// group managment
$t->diag('group managment');

$t->is($activeUser->getGroupNames(), array(), '->getGroupNames() return empty array if no group is set');

try
{
  $activeUser->addGroupByName('test-group');
  $t->fail('->addGroupByName() does throw an exception if group not exist');
}
catch (Exception $e)
{
  $t->pass('->addGroupByName() does throw an exception if group not exist');
}

$group = new sfGuardGroup();
$group->name = 'test-group';
$group->save();

$t->is($activeUser->hasGroup('test-group'), false, '->hasGroup() return false if user hasn\'t this group');

try
{
  $activeUser->addGroupByName('test-group');
  $t->pass('->addGroupByName() does not throw an exception if group exist');
}
catch (Exception $e)
{
  $t->diag($e->getMessage());
  $t->fail('->addGroupByName() does not throw an exception if group exist');
}

$t->is($activeUser->getGroupNames(), array('test-group'), '->getGroupNames() return array with group names');
$t->is($activeUser->hasGroup('test-group'), true, '->hasGroup() return true if user has this group');


// permission managment
$t->diag('permission managment');

$t->is($activeUser->getPermissionNames(), array(), '->getPermissionNames() return empty array if no permission is set');

try
{
  $activeUser->addPermissionByName('test-permission');
  $t->fail('->addPermissionByName() does throw an exception if group not exist');
}
catch (Exception $e)
{
  $t->pass('->addPermissionByName() does throw an exception if group not exist');
}

$permission = new sfGuardPermission();
$permission->name = 'test-permission';
$permission->save();

$t->is($activeUser->hasPermission('test-permission'), false, '->hasPermission() return false if user hasn\'t this group');

try
{
  $activeUser->addPermissionByName('test-permission');
  $t->pass('->addPermissionByName() does not throw an exception if permission exist');
}
catch (Exception $e)
{
  $t->diag($e->getMessage());
  $t->fail('->addPermissionByName() does not throw an exception if permission exist');
}

$t->is($activeUser->getPermissionNames(), array('test-permission'), '->getPermissionNames() return array with permission names');
$t->is($activeUser->hasPermission('test-permission'), true, '->hasPermission() return true if user has this group');
