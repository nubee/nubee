<?php

class sfWidgetFormSchemaFormatterDiv extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "%label% \n %field% %help% %error% %hidden_fields%\n",
    $errorRowFormat  = "%errors%",
    $helpFormat      = '<span style="position: relative"><img src="/images/help.png" class="help" tooltip="%help%" alt="" /></span>',
    $decoratorFormat = "<div>\n  %content%</div>";
}
