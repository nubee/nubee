<?php

/**
 * Task filter form base class.
 *
 * @package    nubee
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTaskFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'story_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Story'), 'add_empty' => true)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'       => new sfWidgetFormFilterInput(),
      'original_estimate' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'current_estimate'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'not_started' => 'not_started', 'started' => 'started', 'done' => 'done'))),
      'priority'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'none' => 'none', 'p1' => 'p1', 'p2' => 'p2', 'p3' => 'p3', 'p4' => 'p4', 'p5' => 'p5', 'p6' => 'p6'))),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'story_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Story'), 'column' => 'id')),
      'name'              => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'original_estimate' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'current_estimate'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'            => new sfValidatorChoice(array('required' => false, 'choices' => array('not_started' => 'not_started', 'started' => 'started', 'done' => 'done'))),
      'priority'          => new sfValidatorChoice(array('required' => false, 'choices' => array('none' => 'none', 'p1' => 'p1', 'p2' => 'p2', 'p3' => 'p3', 'p4' => 'p4', 'p5' => 'p5', 'p6' => 'p6'))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('task_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Task';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'story_id'          => 'ForeignKey',
      'name'              => 'Text',
      'description'       => 'Text',
      'original_estimate' => 'Number',
      'current_estimate'  => 'Number',
      'status'            => 'Enum',
      'priority'          => 'Enum',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
