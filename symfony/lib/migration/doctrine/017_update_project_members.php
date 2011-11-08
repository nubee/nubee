<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version17 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('project_member', 'project_member_project_id_project_id');
        $this->dropForeignKey('project_member', 'project_member_member_id_sf_guard_user_id');
        $this->createForeignKey('project_member', 'project_member_project_id_project_id_1', array(
             'name' => 'project_member_project_id_project_id_1',
             'local' => 'project_id',
             'foreign' => 'id',
             'foreignTable' => 'project',
             ));
        $this->addIndex('project_member', 'project_member_project_id', array(
             'fields' => 
             array(
              0 => 'project_id',
             ),
             ));
    }

    public function down()
    {
        $this->createForeignKey('project_member', 'project_member_project_id_project_id', array(
             'name' => 'project_member_project_id_project_id',
             'local' => 'project_id',
             'foreign' => 'id',
             'foreignTable' => 'project',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('project_member', 'project_member_member_id_sf_guard_user_id', array(
             'name' => 'project_member_member_id_sf_guard_user_id',
             'local' => 'member_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->dropForeignKey('project_member', 'project_member_project_id_project_id_1');
        $this->removeIndex('project_member', 'project_member_project_id', array(
             'fields' => 
             array(
              0 => 'project_id',
             ),
             ));
    }
}