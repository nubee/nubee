<?php if($sf_user->isAuthenticated()) : ?>
<div id="menu">
  <h3>Products</h3>
  <?php echo link_to('&laquo; Back to products', 'product') ?>
  <br />
  <br />
  <ul>
    <?php foreach ($products as $product): ?>
    <li>
      <?php echo link_to($product, 'product_show', $product) ?>
    </li>
    <?php endforeach; ?>
  </ul>

</div>

<?php endif; ?>