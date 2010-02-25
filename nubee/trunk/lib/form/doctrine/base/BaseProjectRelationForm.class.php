<?php

/**
 * ProjectRelation form base class.
 *
 * @method ProjectRelation getObject() Returns the current form's model object
 *
 * @package    nubee
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProjectRelationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent_id' => new sfWidgetFormInputHidden(),
      'child_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'parent_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'parent_id', 'required' => false)),
      'child_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'child_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('project_relation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjectRelation';
  }

}
