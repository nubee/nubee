<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('product' => $product)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('product', 'leftMenu') ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <div class="actions">
    <?php echo edit_link_to2('Edit', 'product_edit', $product) ?>
    &nbsp;
    <?php echo delete_link_to2('Delete', 'product_delete', $product) ?>
  </div>
  <h1>
    Product: <?php echo $product->getName() ?>
  </h1>
</div>

<div class="section">
  <?php echo format_text($product->getDescription()) ?>
</div>

<div class="section">
  <div class="actions">
    <?php echo add_link_to2('Add', '@project_new?product_id=' . $product->getId()) ?>
  </div>
  <h2>
    Projects
  </h2>

  <?php include_partial('project/list', array('projects' => $product->getProjects())); ?>
</div>