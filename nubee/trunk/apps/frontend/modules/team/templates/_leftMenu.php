<div id="menu">
<?php if(isset($team) && !$team->isNew()) : ?>
  <h3>Team details</h3>
<?php else : ?>
  <h3>Teams</h3>
  <table class="details">
    <tbody>
      <tr>
        <th>Number of teams:</th>
        <td><?php echo $teams->count() ?></td>
      </tr>
    </tbody>
  </table>
  <br />
  <?php echo link_to('Add a new team', '@team_new') ?>
<?php endif; ?>
</div>
