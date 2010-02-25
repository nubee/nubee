<div id="menu">
  <h3><?php echo $iteration ?></h3>
  <?php echo link_to('&laquo; Back to iteration', 'iteration_show', $iteration) ?>
  <br />
  <br />
  <h3>Stories</h3>
  <ul>
    <?php foreach ($stories as $story): ?>
    <li>
      <?php echo link_to($story, 'story_show', $story) ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <br />
  <?php echo link_to('Add a new story', '@story_new?iteration_id=' . $iteration->getId()) ?>

</div>
