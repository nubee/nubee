<?php

/**
 * Project form.
 *
 * @package    form
 * @subpackage Project
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ProjectForm extends BaseProjectForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);
    
    $this->widgetSchema->setLabels(array(
      'user_id' => 'Project Manager',
      'product_id' => 'Product',
      'members_list' => 'Members'
    ));
  }
}