<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('user' => $form->getObject())) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('user', 'leftMenu', array('user' => $form->getObject())) ?>
<?php end_slot() ?>

<?php echo form_tag_for($form, '@user') ?>
  <table class="details">
    <tbody>
      <?php echo $form['first_name']->renderRow() ?>
      <?php echo $form['last_name']->renderRow() ?>
      <?php echo $form['email']->renderRow() ?>
      <?php echo $form['User']['password']->renderRow() ?>
      <?php echo $form['User']['confirm_password']->renderRow() ?>
      <?php echo $form['picture_url']->renderRow() ?>
      <?php if($sf_user->isAdministrator()) : ?>
        <?php echo $form['User']['is_active']->renderRow() ?>
        <?php echo $form['User']['is_super_admin']->renderRow() ?>
        <?php echo $form['User']['groups_list']->renderRow() ?>
        <?php echo $form['User']['permissions_list']->renderRow() ?>
      <?php endif ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          <?php echo $form->renderGlobalErrors() ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
