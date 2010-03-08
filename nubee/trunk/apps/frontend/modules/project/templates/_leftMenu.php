<div id="menu">
  <h3><?php echo $product ?></h3>
  <?php echo link_to('&laquo; Back to product', 'product_show', $product) ?>
  <br />
  <br />
  <h3>Projects</h3>
  <ul>
    <?php foreach ($projects as $project): ?>
    <li>
      <?php echo link_to($project, 'project_show', $project) ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <br />
  <?php echo link_to('Add a new project', '@project_new', $product) ?>
</div>
