<?php

/**
 * BaseUserPerTeam
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $team_id
 * @property UserProfile $User
 * @property Team $Team
 * 
 * @method integer     getUserId()  Returns the current record's "user_id" value
 * @method integer     getTeamId()  Returns the current record's "team_id" value
 * @method UserProfile getUser()    Returns the current record's "User" value
 * @method Team        getTeam()    Returns the current record's "Team" value
 * @method UserPerTeam setUserId()  Sets the current record's "user_id" value
 * @method UserPerTeam setTeamId()  Sets the current record's "team_id" value
 * @method UserPerTeam setUser()    Sets the current record's "User" value
 * @method UserPerTeam setTeam()    Sets the current record's "Team" value
 * 
 * @package    nubee
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseUserPerTeam extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_per_team');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('team_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UserProfile as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Team', array(
             'local' => 'team_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}