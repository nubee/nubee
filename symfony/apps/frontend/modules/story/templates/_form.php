<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('story' => $form->getObject())) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('story', 'leftMenu', array('iteration' => $form->getObject()->getIteration())) ?>
<?php end_slot() ?>

<?php echo form_tag_for($form, '@story') ?>
  <table class="details">
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <button type="submit">Save</button>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
