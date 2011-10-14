<?php use_stylesheet('list') ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('product' => $product)) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('product', 'leftMenu') ?>
<?php end_slot() ?>

<div class="sectionTitle">
  <h1>
    Product: <?php echo $product->getName() ?>
    <span class="actions">
      <?php echo edit_link_to2('Edit', 'product_edit', $product) ?>
      &nbsp;
      <?php echo delete_link_to2('Delete', 'product_delete', $product) ?>
    </span>
  </h1>
</div>

<div class="section">
  <?php echo format_text($product->getDescription()) ?>
</div>

<div class="section">
  <?php echo format_text($product->getDescription()) ?>
</div>

<div class="section">
  <h2>Details</h2>
  <table class="details">
    <tr>
      <th>Number of projects</th>
      <td>
        <?php echo $product->getProjects()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of iterations</th>
      <td>
        <?php echo $product->getIterations()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of stories</th>
      <td>
        <?php echo $product->getStories()->count() ?>
      </td>
    </tr>
    <tr>
      <th>Number of left tasks</th>
      <td>
        <?php echo __('%available% of %total%', array(
          '%available%' => $product->countAvailableTasks(),
          '%total%' => $product->countTasks()
        )) ?>
      </td>
    </tr>
  </table>
</div>

<div class="section">
  <h2>
    Projects
    <span class="actions">
      <?php echo add_link_to2('Add', '@project_new?product_id=' . $product->getId()) ?>
    </span>
  </h2>

  <?php include_partial('project/list', array('projects' => $product->getProjects())); ?>
</div>