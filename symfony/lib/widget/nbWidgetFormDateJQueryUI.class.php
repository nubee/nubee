<?php

class nbWidgetFormDateJQueryUI extends sfWidgetForm
{

  /**
   * Configures the current widget.
   *
   * Available options:
   *
   * @param string   culture           Sets culture for the widget
   * @param boolean  change_month      If date chooser attached to widget has month select dropdown, defaults to false
   * @param boolean  change_year       If date chooser attached to widget has year select dropdown, defaults to false
   * @param integer  number_of_months  Number of months visible in date chooser, defaults to 1
   * @param boolean  show_button_panel If date chooser shows panel with 'today' and 'done' buttons, defaults to false
   * @param string   theme             css theme for jquery ui interface, defaults to '/sfJQueryUIPlugin/css/ui-lightness/jquery-ui.css'
   * 
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    if(sfContext::hasInstance())
      $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
    else
      $this->addOption('culture', "en");
    $this->addOption('change_month', false);
    $this->addOption('change_year', false);
    $this->addOption('number_of_months', 1);
    $this->addOption('show_button_panel', false);
    $this->addOption('show_on', "both");
    $this->addOption('button_image', "/images/icons/calendar.png");
    $this->addOption('button_image_only', true);

    parent::configure($options, $attributes);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $attributes = $this->getAttributes();

    $input = new sfWidgetFormInput(array(), $attributes);

    $html = $input->render($name, $value);

    $id = $input->generateId($name);
    $culture = $this->getOption('culture');
    $cm = $this->getOption("change_month") ? "true" : "false";
    $cy = $this->getOption("change_year") ? "true" : "false";
    $nom = $this->getOption("number_of_months");
    $sbp = $this->getOption("show_button_panel") ? "true" : "false";
    $showOn = $this->getOption("show_on");
    $buttonImage = $this->getOption("button_image");
    $bio = $this->getOption("button_image_only") ? "true" : "false";
    
    if($culture != 'en') {
      $html .= <<<EOHTML
<script type="text/javascript">
	$(function() {
    var params = $.datepicker.regional['$culture'];
    params.changeMonth = $cm;
    params.changeYear = $cy;
    params.numberOfMonths = $nom;
    params.showButtonPanel = $sbp;
    params.showOn = '$showOn';
    params.buttonImage = '$buttonImage';
		params.buttonImageOnly = $bio;
    $("#$id").datepicker(params);
	});
</script>
EOHTML;
    } 
    else {
      $html .= <<<EOHTML
<script type="text/javascript">
	$(function() {
    var params = {
      changeMonth : $cm,
      changeYear : $cy,
      numberOfMonths : $nom,
      showButtonPanel : $sbp,
      showOn : '$showOn',
      buttonImage: '$buttonImage',
      buttonImageOnly: $bio
    };
    $("#$id").datepicker(params);
	});
</script>
EOHTML;
    }

    return $html;
  }

  /*
   *
   * Gets the stylesheet paths associated with the widget.
   *
   * @return array An array of stylesheet paths
   */

  public function getStylesheets()
  {
//    $theme = $this->getOption('theme');
//    return array($theme => 'screen');
    return array();
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavaScripts()
  {
    //check if jquery is loaded
    $js = array();
    /*    if (sfConfig::has('sf_jquery_web_dir') && sfConfig::has('sf_jquery_core'))
      $js[] = sfConfig::get('sf_jquery_web_dir').'/js/'.sfConfig::get('sf_jquery_core');
      else
      $js[] = '/sfJQueryUIPlugin/js/jquery-1.3.1.min.js';

      $js[] = '/sfJQueryUIPlugin/js/jquery-ui.js';

      $culture = $this->getOption('culture');
      if ($culture!='en')
      $js[] = '/sfJQueryUIPlugin/js/i18n/ui.datepicker-'.$culture.".js";

     */ return $js;
  }

}
