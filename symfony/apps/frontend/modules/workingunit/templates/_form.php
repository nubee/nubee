<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<?php echo form_tag('@workingunit_create?id=' . $task->getId(), array('method' => 'put')) ?>
<div>
  <?php echo $form['effort_spent']->renderLabel(); ?> <?php echo $form['effort_spent']; ?>
  <?php echo $form['effort_spent']->renderHelp(); ?>
  <?php echo $form['date']->renderLabel(); ?> <?php echo $form['date']; ?>
  <?php echo $form['date']->renderHelp(); ?>
  <button type="submit">Add</button>
  <?php echo $form['effort_spent']->renderError(); ?>
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
</div>
</form>