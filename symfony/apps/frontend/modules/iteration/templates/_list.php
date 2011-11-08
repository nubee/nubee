<?php if($iterations->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="left width40">Name</th>
      <th class="center width10">Stories</th>
      <th class="center width10">Tasks</th>
      <th class="center width5">OE</th>
      <th class="center width5">CE</th>
      <th class="center width5">EL</th>
      <th class="center width5">ES</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($iterations as $i => $iteration): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td><?php echo link_to($iteration, 'iteration_show', $iteration) ?></td>
      <td class="center"><?php echo $iteration->getStories()->count() ?></td>
      <td class="center"><?php echo $iteration->getTasks()->count() ?></td>
      <td class="center"><?php echo format_timestamp($iteration->getOriginalEstimate(), 'w') ?></td>
      <td class="center <?php echo get_estimate_class($iteration) ?>"><?php echo format_timestamp($iteration->getCurrentEstimate(), 'w') ?></td>
      <td class="center"><?php echo format_timestamp($iteration->getEffortLeft(), 'w') ?></td>
      <td class="center"><?php echo format_timestamp($iteration->getEffortSpent(), 'w') ?></td>      
      <td class="center">
        <?php echo edit_link_to('iteration_edit', $iteration) ?>
        <?php echo delete_link_to('iteration_delete', $iteration) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else : ?>
  <?php echo __('No iterations yet') ?>
<?php endif; ?>