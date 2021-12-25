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
                <td class="action"><?= $data['days'][$day]->dayType ?? "Pracovný deň" ?></td>
                <?php foreach ((array)$data['logs'][$day] as $action) { ?>
                    <td class="action"><?= explode(" ", $action->time)[1] ?> <br> <?= App\Models\Actions::ACTIONS[$action->action] ?></td>
                <?php } ?>
            </tr>
    <?php } ?>
    </tbody>
</table>
