<?php

/**
 * ProjectRelation form base class.
 *
 * @method ProjectRelation getObject() Returns the current form's model object
 *
 * @package    nubee
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
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
      'parent_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('parent_id')), 'empty_value' => $this->getObject()->get('parent_id'), 'required' => false)),
      'child_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('child_id')), 'empty_value' => $this->getObject()->get('child_id'), 'required' => false)),
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
