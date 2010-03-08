<?php echo form_tag('@workingunit_create?id=' . $task->getId(), array('method' => 'put')) ?>
<div>
  <?php echo $form['effort_spent']->renderLabel(); ?> <?php echo $form['effort_spent']; ?>
  <?php echo $form['effort_spent']->renderHelp(); ?>
  <input type="submit" value="Add" />
  <?php echo $form['effort_spent']->renderError(); ?>
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
</div>
</form>