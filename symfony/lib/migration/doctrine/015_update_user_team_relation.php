<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version15 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('user_per_team', 'user_per_team_user_id_user_profile_id');
        $this->createForeignKey('user_per_team', 'user_per_team_user_id_sf_guard_user_id', array(
             'name' => 'user_per_team_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('user_per_team', 'user_per_team_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
    }

    public function down()
    {
        $this->createForeignKey('user_per_team', 'user_per_team_user_id_user_profile_id', array(
             'name' => 'user_per_team_user_id_user_profile_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'user_profile',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->dropForeignKey('user_per_team', 'user_per_team_user_id_sf_guard_user_id');
        $this->removeIndex('user_per_team', 'user_per_team_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
    }
}