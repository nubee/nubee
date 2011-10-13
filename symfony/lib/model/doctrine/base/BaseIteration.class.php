<?php

/**
 * BaseIteration
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $project_id
 * @property string $name
 * @property string $description
 * @property date $start_date
 * @property Project $Project
 * @property Doctrine_Collection $Stories
 * 
 * @method integer             getProjectId()   Returns the current record's "project_id" value
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method date                getStartDate()   Returns the current record's "start_date" value
 * @method Project             getProject()     Returns the current record's "Project" value
 * @method Doctrine_Collection getStories()     Returns the current record's "Stories" collection
 * @method Iteration           setProjectId()   Sets the current record's "project_id" value
 * @method Iteration           setName()        Sets the current record's "name" value
 * @method Iteration           setDescription() Sets the current record's "description" value
 * @method Iteration           setStartDate()   Sets the current record's "start_date" value
 * @method Iteration           setProject()     Sets the current record's "Project" value
 * @method Iteration           setStories()     Sets the current record's "Stories" collection
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIteration extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('iteration');
        $this->hasColumn('project_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('start_date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Project', array(
             'local' => 'project_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Story as Stories', array(
             'local' => 'id',
             'foreign' => 'iteration_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}