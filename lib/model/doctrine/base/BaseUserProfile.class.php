<?php

/**
 * BaseUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $picture_url
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Teams
 * @property Doctrine_Collection $UserPerTeam
 * 
 * @method integer             getUserId()      Returns the current record's "user_id" value
 * @method string              getFirstName()   Returns the current record's "first_name" value
 * @method string              getLastName()    Returns the current record's "last_name" value
 * @method string              getEmail()       Returns the current record's "email" value
 * @method string              getPictureUrl()  Returns the current record's "picture_url" value
 * @method sfGuardUser         getUser()        Returns the current record's "User" value
 * @method Doctrine_Collection getTeams()       Returns the current record's "Teams" collection
 * @method Doctrine_Collection getUserPerTeam() Returns the current record's "UserPerTeam" collection
 * @method UserProfile         setUserId()      Sets the current record's "user_id" value
 * @method UserProfile         setFirstName()   Sets the current record's "first_name" value
 * @method UserProfile         setLastName()    Sets the current record's "last_name" value
 * @method UserProfile         setEmail()       Sets the current record's "email" value
 * @method UserProfile         setPictureUrl()  Sets the current record's "picture_url" value
 * @method UserProfile         setUser()        Sets the current record's "User" value
 * @method UserProfile         setTeams()       Sets the current record's "Teams" collection
 * @method UserProfile         setUserPerTeam() Sets the current record's "UserPerTeam" collection
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
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
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('picture_url', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Team as Teams', array(
             'refClass' => 'UserPerTeam',
             'local' => 'user_id',
             'foreign' => 'team_id'));

        $this->hasMany('UserPerTeam', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}