<?php

/**
 * Iteration form.
 *
 * @package    form
 * @subpackage Iteration
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class IterationForm extends BaseIterationForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['project_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'Project',
      'query' => Doctrine::getTable('Project')->findByProductQuery($this->getObject()->getProduct()),
      'add_empty' => false
    ));

    $this->validatorSchema['project_id'] = new sfValidatorDoctrineChoice(array(
      'model' => 'Project',
      'query' => Doctrine::getTable('Project')->findByProductQuery($this->getObject()->getProduct()),
    ));

    $this->widgetSchema['start_date'] = new nbWidgetFormDateJQueryUI();
    $this->widgetSchema['start_date']->setDefault(date('d/m/Y'));

    $this->widgetSchema['end_date'] = new nbWidgetFormDateJQueryUI();
    $this->widgetSchema['end_date']->setDefault(date('d/m/Y', strtotime('+1 month')));

    $this->widgetSchema->setLabels(array(
      'project_id' => 'Project'
    ));
  }

}