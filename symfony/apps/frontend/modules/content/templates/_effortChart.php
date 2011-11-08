<div class="chart_box">
  <div id="<?php echo $id ?>"></div>
</div>


<?php //echo format_efforts($item, $children, true) ?>
<script>
$(function() {
  <?php $originalEstimate = $item->getOriginalEstimate() / $length ?>
  <?php $currentEstimate = $item->getCurrentEstimate() / $length ?>
  <?php $effortSpent = $item->getEffortSpent() / $length ?>
  <?php $effortLeft = $item->getEffortLeft() / $length ?>

  var series = [];
  var options = [];
  
  var max = <?php echo max($originalEstimate, $currentEstimate); ?>;
  var original = [[0, <?php echo $originalEstimate ?>], [<?php echo $originalEstimate ?>, 0]];
  series.push(original);
  options.push({ color: '#00336f', label: 'Original estimate'});

  <?php if($currentEstimate != $originalEstimate) : ?>
  var current = [[<?php echo $effortSpent ?>, <?php echo $effortLeft?>], [<?php echo $currentEstimate ?>, 0]];
  series.push(current);
  options.push({ color: 'red', label: 'Current estimate'});
  <?php endif; ?>
  var count = <?php echo $children->count() ?>;
  var data = <?php echo format_efforts($item, $children, $length) ?>;
  series.push(data);
  options.push({ label: 'Effort left', color: '#a4e142', markerOptions: { style:'square' }});
  
  $.jqplot('<?php echo $id ?>', series, {
    series: options,
    axes:{ 
      xaxis: { 
        pad: 1.2,
        min: 0, max: max,
        numberTicks: count + 2,
        tickOptions: {
          formatString: '%d'
        }
      },
      yaxis: { 
        pad: 1.2,
        min: 0, max: max,
        numberTicks: count + 2,
        tickOptions: {
          formatString: '%d'
        }
      }
    },
    legend: { show: true }
  });
});  
</script>