<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * 
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormSchemaFormatterTable.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
class sfWidgetFormSchemaFormatterCustomTable extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<tr>\n  <th>%label%</th>\n  <td>%field%%help%%hidden_fields%%error%</td>\n</tr>\n",
    $errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    $helpFormat      = '<span style="position: relative"><img src="/images/help.png" class="help" tooltip="%help%" alt="" /></span>',
    $decoratorFormat = "<table>\n  %content%</table>",
    $labelFormat = '%label%:',
    $requiredLabelFormat = '%label%<em class="required">*</em>';
  

  /**
   * @var sfValidatorSchema
   */
  protected $validatorSchema = null;

  /**
   * @var array
   */
  protected $params = array();

  /**
   * Constructor
   *
   * Params:
   *  - "required_label_class_name" css class name for label tag when the field is required field, the default is 'required'.
   *  - "required_label_format" default is '%label% <em class="required">*</em>'.
   *
   * @param sfWidgetFormSchema $widgetSchema
   * @param sfValidatorSchema $validatorSchema
   * @param array $params
   */
  public function __construct(sfWidgetFormSchema $widgetSchema, sfValidatorSchema $validatorSchema, $params = array())
  {
    $this->validatorSchema = $validatorSchema;
    $this->params = $params;
    parent::__construct($widgetSchema);
  }

  /**
   * Returns parameter identified with $name or if does not exist, returns $default.
   *
   * @param string $name
   * @param mixed $default
   * @return mixed
   */
  public function getParameter($name, $default=null)
  {
    if(!isset($this->params[$name])) {
      return $default;
    }

    return $this->params[$name];
  }

  /**
   * Generates a label for the given field name.
   *
   * @param  string $name        The field name
   * @param  array  $attributes  Optional html attributes for the label tag
   *
   * @return string The label tag
   */
  public function generateLabelName($name)
  {
    $isRequired = false;
    if($this->validatorSchema and isset($this->validatorSchema[$name])) {
      $validator = $this->validatorSchema[$name];

      if($validator->getOption('required')) {
        $class_name = $this->getParameter('required_label_class_name', 'required');
        $isRequired = true;
      }
    }

    $s = parent::generateLabelName($name);

    $s = str_replace('%label%', $s, $this->labelFormat);
    
    if($isRequired) {
      $format = $this->getParameter('required_label_format', $this->requiredLabelFormat);
      $s = str_replace('%label%', $s, $format);
    }

    return $s;
  }  
}
