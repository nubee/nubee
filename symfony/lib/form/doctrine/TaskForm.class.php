<?php

/**
 * Task form.
 *
 * @package    form
 * @subpackage Task
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TaskForm extends BaseTaskForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['effort_left'], $this['effort_spent'], $this['status']);

    $query = Doctrine::getTable('Story')->findByIterationQuery($this->getObject()->getIteration());
    
    $this->widgetSchema['story_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'Story',
      'query' => $query,
      'add_empty' => false
    ));

    $this->widgetSchema['priority'] = new sfWidgetFormChoice(
      array('choices' => NB::getPriorities()));
    $this->setDefault('priority', 'p4');

    $this->validatorSchema['story_id'] = new sfValidatorDoctrineChoice(array(
      'model' => 'Story',
      'query' => $query,
    ));

    if($this->isNew()) {
      unset($this['current_estimate']);
      $this->widgetSchema['original_estimate'] = new nbWidgetFormEstimate();
      $this->validatorSchema['original_estimate'] = new nbEstimateValidator();
      $this->widgetSchema->setHelp('original_estimate', $this->formatEstimateHelp());
      $this->setDefault('original_estimate', 30);
    }
    else {
      unset($this['original_estimate']);
      $this->widgetSchema['current_estimate'] = new nbWidgetFormEstimate();
      $this->validatorSchema['current_estimate'] = new nbEstimateValidator();
      $this->widgetSchema->setHelp('current_estimate', $this->formatEstimateHelp());
    }

    $this->widgetSchema['name']->setAttribute('class', 'width90');
  
    $this->validatorSchema['priority'] = new sfValidatorChoice(
      array('choices' => array_keys(NB::getPriorities())));
  }

  public function formatEstimateHelp()
  {
    $help = "Estimates can be formatted as:
  <ul>
    <li>m (minutes)</li>
    <li>h:m (hours:minutes)</li>
    <li>h:m:s (hours:minutes:seconds)</li>
  </ul>";
    return htmlentities($help);
  }
}