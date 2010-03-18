<?php

/**
 * Team form.
 *
 * @package    form
 * @subpackage Team
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TeamForm extends BaseTeamForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['users_list']);
  }
}