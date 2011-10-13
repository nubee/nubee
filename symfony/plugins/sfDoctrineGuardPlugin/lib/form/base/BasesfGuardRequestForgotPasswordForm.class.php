<?php

/**
 * BasesfGuardRequestForgotPasswordForm for requesting a forgot password email
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardRequestForgotPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class BasesfGuardRequestForgotPasswordForm extends BaseForm
{
  public function setup()
  {
    $this->widgetSchema['email_address'] = new sfWidgetFormInputText();
    $this->validatorSchema['email_address'] = new sfGuardValidatorUsernameOrEmail(
      array('trim' => true),
      array('required' => 'Your username or e-mail address is required.', 'invalid' => 'Username or e-mail address not found please try again.')
    );

    $this->widgetSchema->setNameFormat('forgot_password[%s]');
  }
}
