<?php /** @var Array $data */ ?>

<h3>Dochádzka používateľa: <?= $data['name'] ?></h3>
<h3>December 2021</h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Deň</th>
        <th scope="col">Typ</th>
        <?php for ($i = 0; $i < 5; $i++) { ?>
            <th scope="col"></th>
        <?php } ?>
        <th scope="col">Spolu</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($day = 0; $day < 31; $day++) { ?>
            <tr>
                <th class="day-header" scope="row"><?= $day + 1 ?></th>
                <td onclick="changeDayType(<?= $day ?>)"
                    class="action"><?= $data['days'][$day]->dayType ?? "Pracovný deň" ?></td>
                <?php foreach ((array)$data['logs'][$day] as $action) { ?>
                    <td class="action"><?= explode(" ", $action->time)[1] ?> <br> <?= App\Models\Actions::ACTIONS[$action->action] ?></td>
                <?php } ?>
            </tr>
    <?php } ?>
    </tbody>
</table>

<div class="modal fade" id="changeDayModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span>25. den. 2021</span>
                <input type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form class="buttons" action="?c=portal&a=addAction" method="get">
                    <?php foreach (App\Models\Actions::ACTIONS as $action) { ?>
                        <input class="btn btn-lg btn-primary" id="day-type-button" type="submit" name="action" value="<?= $action ?>">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>