<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AddWorkingUnitTable extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createTable('working_unit', array(
      'id' => array(
        'type' => 'integer',
        'length' => 8,
        'autoincrement' => true,
        'primary' => true,
      ),
      'user_id' => array(
        'type' => 'integer',
        'notnull' => true,
        'length' => 8,
      ),
      'task_id' => array(
        'type' => 'integer',
        'notnull' => true,
        'length' => 8,
      ),
      'effort_spent' => array(
        'type' => 'integer',
        'notnull' => true,
        'length' => 8,
      ),
      'created_at' => array(
        'notnull' => true,
        'type' => 'timestamp',
        'length' => 25,
      ),
      'updated_at' => array(
        'notnull' => true,
        'type' => 'timestamp',
        'length' => 25,
      ),
      ), array(
        'indexes' => array(),
        'primary' => array(0 => 'id'),
    ));

    $this->createForeignKey('working_unit', 'working_unit_user_id_sf_guard_user_id', array(
      'name' => 'working_unit_user_id_sf_guard_user_id',
      'local' => 'user_id',
      'foreign' => 'id',
      'foreignTable' => 'sf_guard_user',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('working_unit', 'working_unit_task_id_task_id', array(
      'name' => 'working_unit_task_id_task_id',
      'local' => 'task_id',
      'foreign' => 'id',
      'foreignTable' => 'task',
      'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('working_unit', 'working_unit_task_id_task_id');
    $this->dropForeignKey('working_unit', 'working_unit_user_id_sf_guard_user_id');
    $this->dropTable('working_unit');
  }
}