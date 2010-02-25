<?php

require_once dirname(__FILE__).'/../bootstrap/Doctrine.php';

function createWorkingUnit($task, $user, $effort) {
  $workingUnit = new WorkingUnit();
  $workingUnit->setUser($user);
  $workingUnit->setEffortSpent($effort);

  return $workingUnit;
}

$t = new lime_test(14, new lime_output_color());

$t->comment('Test estimate');
$task = new Task();

$story = Doctrine::getTable('Story')->findAll()->getFirst();
$task->setStory($story);
$task->setOriginalEstimate(100);
$task->save();
$t->is($task->getEffortSpent(), 0, 'Initial effort is 0');
$t->is($task->isStarted(), false, 'Status is not \'Started\'');
$t->is($task->isDone(), false, 'Status is not \'Done\'');

$user = Doctrine::getTable('sfGuardUser')->findOneByUsername('adam');


$task->addWorkingUnit(createWorkingUnit($task, $user, 10));
$t->is($task->isStarted(), true, 'Status is \'Started\'');
$t->is($task->isDone(), false, 'Status is not \'Done\'');

$t->is($task->getEffortSpent(), 10, 'Effort spent is 10');
$t->is($task->getEffortLeft(), 90, 'Effort left is 90');

$t->comment('Update current estimate');
$task->setCurrentEstimate(110);

$t->is($task->getEffortSpent(), 10, 'Effort spent is 10');
$t->is($task->getEffortLeft(), 100, 'Effort left is 100');

try {
  $task->addWorkingUnit(createWorkingUnit($task, $user, 110));
  $t->fail('Can\'t add more effort than left');
}
catch(Exception $exc) {
  $t->pass('Can\'t add more effort than left');
}

$task->addWorkingUnit(createWorkingUnit($task, $user, 100));
$t->is($task->isStarted(), false, 'Status is not \'Started\'');
$t->is($task->isDone(), true, 'Status is \'Done\'');

$workingUnit = $task->WorkingUnits->getFirst();
//$workingUnit = Doctrine::getTable('WorkingUnit')->findByTask($task)->getFirst();
//print_r($workingUnit->toArray());
//$workingUnit->delete();
//$workingUnit->save();
//$task = Doctrine::getTable('Task')->find($task->getId());
//$task->WorkingUnits->remove($workingUnit->getId());
$task->removeWorkingUnit($workingUnit);
//$task->save();
$t->is($task->isStarted(), true, 'Status is \'Started\'');
$t->is($task->isDone(), false, 'Status is not \'Done\'');

$task->delete();