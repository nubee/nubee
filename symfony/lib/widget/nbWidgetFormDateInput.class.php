<?php


class nbWidgetFormDateInput extends sfWidgetForm
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * type: The widget type (text by default)
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('type', 'text');
    $this->addOption('format', 'dd/MM/yyyy');
    $this->addOption('class', 'date');

    $this->setOption('is_hidden', false);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $df = new sfDateFormat();
    
    return $this->renderTag('input', array_merge(array(
      'type' => $this->getOption('type'),
      'name' => $name,
      'class' => $this->getOption('class'),
      'value' => $df->format($value, $this->getOption('format'))), $attributes));
  }
}
