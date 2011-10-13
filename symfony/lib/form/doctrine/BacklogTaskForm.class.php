<?php

/**
 * BacklogTask form.
 *
 * @package    nubee
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BacklogTaskForm extends BaseBacklogTaskForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['priority'] = new sfWidgetFormChoice(
      array('choices' => NB::getPriorities()));

    $this->widgetSchema['estimate'] = new nbWidgetFormEstimate();
    $this->widgetSchema->setHelp('estimate', $this->formatEstimateHelp());
    $this->validatorSchema['estimate'] = new nbEstimateValidator();

    $this->validatorSchema['priority'] = new sfValidatorChoice(
      array('choices' => array_keys(NB::getPriorities())));

    $this->widgetSchema->setLabels(array(
      'project_id' => 'Project'
    ));
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
