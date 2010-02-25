<?php

/**
 * Story filter form base class.
 *
 * @package    nubee
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseStoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iteration_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Iteration'), 'add_empty' => true)),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'priority'     => new sfWidgetFormChoice(array('choices' => array('' => '', 'none' => 'none', 'p1' => 'p1', 'p2' => 'p2', 'p3' => 'p3', 'p4' => 'p4', 'p5' => 'p5', 'p6' => 'p6'))),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'iteration_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Iteration'), 'column' => 'id')),
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'priority'     => new sfValidatorChoice(array('required' => false, 'choices' => array('none' => 'none', 'p1' => 'p1', 'p2' => 'p2', 'p3' => 'p3', 'p4' => 'p4', 'p5' => 'p5', 'p6' => 'p6'))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('story_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Story';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'iteration_id' => 'ForeignKey',
      'name'         => 'Text',
      'description'  => 'Text',
      'priority'     => 'Enum',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
