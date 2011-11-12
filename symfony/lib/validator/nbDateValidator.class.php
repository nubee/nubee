<?php 

/**
 * Extends sfValidatorDate
 * Convert a pattern date like d/m/Y to MySQL friendly Y-m-d or other pattern
 * @author Simon Hostelet
 *
 */
class nbDateValidator extends sfValidatorDate
{

	/**
	 * Configure the validator. Adding two more options to the regular validator
	 * input_date_format : date format from the form's input. Default is Y-m-d (ex: 2009-08-19)
	 * output_date_format : date format to get as output
	 * Allowed format masks:
	 * d : 01 to 31
	 * m : 01 to 12
	 * y : 00 to 99
	 * Y : example 2009
	 * Allowed format separators: /-_,. and space
	 * @see trunk/lib/vendor/symfony/lib/validator/sfValidatorDate#configure($options, $messages)
	 */
	protected function configure($options = array(), $messages = array())
  {
  	$this->addOption('input_date_format', 'Y-m-d');
  	$this->addOption('output_date_format', 'Y-m-d');

  	parent::configure($options, $messages);
  }

  /**
   * Override sfValidatorDate doClean. Quite strange : I had to copy/paste the original
   * code after my 'convertDateToFormat' method : a simple parent::doClean($value) would
   * not work !
   * @see trunk/lib/vendor/symfony/lib/validator/sfValidatorDate#doClean($value)
   */
	protected function doClean($value)
  {

  	$value = $this->convertDateToFormat($value);

// I had to copy/paste the rest of doClean, otherwise it wouldn't work ! I don't know why...
  	if (is_array($value))
    {
      $clean = $this->convertDateArrayToTimestamp($value);
    }
    else if ($regex = $this->getOption('date_format'))
    {
      if (!preg_match($regex, $value, $match))
      {
        throw new sfValidatorError($this, 'bad_format', array('value' => $value, 'date_format' => $this->getOption('date_format_error') ? $this->getOption('date_format_error') : $this->getOption('date_format')));
      }

      $clean = $this->convertDateArrayToTimestamp($match);
    }
    else if (!ctype_digit($value))
    {
      $clean = strtotime($value);
      if (false === $clean)
      {
        throw new sfValidatorError($this, 'invalid', array('value' => $value));
      }
    }
    else
    {
      $clean = (integer) $value;
    }

    if ($this->hasOption('max') && $clean > $this->getOption('max'))
    {
      throw new sfValidatorError($this, 'max', array('value' => $value, 'max' => date($this->getOption('date_format_range_error'), $this->getOption('max'))));
    }

    if ($this->hasOption('min') && $clean > $this->getOption('min'))
    {
      throw new sfValidatorError($this, 'min', array('value' => $value, 'min' => date($this->getOption('date_format_range_error'), $this->getOption('min'))));
    }

    return $clean === $this->getEmptyValue() ? $clean : date($this->getOption('with_time') ? $this->getOption('datetime_output') : $this->getOption('date_output'), $clean);
  }

  /**
   * converts the given date
   * $value must match the option 'input_date_format'. It will be convert to 'output_date_format'
   * For example : $value = 19/08/2009, input_date_format = DD/MM/YYYY, output_date_format = YYYY-MM-DD
   * Output will be 2009-08-19
   * @param $value
   * @return unknown_type
   * @author  Simon Hostelet
   */
  protected function convertDateToFormat($value)
  {

  	// we check if input/output_date_format are well written,
  	// we get the date separator, and the order of year, month and day in the mask
    $input_details = $this->getDateAlrightSeparatorAndOrder($this->getOption('input_date_format'));
    foreach($input_details as $key => $val)
    {
    	$key = 'input_' . $key;
    	$$key = $val;
    }
    $output_details = $this->getDateAlrightSeparatorAndOrder($this->getOption('output_date_format'));

    $input_date = explode($input_date_separator, $value);

    // is this date valid ?
    if(!checkdate(intval($input_date[$input_month_order]), intval($input_date[$input_day_order]), intval($input_date[$input_year_order])))
    {
    	throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }

    // let's build the output date
    $output_date = $this->getOption('output_date_format');
    $output_date = preg_replace('/Y|y/', $input_date[$input_year_order], $output_date);
    $output_date = preg_replace('/m/', $input_date[$input_month_order], $output_date);
    $output_date = preg_replace('/d/', $input_date[$input_day_order], $output_date);

    return $output_date;
  }

  /**
   * get a date format (like d/m/Y), check the format, and returns date separator (-/_, .)
   * and date order
   * @param $format
   * @return array
   * @author  Simon Hostelet
   */
  protected function getDateAlrightSeparatorAndOrder($format)
  {
    // does the date_format looks right ?
    if(!preg_match('/(d|m|y|Y)([-\/_,\. ]{1})(d|m|y|Y)([-\/_,\. ]{1})(d|m|y|Y)/', $format, $matches))
    {
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }

  	// what is the date separator ?
    preg_match('/[dmyY]{1}([\/\-,\._ ]{1})[dmyY]{1}/', $format, $matches);
    $return_array['date_separator'] = $matches[1];

    // what is the order of day, month and year in the format mask ?
    $date_order = explode($return_array['date_separator'], $format);
    foreach($date_order as $key => $val)
    {
      switch($val)
      {
        case 'd':
          $return_array['day_order'] = $key;
          break;
        case 'm':
          $return_array['month_order'] = $key;
          break;
        default:
          $return_array['year_order'] = $key;
      }
    }

    return $return_array;
  }
}