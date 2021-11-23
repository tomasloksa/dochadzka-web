<?php /** @var Array $data */ ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">EmployeeId</th>
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
