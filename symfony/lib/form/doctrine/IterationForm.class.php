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

    $this->widgetSchema['start_date'] = new nbWidgetFormDateInput();
    $this->widgetSchema['start_date']->setDefault(date('d/m/Y'));

    $this->widgetSchema['end_date'] = new nbWidgetFormDateInput();
    $this->widgetSchema['end_date']->setDefault(date('d/m/Y', strtotime('+1 month')));

/*    $this->validatorSchema['start_date'] = new nbDateValidator(array(
      'date_output' => 'Y-m-d',
      'input_date_format' => 'd/m/Y',
      'output_date_format' => 'Y-m-d',
      'with_time' => false,     
    ));
    $this->validatorSchema['end_date'] = new nbDateValidator(array(
      'date_output' => 'Y-m-d',
      'input_date_format' => 'd/m/Y',
      'output_date_format' => 'Y-m-d',
      'with_time' => false,     
    ));
*/    
    $this->widgetSchema->setLabels(array(
      'project_id' => 'Project'
    ));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorSchemaCompare('end_date', sfValidatorSchemaCompare::GREATER_THAN, 'start_date')
    );    
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles = null) {
    $df = new sfDateFormat();
    $taintedValues['start_date'] = $df->format($taintedValues['start_date'], 'yyyy-MM-dd', 'dd/MM/yyyy');
    $taintedValues['end_date'] = $df->format($taintedValues['end_date'], 'yyyy-MM-dd', 'dd/MM/yyyy');

    return parent::bind($taintedValues, $taintedFiles);
  }

}