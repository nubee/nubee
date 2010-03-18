<?php

/**
 * UserProfile form.
 *
 * @package    form
 * @subpackage UserProfile
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class UserProfileForm extends BaseUserProfileForm
{
  public function configure()
  {
    unset($this['user_id'], $this['created_at'], $this['updated_at']);

/*    $userForm = new sfGuardUserForm($this->getObject()->getUser());
    $this->mergeForm($userForm);
*/
    if($this->isNew()) {
      $this->widgetSchema->moveField('username', sfWidgetFormSchema::FIRST);
      $this->widgetSchema->moveField('password', sfWidgetFormSchema::AFTER, 'username');
      $this->widgetSchema->moveField('confirm_password', sfWidgetFormSchema::AFTER, 'password');
    }

    $this->widgetSchema['first_name']->setAttribute('class', 'width200f');
    $this->widgetSchema['last_name']->setAttribute('class', 'width200f');
    $this->widgetSchema['email']->setAttribute('class', 'width200f');
    $this->widgetSchema['picture_url'] = new sfWidgetFormInputFile(array());
    $this->validatorSchema['picture_url'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir') . '/pictures',
      'mime_types' => 'web_images',
    ));
/*    $this->widgetSchema['picture_url'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Picture',
      'file_src'  => '/uploads/pictures/' . $this->getObject()->getPictureUrl(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div id="pictureEdit">%file%</div>%input%',
    ));*/


    
    $this->widgetSchema->moveField('teams_list', sfWidgetFormSchema::LAST);
    $this->widgetSchema['teams_list']->setLabel('Teams');
  }
  
  public function updateObject($values = null)
  {
    parent::updateObject($values);
    
    if($this->isNew()) {
      $user = $this->object->getUser();
      $values = $this->processValues($this->values);
      $user->fromArray($values);
      $user->save();
      
      $this->object->setUser($user);
    }

    return $this->object;
  }
}