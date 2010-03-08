<?php if($workingUnits->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="width70">User</th>
      <th class="center width15">Effort spent</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workingUnits as $i => $workingUnit): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="left"><?php echo $workingUnit->getUser() ?></td>
      <td class="center"><?php echo format_timestamp($workingUnit->getEffortSpent()) ?></td>
      <td class="center">
        <?php echo delete_link_to('workingunit_delete', $workingUnit) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No working units yet') ?>
<?php endif; ?>