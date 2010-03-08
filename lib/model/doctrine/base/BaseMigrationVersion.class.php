<?php

/**
 * BaseMigrationVersion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $version
 * 
 * @method integer          getVersion() Returns the current record's "version" value
 * @method MigrationVersion setVersion() Sets the current record's "version" value
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
 */
abstract class BaseMigrationVersion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('migration_version');
        $this->hasColumn('version', 'integer', 11, array(
             'type' => 'integer',
             'length' => '11',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}