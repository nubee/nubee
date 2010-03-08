<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('details') ?>

<?php slot('breadcrumbs') ?>
<?php include_partial('breadcrumbs', array('task' => $form->getObject())) ?>
<?php end_slot(); ?>

<?php slot('leftMenu') ?>
<?php include_component('backlogtask', 'leftMenu', array('project' => $form->getObject()->getProject())) ?>
<?php end_slot() ?>

<?php echo form_tag_for($form, '@backlogtask') ?>
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

<script type="text/javascript">
// Create the tooltips only on document load
$(document).ready(function()
{
   // Notice the use of the each() method to acquire access to each elements attributes
   $('#content img[tooltip]').each(function()
   {
      $(this).qtip({
         content: $(this).attr('tooltip'),
         style: 'blue'
      });
   });
});
</script>