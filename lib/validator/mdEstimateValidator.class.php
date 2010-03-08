<?php

class mdEstimateValidator extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('invalid', 'Estimate format must be m, h:m, h:m:s.');
    $this->addMessage('min_value', 'Estimate must be greater than 0.');
  }

  protected function doClean($value)
  {
    $array = explode(':', $value);

    $minutes = 0;
    if(count($array) > 3)
      throw new sfValidatorError($this, 'invalid', array('value' => $value));

    if(count($array) == 1) {
      $minutes = $array[0];
    }
    if(count($array) == 2) {
      $hours = (int)$array[0];
      $minutes = (int)$array[1];

      $minutes = $hours*60 + $minutes;
    }
    if(count($array) == 3) {
      $hours = (int)$array[0];
      $minutes = (int)$array[1];
      $seconds = (int)$array[2];

      $minutes = $hours*60 + $minutes + (int)($seconds/60);
    }

//    echo $minutes;
//    die();
    if($minutes == 0)
      throw new sfValidatorError($this, 'min_value');

    return $minutes;
  }
}
