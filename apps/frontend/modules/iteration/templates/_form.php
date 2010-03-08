<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('iteration' => $form->getObject())) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('iteration', 'leftMenu', array('project' => $form->getObject()->getProject())) ?>
<?php end_slot() ?>

<?php echo form_tag_for($form, '@iteration'); ?>
  <table class="details">
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>