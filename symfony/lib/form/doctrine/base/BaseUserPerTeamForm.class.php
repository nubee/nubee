<?php

/**
 * UserPerTeam form base class.
 *
 * @method UserPerTeam getObject() Returns the current form's model object
 *
 * @package    nubee
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserPerTeamForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id' => new sfWidgetFormInputHidden(),
      'team_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'team_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('team_id')), 'empty_value' => $this->getObject()->get('team_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_per_team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserPerTeam';
  }

}
