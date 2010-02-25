<?php

/**
 * WorkingUnit form.
 *
 * @package    form
 * @subpackage WorkingUnit
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class WorkingUnitForm extends BaseWorkingUnitForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['user_id']);

    $this->widgetSchema['task_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema->setFormFormatterName('Div');
  }
}