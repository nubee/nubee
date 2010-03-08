<?php

class RemoveEffortFromTask extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->removeColumn('task', 'effort_spent');
  }

  public function down()
  {
    $this->addColumn('task', 'effort_spent', 'integer', array('notnull' => true, 'length' => 8));
  }
}
