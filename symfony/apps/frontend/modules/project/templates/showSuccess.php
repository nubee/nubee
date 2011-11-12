<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('project' => $project)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('project', 'leftMenu', array('product' => $project->getProduct())) ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    Project: <?php echo $project->getName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'project_edit', $project) ?>
      &nbsp;
      <?php echo delete_link_to2('Delete', 'project_delete', $project) ?>
    </span>
  </h1>
</div>

<div class="section">
  <?php echo format_text($project->getDescription()) ?>
</div>

<div id="timeline" style="width:600px;height:300px;float:right"></div>
<script>
  var data = [
    // Marker for today
    {
      data: [[new Date(), 0], [new Date(), 1]],
      points: { show: false },
      color: '#00336f'
    },
    { 
      label: '<?php echo $project->getName() ?>',
      data: <?php echo format_flot_dates($project, 0.50) ?>,
      points: { symbol: "triangle" },
      color: '#000'
    }
    <?php foreach($project->getIterations() as $iteration) : ?>,
    { 
      label: '<?php echo $iteration->getName() ?>',
      data: <?php echo format_flot_dates($iteration, 0.35) ?>,
      points: { symbol: "circle" },
      color: '<?php echo $iteration->getColor() ?>'
    }
    <?php endforeach; ?>
  ];

  var startDate = new Date(<?php echo strtotime($project->getStartDate()) * 1000 ?>).addMonths(-1);
  var endDate = new Date(<?php echo strtotime($project->getEndDate()) * 1000 ?>).addMonths(1);
  
  $.plot($("#timeline"), data, { 
    xaxis: { 
      mode: "time",
      minTickSize: [1, "month"],
      min: startDate,
      max: endDate
    },
    yaxis: { 
      show: false,
      min: 0,
      max: 1
    },
    series: { 
      lines: { show: true },
      points: { show: true, radius: 3 } 
    },
    grid: { hoverable: true }
  });
  
  
  function showTooltip(x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css( {
      position: 'absolute',
      display: 'none',
      top: y + 5,
      left: x + 5,
      border: '1px solid #fdd',
      padding: '2px',
      'background-color': '#fee',
      opacity: 0.80
    }).appendTo("body").fadeIn(200);
  }  

  var previousPoint = null;  
  $("#timeline").bind("plothover", function (event, pos, item) {
    if (item) {
      if (previousPoint != item.dataIndex) {
        previousPoint = item.dataIndex;

        $("#tooltip").remove();
        var date = new Date(item.datapoint[0]);

        showTooltip(item.pageX, item.pageY, $.plot.formatDate(date, '%b %d'));
      }
    }
    else {
        $("#tooltip").remove();
        previousPoint = null;            
    }
  });  
</script>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tr>
      <th>Manager</th>
      <td><?php echo link_to($project->getManager(), 'user_show', $project->getManager()) ?></td>
    </tr>    
    <tr>
      <th>Start date</th>
      <td><?php echo format_date($project->getStartDate(), 'dd/M/yyyy') ?></td>
    </tr>
    <tr>
      <th>End date</th>
      <td><?php echo format_date($project->getEndDate(), 'dd/M/yyyy') ?></td>
    </tr>
    <tr>
      <th>Number of iterations</th>
      <td>
        <?php echo $project->getIterations()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of stories</th>
      <td>
        <?php echo $project->getStories()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of left tasks</th>
      <td>
        <?php echo __('%available% of %total%', array(
          '%available%' => $project->countAvailableTasks(),
          '%total%' => $project->countTasks()
        )) ?>
      </td>
    </tr>
    <tr>
      <th>Original estimate</th>
      <td><?php echo format_timestamp($project->getOriginalEstimate(), 'w') ?></td>
    </tr>
    <tr>
      <th>Current estimate</th>
      <td class="<?php echo get_estimate_class($project) ?>"><?php echo format_timestamp($project->getCurrentEstimate(), 'w') ?></td>
    </tr>
    <tr>
      <th>Effort spent</th>
      <td><?php echo format_timestamp($project->getEffortSpent(), 'w') ?></td>
    </tr>
    <tr>
      <th>Effort left</th>
      <td><?php echo format_timestamp($project->getEffortLeft(), 'w') ?></td>
    </tr>    
    <tr>
      <th>Members</th>
      <td>
        <ul>
          <?php if($project->hasMembers()) : ?>
          <?php foreach($project->getMembers() as $member) : ?>
          <li><?php echo link_to($member, 'user_show', $member) ?></li>
          <?php endforeach; ?>
          <?php else : ?>
          No members assigned to this project
          <?php endif; ?>
      </td>
    </tr>      
  </table>
</div>

<div class="section">
  <h2>
    Iterations
    <span class="actions">
      <?php echo add_link_to2('Add', '@iteration_new?project_id=' . $project->getId()) ?>
    </span>
  </h2>

  <?php include_partial('iteration/list', array('iterations' => $project->getIterations())) ?>
</div>

<div class="section">
  <h2>
    Backlog
    <span class="actions">
      <?php echo add_link_to2('Add task', '@backlogtask_new?project_id=' . $project->getId()) ?>
    </span>
  </h2>

  <?php include_partial('backlogtask/list', array('tasks' => $project->getBacklogTasks())) ?>
</div>

