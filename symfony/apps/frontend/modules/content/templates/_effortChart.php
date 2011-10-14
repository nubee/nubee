<script>
$(function() {

  var series = [];
  var options = [];
  
  <?php $originalEstimate = $item->getOriginalEstimate()/60 ?>
  <?php $currentEstimate = $item->getCurrentEstimate()/60 ?>
  var max = <?php echo max($originalEstimate, $currentEstimate); ?>;
  var original = [[0, <?php echo $originalEstimate ?>], [<?php echo $originalEstimate ?>, 0]];
  series.push(original);
  options.push({ color: '#00336f', label: 'Original estimate'});

  <?php if($currentEstimate != $originalEstimate) : ?>
  var current = [[0, <?php echo $currentEstimate ?>], [<?php echo $currentEstimate ?>, 0]];
  series.push(current);
  options.push({ color: 'red', label: 'Current estimate'});
  <?php else : ?>
  var current = [];
  <?php endif; ?>
  var count = <?php echo $children->count() ?>;
  var data = <?php echo format_efforts($item, $children) ?>;
  series.push(data);
  options.push({ label: 'Effort left', color: '#a4e142', markerOptions: { style:'square' }});
  
  $.jqplot('chart', series, {
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