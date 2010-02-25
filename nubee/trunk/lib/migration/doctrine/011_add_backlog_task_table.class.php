<?php

class AddBacklogTaskTable extends Doctrine_Migration_Base
{
  public function up()
  {
		$this->createTable('backlog_task', array(
      'id' => array(
        'type' => 'integer',
        'length' => 8,
        'primary' => true,
        'autoincrement' => true,
      ),
      'project_id' => array(
        'type' => 'integer',
        'length' => 8,
        'notnull' => true,
      ),
      'name' => array(
        'type' => 'string',
        'length' => 255,
        'notnull' => true,
      ),
      'description' => array(
        'type' => 'string'
      ),
      'estimate' => array(
        'type' => 'integer',
        'length' => 8,
        'notnull' => true,
      ),
      'priority' => array(
        'type' => 'enum',
        'notnull' => true,
        'values' => array(
           0 => 'none',
           1 => 'p1',
           2 => 'p2',
           3 => 'p3',
           4 => 'p4',
           5 => 'p5',
           6 => 'p6'
         ),
      ),
      'created_at' => array(
        'type' => 'timestamp',
        'length' => 25,
        'notnull' => true,
      ),
      'updated_at' => array(
        'type' => 'timestamp',
        'length' => 25,
        'notnull' => true,
      ),
      ), array(
        'indexes' => array(),
      'primary' => array(
        0 => 'id',
      ),
    ));

    $this->createForeignKey('backlog_task', 'backlog_task_project_id_project_id', array(
      'local' => 'project_id',
      'foreign' => 'id',
      'foreignTable' => 'project',
      'onDelete' => 'CASCADE'
    ));
  }

  public function down()
  {
    $this->dropForeignKey('backlog_task', 'backlog_task_project_id_project_id');
    $this->dropTable('backlog_task');
  }
}
