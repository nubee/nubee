<?php

class mdWidgetFormEstimate extends sfWidgetForm
{
  public function configure($options = array(), $attributes = array())
  {
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $value = NB::formatEstimate($value);

    return $this->renderTag('input', array_merge(array('type' => 'input', 'name' => $name, 'value' => $value), $attributes));
  }
}