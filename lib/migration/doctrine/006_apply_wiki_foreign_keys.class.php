<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addblwikipage extends Doctrine_Migration
{
	public function up()
	{
		$this->createForeignKey('bl_wiki_page', array(
      'local' => 'creator_id',
      'foreign' => 'id',
      'foreignTable' => 'sf_guard_user',
      'name' => 'bl_wiki_page_creator_id',
    ));
    $this->createForeignKey('bl_wiki_page', array(
      'local' => 'editor_id',
      'foreign' => 'id',
      'foreignTable' => 'sf_guard_user',
      'name' => 'bl_wiki_page_editor_id',
    ));
    $this->createForeignKey('bl_wiki_page_revision', array(
      'local' => 'editor_id',
      'foreign' => 'id',
      'foreignTable' => 'sf_guard_user',
      'name' => 'bl_wiki_page_revision_editor_id',
    ));
    $this->createForeignKey('bl_wiki_page_revision', array(
      'local' => 'page_id',
      'foreign' => 'id',
      'foreignTable' => 'bl_wiki_page',
      'name' => 'bl_wiki_page_revision_page_id',
    ));
  }

	public function down()
	{
		$this->dropForeignKey('bl_wiki_page', 'bl_wiki_page_creator_id');
		$this->dropForeignKey('bl_wiki_page', 'bl_wiki_page_editor_id');
		$this->dropForeignKey('bl_wiki_page_revision', 'bl_wiki_page_revision_editor_id');
		$this->dropForeignKey('bl_wiki_page_revision', 'bl_wiki_page_revision_page_id');
	}
}