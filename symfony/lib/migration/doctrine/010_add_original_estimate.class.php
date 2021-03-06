<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AddOriginalEstimate extends Doctrine_Migration
{
	public function up()
	{
    $this->renameColumn('task', 'estimate', 'current_estimate');
    $this->renameColumn('task', 'effort_left', 'original_estimate');
	}

	public function down()
	{
    $this->renameColumn('task', 'original_estimate', 'effort_left');
    $this->renameColumn('task', 'current_estimate', 'estimate');
	}
}