<div class="sectionTitle">
  <div class="actions">
    <?php include_slot('actions'); ?>
  </div>
  <h1>
    <?php echo $title ?>
  </h1>
  <?php include_slot('breadcrumbs') ?>
</div>
<script type="text/javascript">
    // test auto-ready logic - call corner before DOM is ready
  $('.sectionTitle').corner("round 8px");
</script>