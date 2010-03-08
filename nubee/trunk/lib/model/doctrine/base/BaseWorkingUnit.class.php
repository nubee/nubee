<?php

/**
 * BaseWorkingUnit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $task_id
 * @property integer $effort_spent
 * @property sfGuardUser $User
 * @property Task $Task
 * 
 * @method integer     getUserId()       Returns the current record's "user_id" value
 * @method integer     getTaskId()       Returns the current record's "task_id" value
 * @method integer     getEffortSpent()  Returns the current record's "effort_spent" value
 * @method sfGuardUser getUser()         Returns the current record's "User" value
 * @method Task        getTask()         Returns the current record's "Task" value
 * @method WorkingUnit setUserId()       Sets the current record's "user_id" value
 * @method WorkingUnit setTaskId()       Sets the current record's "task_id" value
 * @method WorkingUnit setEffortSpent()  Sets the current record's "effort_spent" value
 * @method WorkingUnit setUser()         Sets the current record's "User" value
 * @method WorkingUnit setTask()         Sets the current record's "Task" value
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseWorkingUnit extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('working_unit');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('task_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('effort_spent', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Task', array(
             'local' => 'task_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}