<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
    $decorator = new sfWidgetFormSchemaFormatterCustomTable($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('customTable', $decorator);
    $this->widgetSchema->setFormFormatterName('customTable');
  }
}