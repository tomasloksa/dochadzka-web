<?php /** @var Array $data */ ?>

<h3>Dochádzka používateľa: <?= $data['name'] ?></h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id Akcie</th>
        <th scope="col">Id Zamestnanca</th>
        <th scope="col">Čas</th>
        <th scope="col">Akcia</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['logs'] as $log) { ?>
            <tr>
                <th scope="row"><?= $log->id ?></th>
                <td><?= $log->employeeId ?></td>
                <td><?= $log->time ?></td>
                <td><?= App\Models\Actions::ACTIONS[$log->action] ?></td>
            </tr>
    <?php } ?>
    </tbody>
</table>
