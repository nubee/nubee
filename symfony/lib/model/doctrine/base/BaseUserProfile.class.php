<?php

/**
 * BaseUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $picture_url
 * @property sfGuardUser $User
 * 
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method string      getPictureUrl()  Returns the current record's "picture_url" value
 * @method sfGuardUser getUser()        Returns the current record's "User" value
 * @method UserProfile setUserId()      Sets the current record's "user_id" value
 * @method UserProfile setPictureUrl()  Sets the current record's "picture_url" value
 * @method UserProfile setUser()        Sets the current record's "User" value
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_profile');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unique' => true,
             ));
        $this->hasColumn('picture_url', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}