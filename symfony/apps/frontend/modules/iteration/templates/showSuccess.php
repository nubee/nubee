<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('iteration' => $iteration)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('iteration', 'leftMenu', array('project' => $iteration->getProject())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    Iteration: <?php echo $iteration->getName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'iteration_edit', $iteration) ?>
      &nbsp;
      <?php echo delete_link_to2('Delete', 'iteration_delete', $iteration) ?>
    </span>
  </h1>
</div>

<div class="section">
  <?php echo format_text($iteration->getDescription()) ?>
</div>

<div id="chart_box" style="width:600px;float: right;margin-bottom: 20px;">
  <div id="chart" ></div>
</div>

<?php include_partial('content/effortChart', array('item' => $iteration, 'children' => $iteration->getTasks())) ?>

<script>
  
/*

$(function(){
  var series = [];
  var options = [];
  <?php $originalEstimate = ($iteration->getOriginalEstimate()); ?>
  <?php $currentEstimate = ($iteration->getCurrentEstimate()); ?>
  
  series.push([
  <?php for($i = 0; $i <= $originalEstimate; $i += 60) : ?>
 <?php echo sprintf('[%s,%s],', $i, $originalEstimate - $i) ?>
<?php endfor ?> [<?php echo $originalEstimate ?>, 0]]);
  options.push({ color: '#00336f', label: 'Original estimate'});
    
  <?php if($currentEstimate != $originalEstimate) : ?>
  series.push([
  <?php for($i = 0; $i <= $currentEstimate; $i += 60) : ?>
    <?php echo sprintf('[%s,%s],', $i, $currentEstimate - $i) ?>
  <?php endfor ?>0]);
  options.push({ color: 'red', label: 'Current estimate'});
  <?php endif; ?>
    
  series.push([[<?php echo $iteration->getEffortSpent() ?>, <?php echo $currentEstimate - $iteration->getEffortSpent() ?>]]);
  options.push({ label: 'Effort spent', color: '#a4e142', markerOptions: { style:'square' }});
  
  $.jqplot('chart', series, {
    series: options,
    legend: { show: true }
  });
});  */
</script>

<div class="section">
  <h2>
    Details
  </h2>
  <table class="details">
    <tr>
      <th>Start date</th>
      <td><?php echo format_date($iteration->getStartDate(), 'd/M/y') ?></td>
    </tr>
    <tr>
      <th>Original estimate</th>
      <td><?php echo format_timestamp($iteration->getOriginalEstimate()) ?></td>
    </tr>
    <tr>
      <th>Current estimate</th>
      <td class="<?php echo get_estimate_class($iteration) ?>"><?php echo format_timestamp($iteration->getCurrentEstimate()) ?></td>
    </tr>
    <tr>
      <th>Effort spent</th>
      <td><?php echo format_timestamp($iteration->getEffortSpent()) ?></td>
    </tr>
    <tr>
      <th>Effort left</th>
      <td><?php echo format_timestamp($iteration->getEffortLeft()) ?></td>
    </tr>
    <tr>
      <th>Number of stories</th>
      <td>
        <?php echo $iteration->getStories()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of left tasks</th>
      <td>
        <?php echo __('%available% of %total%', array(
          '%available%' => $iteration->countAvailableTasks(),
          '%total%' => $iteration->countTasks()
        )) ?>
      </td>
    </tr>
  </table>
</div>

<div class="clear" style="clear:both;"></div>

<div class="section">
  <h2>
    Stories
    <span class="actions">
      <?php echo add_link_to2('Add', '@story_new?iteration_id=' . $iteration->getId()) ?>
    </span>
  </h2>
  <?php include_partial('story/list', array('stories' => $iteration->getStories())); ?>
</div>
