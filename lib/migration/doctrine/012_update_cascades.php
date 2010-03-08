<?php

class UpdateCascades extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->dropForeignKey('iteration', 'iteration_project_id_project_id');
    $this->dropForeignKey('project', 'project_product_id_product_id');
    $this->dropForeignKey('project_member', 'project_member_member_id_sf_guard_user_id');
    $this->dropForeignKey('project_relation', 'project_relation_parent_id_project_id');
    $this->dropForeignKey('story', 'story_iteration_id_iteration_id');
    $this->dropForeignKey('task', 'task_story_id_story_id');
    $this->dropForeignKey('user_per_team', 'user_per_team_team_id_team_id');
    $this->dropForeignKey('user_profile', 'user_profile_user_id_sf_guard_user_id');
    $this->dropForeignKey('working_unit', 'working_unit_task_id_task_id');

    $this->createForeignKey('iteration', 'iteration_project_id_project_id', array(
      'name' => 'iteration_project_id_project_id',
      'local' => 'project_id',
      'foreign' => 'id',
      'foreignTable' => 'project',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('project', 'project_product_id_product_id', array(
      'name' => 'project_product_id_product_id',
      'local' => 'product_id',
      'foreign' => 'id',
      'foreignTable' => 'product',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('project_member', 'project_member_member_id_sf_guard_user_id', array(
      'name' => 'project_member_member_id_sf_guard_user_id',
      'local' => 'member_id',
      'foreign' => 'id',
      'foreignTable' => 'sf_guard_user',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('project_relation', 'project_relation_parent_id_project_id', array(
      'name' => 'project_relation_parent_id_project_id',
      'local' => 'parent_id',
      'foreign' => 'id',
      'foreignTable' => 'project',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('story', 'story_iteration_id_iteration_id', array(
      'name' => 'story_iteration_id_iteration_id',
      'local' => 'iteration_id',
      'foreign' => 'id',
      'foreignTable' => 'iteration',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('task', 'task_story_id_story_id', array(
      'name' => 'task_story_id_story_id',
      'local' => 'story_id',
      'foreign' => 'id',
      'foreignTable' => 'story',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('user_per_team', 'user_per_team_team_id_team_id', array(
      'name' => 'user_per_team_team_id_team_id',
      'local' => 'team_id',
      'foreign' => 'id',
      'foreignTable' => 'team',
      'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('user_profile', 'user_profile_user_id_sf_guard_user_id', array(
      'name' => 'user_profile_user_id_sf_guard_user_id',
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
  }
}
