<div class="breadcrumbs">
  <?php if(isset($team)) : ?>
    <?php echo link_to('Teams', 'team') ?> :
    <?php echo ($team->isNew() ? 'New team' : $team) ?>
  <?php else : ?>
    <?php echo 'Teams' ?>
  <?php endif; ?>
</div>