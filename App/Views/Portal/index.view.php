<?php /** @var Array $data */ ?>

<h3>Dochádzka používateľa: <?= $_SESSION['name'] ?></h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id Akcie</th>
        <th scope="col">Id Zamestnanca</th>
        <th scope="col">Cas</th>
        <th scope="col">Akcia</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['logs'] as $log) { ?>
            <tr>
                <th scope="row"><?= $log->id ?></th>
                <td><?= $log->employeeId ?></td>
                <td><?= $log->time ?></td>
                <td><?= $log->action ?></td>
            </tr>
    <?php } ?>
    </tbody>
</table>
