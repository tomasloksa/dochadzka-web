<?php /** @var Array $data */ ?>

<h3>Dochádzka používateľa: <?= $data['name'] ?></h3>
<h3><?= date('F Y', mktime(0, 0, 0, $data['month'], 1, $data['year'])); ?></h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Deň</th>
        <th scope="col">Typ</th>
        <?php 
          $max=0; 
          for ($day = 1; $day <= 31; $day++) {
            $max = max($max, count((array)$data['logs'][$day]));
          }
          for ($i = 0; $i <= $max; $i++) { ?>
            <th scope="col"></th>
        <?php } ?>
        <th scope="col">Spolu</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
      <tr>
          <th class="day-header" scope="row"><?= $day ?></th>
          <td onclick="changeDayType(<?= $day ?>, <?= $data['month']?>, <?= $data['year']?>, <?= $data['userId']?>)" class="type dropdown-toggle" id="changeDayType<?= $day ?>">
            <?= isset($data['days'][$day]) ? App\Models\DayType::DAYTYPE[$data['days'][$day]->dayType] : "Pracovný deň" ?>
          </td>
          <?php foreach ((array)$data['logs'][$day] as $action) { ?>
              <td onclick="editAction(&quot;<?= $action->time ?>&quot;, <?= $action->employeeId ?>, <?= $action->id ?>, <?= $action->action ?>)" class="action"><?= explode(" ", $action->time)[1] ?> <br> <?= App\Models\Actions::ACTIONS[$action->action] ?></td>
          <?php } ?>
          <td onclick="editAction('<?=$data['year']?>-<?=$data['month']?>-<?=$day?>', <?= $data['userId'] ?>)"><i class="fas fa-plus"></i></td>
      </tr>
    <?php } ?>
    </tbody>
</table>

<div class="modal fade" id="changeDayModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span>25. den. 2021 TODO</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="buttons day-type-select" method="post">
                    <?php foreach (App\Models\DayType::DAYTYPE as $dayType) { ?>
                        <input class="btn btn-lg btn-primary day-type" name="action" value="<?= $dayType ?>">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changeActionModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span id="modalHeaderDate"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="buttons day-type-select" method="post">
                    <label for="time" class="padding-left">Čas akcie:</label>
                    <input type="time" id="actionTime" required>
                    <label for="actionSelect">Akcia:</label>
                    <select name="action" id="actionSelect">
                      <?php foreach (App\Models\Actions::ACTIONS as $action) { ?>
                        <option name="action" value="<?= $action ?>"><?= $action ?></option>
                      <?php } ?>
                    </select>
                    <div class="modal-btns">
                      <button type="button" id="saveAction" class="btn btn-primary btn-modal">Uložiť</button>
                      <button type="button" id="deleteAction" class="btn btn-danger btn-modal">Zmazať</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>