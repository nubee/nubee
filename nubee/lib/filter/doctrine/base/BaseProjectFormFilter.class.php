<?php

/**
 * Project filter form base class.
 *
 * @package    nubee
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProjectFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'), 'add_empty' => true)),
      'product_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'version'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'website'     => new sfWidgetFormFilterInput(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'enabled' => 'enabled', 'disabled' => 'disabled'))),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Manager'), 'column' => 'id')),
      'product_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Product'), 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'version'     => new sfValidatorPass(array('required' => false)),
      'website'     => new sfValidatorPass(array('required' => false)),
      'status'      => new sfValidatorChoice(array('required' => false, 'choices' => array('enabled' => 'enabled', 'disabled' => 'disabled'))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('project_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Project';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'product_id'  => 'ForeignKey',
      'name'        => 'Text',
      'description' => 'Text',
      'version'     => 'Text',
      'website'     => 'Text',
      'status'      => 'Enum',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'slug'        => 'Text',
    );
  }
}
