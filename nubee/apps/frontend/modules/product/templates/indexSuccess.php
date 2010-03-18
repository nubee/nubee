<?php use_stylesheet('list') ?>

<div class="sectionTitle">
  <h1>
    Products
  </h1>
</div>

<div class="section">
  <?php if($products->count() > 0) : ?>
  <table class="list">
    <thead>
      <tr>
        <th class="left width40">Name</th>
        <th class="center width10">Projects</th>
        <th class="center width10">Iterations</th>
        <th class="center width10">Stories</th>
        <th class="center width10">Tasks</th>
        <th class="center width5">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $i => $product): ?>
      <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="left"><?php echo link_to($product, 'product_show', $product) ?></td>
        <td class="center"><?php echo $product->getProjects()->count() ?></td>
        <td class="center"><?php echo $product->getIterations()->count() ?></td>
        <td class="center"><?php echo $product->getStories()->count() ?></td>
        <td class="center"><?php echo $product->getTasks()->count() ?></td>
        <td class="center">
          <?php echo edit_link_to('product_edit', $product) ?>
          <?php echo delete_link_to('product_delete', $product) ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else : ?>
    <?php echo __('No products yet') ?>
  <?php endif; ?>
</div>