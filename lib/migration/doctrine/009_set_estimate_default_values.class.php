<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SetEstimateDefaultValues extends Doctrine_Migration
{
	public function up()
	{
    $this->changeColumn('task', 'estimate', 'integer', array('notnull' => true, 'default' => 0));
    $this->changeColumn('task', 'effort_left', 'integer', array('notnull' => true, 'default' => 0));
	}

	public function down()
	{
    $this->changeColumn('task', 'effort_left', 'integer', array('notnull' => true));
    $this->changeColumn('task', 'estimate', 'integer', array('notnull' => true));
	}
}