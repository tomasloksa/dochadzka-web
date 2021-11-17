<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start flex-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Meno</th>
                        <th scope="col">Priezvisko</th>
                        <th scope="col">Mail</th>
                        <th>
                            <a href="?c=portal&a=employeeEdit" class="btn btn-success">
                                Pridať nového zamestnanca
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['employees'] as $employee) { ?>
                        <tr>
                            <th scope="row"><?= $employee->id ?></th>
                            <td><?= $employee->name ?></td>
                            <td><?= $employee->surname ?></td>
                            <td><?= $employee->mail ?></td>
                            <td>
                                <a href="?c=portal&a=removeEmployee&id=<?= $employee->id ?>" class="btn btn-info">
                                    Prehľad dochádzky
                                </a>
                                <a href="?c=portal&a=removeEmployee&id=<?= $employee->id ?>" class="btn btn-danger">
                                    Odstrániť
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
