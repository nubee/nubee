<?php

/**
 * BaseTask
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $story_id
 * @property string $name
 * @property string $description
 * @property integer $original_estimate
 * @property integer $current_estimate
 * @property enum $status
 * @property enum $priority
 * @property Story $Story
 * @property Doctrine_Collection $WorkingUnits
 * 
 * @method integer             getStoryId()           Returns the current record's "story_id" value
 * @method string              getName()              Returns the current record's "name" value
 * @method string              getDescription()       Returns the current record's "description" value
 * @method integer             getOriginalEstimate()  Returns the current record's "original_estimate" value
 * @method integer             getCurrentEstimate()   Returns the current record's "current_estimate" value
 * @method enum                getStatus()            Returns the current record's "status" value
 * @method enum                getPriority()          Returns the current record's "priority" value
 * @method Story               getStory()             Returns the current record's "Story" value
 * @method Doctrine_Collection getWorkingUnits()      Returns the current record's "WorkingUnits" collection
 * @method Task                setStoryId()           Sets the current record's "story_id" value
 * @method Task                setName()              Sets the current record's "name" value
 * @method Task                setDescription()       Sets the current record's "description" value
 * @method Task                setOriginalEstimate()  Sets the current record's "original_estimate" value
 * @method Task                setCurrentEstimate()   Sets the current record's "current_estimate" value
 * @method Task                setStatus()            Sets the current record's "status" value
 * @method Task                setPriority()          Sets the current record's "priority" value
 * @method Task                setStory()             Sets the current record's "Story" value
 * @method Task                setWorkingUnits()      Sets the current record's "WorkingUnits" collection
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
 */
abstract class BaseTask extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('task');
        $this->hasColumn('story_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('original_estimate', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('current_estimate', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'notnull' => true,
             'values' => 
             array(
              0 => 'not_started',
              1 => 'started',
              2 => 'done',
             ),
             ));
        $this->hasColumn('priority', 'enum', null, array(
             'type' => 'enum',
             'notnull' => true,
             'values' => 
             array(
              0 => 'none',
              1 => 'p1',
              2 => 'p2',
              3 => 'p3',
              4 => 'p4',
              5 => 'p5',
              6 => 'p6',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Story', array(
             'local' => 'story_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('WorkingUnit as WorkingUnits', array(
             'local' => 'id',
             'foreign' => 'task_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}