<?php

/**
 * Task form base class.
 *
 * @method Task getObject() Returns the current form's model object
 *
 * @package    nubee
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTaskForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'story_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Story'), 'add_empty' => false)),
      'name'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'original_estimate' => new sfWidgetFormInputText(),
      'current_estimate'  => new sfWidgetFormInputText(),
      'status'            => new sfWidgetFormChoice(array('choices' => array('not_started' => 'not_started', 'started' => 'started', 'done' => 'done'))),
      'priority'          => new sfWidgetFormChoice(array('choices' => array('none' => 'none', 'p1' => 'p1', 'p2' => 'p2', 'p3' => 'p3', 'p4' => 'p4', 'p5' => 'p5', 'p6' => 'p6'))),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'story_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Story'))),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'description'       => new sfValidatorString(array('required' => false)),
      'original_estimate' => new sfValidatorInteger(),
      'current_estimate'  => new sfValidatorInteger(),
      'status'            => new sfValidatorChoice(array('choices' => array(0 => 'not_started', 1 => 'started', 2 => 'done'))),
      'priority'          => new sfValidatorChoice(array('choices' => array(0 => 'none', 1 => 'p1', 2 => 'p2', 3 => 'p3', 4 => 'p4', 5 => 'p5', 6 => 'p6'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('task[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Task';
  }

}
