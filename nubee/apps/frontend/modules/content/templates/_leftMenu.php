<div id="menu">
  <h3>Products: <?php echo $products->count() ?></h3>
  <?php echo link_to('Add a new product', '@product_new') ?>
  <br />
  <br />
  <h3>Teams: <?php echo $teams->count() ?></h3>
  <?php echo link_to('Add a new team', '@team_new') ?>
  <br />
  <br />
  <h3>Users: <?php echo $users->count() ?></h3>
</div>
