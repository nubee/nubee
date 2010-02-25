<?php

/**
 * Story form.
 *
 * @package    form
 * @subpackage Story
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class StoryForm extends BaseStoryForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['iteration_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'Iteration',
      'query' => Doctrine::getTable('Iteration')->findByProjectQuery($this->getObject()->getProject()),
      'add_empty' => false
    ));

    $this->widgetSchema['priority'] = new sfWidgetFormChoice(
      array('choices' => NB::getPriorities()));

    $this->validatorSchema['iteration_id'] = new sfValidatorDoctrineChoice(array(
      'model' => 'Iteration',
      'query' => Doctrine::getTable('Iteration')->findByProjectQuery($this->getObject()->getProject()),
    ));
    $this->validatorSchema['priority'] = new sfValidatorChoice(
      array('choices' => array_keys(NB::getPriorities())));

    $this->widgetSchema->setLabels(array(
      'iteration_id' => 'Iteration'
    ));
  }
}