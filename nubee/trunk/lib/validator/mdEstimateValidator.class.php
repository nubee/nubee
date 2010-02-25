<?php

class mdEstimateValidator extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
  }

  protected function doClean($value)
  {
    $array = explode(':', $value);
    if(count($array) == 1) {
      return (int)$value;
    }
    if(count($array) == 2) {
      $hours = (int)$array[0];
      $minutes = (int)$array[1];

      return $hours*60 + $minutes;
    }
    if(count($array) == 3) {
      $hours = (int)$array[0];
      $minutes = (int)$array[1];
      $seconds = (int)$array[2];

      return $hours*60 + $minutes + (int)($seconds/60);
    }

    throw new sfValidatorError($this, 'invalid', array('value' => $value));
  }
}
