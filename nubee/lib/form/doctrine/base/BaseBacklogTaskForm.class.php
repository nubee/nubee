<?php

/**
 * BacklogTask form base class.
 *
 * @method BacklogTask getObject() Returns the current form's model object
 *
 * @package    nubee
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBacklogTaskForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'project_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'add_empty' => false)),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'estimate'    => new sfWidgetFormInputText(),
      'priority'    => new sfWidgetFormChoice(array('choices' => array('none' => 'none', 'p1' => 'p1', 'p2' => 'p2', 'p3' => 'p3', 'p4' => 'p4', 'p5' => 'p5', 'p6' => 'p6'))),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'project_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Project'))),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('required' => false)),
      'estimate'    => new sfValidatorInteger(),
      'priority'    => new sfValidatorChoice(array('choices' => array(0 => 'none', 1 => 'p1', 2 => 'p2', 3 => 'p3', 4 => 'p4', 5 => 'p5', 6 => 'p6'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('backlog_task[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BacklogTask';
  }

}
