<?php

/**
 * MigrationVersion filter form base class.
 *
 * @package    nubee
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMigrationVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'version' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'version' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('migration_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MigrationVersion';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'version' => 'Number',
    );
  }
}
