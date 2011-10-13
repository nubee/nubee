<?php

class nbWidgetFormEstimate extends sfWidgetForm
{
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $value = NB::formatEstimate($value);

    return $this->renderTag('input', array_merge(array('type' => 'input', 'name' => $name, 'value' => $value), $attributes));
  }
}