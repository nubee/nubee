<?php if($iterations->count() > 0) : ?>
<table class="list">
  <thead>
    <tr>
      <th class="left width40">Name</th>
      <th class="center width10">Stories</th>
      <th class="center width10">Tasks</th>
      <th class="center width5">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($iterations as $i => $iteration): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td><?php echo link_to($iteration, 'iteration_show', $iteration) ?></td>
      <td class="center"><?php echo $iteration->getStories()->count() ?></td>
      <td class="center"><?php echo $iteration->getTasks()->count() ?></td>
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