<?php /** @var Array $data */ ?>

<h3>Dochádzka používateľa: <?= $data['name'] ?></h3>
<div class="index-date">
    <a class="btn btn-outline-dark" onclick="addMonth(-1, <?=$data['month']?>, <?=$data['year']?>)"><i class="fas fa-chevron-left"></i></a>
    <h3 class="current-month"><?= date('F Y', mktime(0, 0, 0, $data['month'], 1, $data['year'])); ?></h3>
    <a class="btn btn-outline-dark" onclick="addMonth(1, <?=$data['month']?>, <?=$data['year']?>)"><i class="fas fa-chevron-right"></i></a>
</div>
<div class="table-responsive">
  <table class="table">
      <thead>
      <tr>
          <th scope="col">Deň</th>
          <th scope="col">Typ</th>
          <?php 
            $max=0; 
            for ($day = 0; $day < 31; $day++) {
              $max = max($max, count((array)$data['logs'][$day]));
            }
            for ($i = 0; $i < $max; $i++) { ?>
              <th scope="col"></th>
          <?php } ?>
          <th scope="col">Spolu</th>
      </tr>
      </thead>
      <tbody>
      <?php for ($day = 1; $day <= date('t', mktime(0, 0, 0, $data['month'], 1, $data['year'])); $day++) { ?>
        <tr id="row<?=$day?>">
            <!-- HEADER -->
            <th class="day-header" scope="row"><?= $day ?></th>

            <!-- DAYTYPE -->
            <td <?php if (\App\Auth::isAdmin()) { ?> onclick="changeDayType(<?=$data['days'][$day - 1]->id?>, <?= $day ?>, <?= $data['month']?>, <?= $data['year']?>, <?= $data['userId']?>)" <?php } ?> 
                class="type <?php if (\App\Auth::isAdmin()) { ?>dropdown-toggle <?php } ?>" id="changeDayType<?= $day ?>">
                  <?= isset($data['days'][$day - 1]) ? App\Models\DayType::DAYTYPE[$data['days'][$day - 1]->dayType] : "Pracovný deň" ?>
            </td>

            <!-- ACTIONS -->
            <?php for ($i = 0; $i < $max; $i++) { ?>
              <?php if ($i < count((array)$data['logs'][$day - 1])) { ?>
                <?php $action = $data['logs'][$day - 1][$i] ?>
                  <td <?php if (\App\Auth::isAdmin()) { ?> onclick="editAction(<?= $i ?>, '<?= $action->time ?>', <?= $action->employeeId ?>, <?= $action->id ?>, <?= $action->action ?>)" <?php } ?> class="action">
                    <?= explode(" ", $action->time)[1] ?> <br> <?= App\Models\Action::ActionStrings[$action->action] ?>
                    <i class="far fa-edit"></i>
                  </td>
              <?php } else { echo "<td></td>"; } ?>
            <?php } ?>

            <!-- NEW ACTION -->
            <?php if (\App\Auth::isAdmin()) { ?>
              <td class="action" onclick="editAction(<?= $i + 1 ?>, '<?=$data['year']?>-<?=$data['month']?>-<?=$day?>', <?= $data['userId'] ?>)"><i class="fas fa-plus"></i></td>
            <?php } ?>
            
            <!-- TOTAL -->
            <td><?= $data['days'][$day - 1]->totalTime->format('G:i') ?></td>
        </tr>
      <?php } ?>
      </tbody>
  </table>
</div>

<div class="modal fade" id="changeDayModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span id="dayTypeHeaderDate"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="buttons" method="post">
                    <?php foreach (App\Models\DayType::DAYTYPE as $dayType) { ?>
                        <input class="btn btn-lg btn-primary day-type" name="action" value="<?= $dayType ?>">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changeActionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span id="actionHeaderDate"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="buttons day-type-select" method="post">
                    <label for="actionTime" class="padding-left">Čas akcie:</label>
                    <input type="time" id="actionTime" required>
                    <label for="actionSelect">Akcia:</label>
                    <select name="action" id="actionSelect">
                      <?php for ($i = 0; $i < count(App\Models\Action::ActionStrings); $i++) { ?>
                        <option value="<?= $i ?>"><?= App\Models\Action::ActionStrings[$i] ?></option>
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