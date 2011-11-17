<?php use_stylesheet('list') ?>

<h1>Dashboard</h1>
<div class="section">
  <h2>My projects</h2>
  <?php include_partial('project/list', array('projects' => $myProjects, 'showCompleteName' => true)) ?>
  
  <h2>My tasks</h2>
  <?php include_partial('task/list', array('tasks' => $myTasks, 'showCompleteName' => true)) ?>
  
  <h2>Most active projects</h2>
  <?php include_partial('project/list', array('projects' => $projects, 'showCompleteName' => true)) ?>

  <h2>Most active stories</h2>
  <?php include_partial('story/list', array('stories' => $stories, 'showCompleteName' => true)) ?>
</div>