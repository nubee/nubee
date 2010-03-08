<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('details') ?>


<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('project' => $form->getObject())) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('project', 'leftMenu', array('product' => $form->getObject()->getProduct())) ?>
<?php end_slot() ?>

<?php echo form_tag_for($form, '@project') ?>
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
