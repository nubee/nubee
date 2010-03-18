<?php use_stylesheet('list') ?>

<h1>Your Dashboard</h1>
<div class="section">
  <h2>Most active projects</h2>
  <?php include_partial('project/list', array('projects' => $projects)) ?>

  <h2>Most active stories</h2>
  <?php include_partial('story/list', array('stories' => $stories)) ?>
</div>