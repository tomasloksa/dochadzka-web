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
                                <a href="?c=portal&a=index&id=<?= $employee->id ?>" class="btn btn-info">
                                    Prehľad dochádzky
                                </a>
                                <a href="?c=portal&a=employeeEdit&id=<?= $employee->id ?>" class="btn btn-warning">
                                    Upraviť
                                </a>
                                <a onclick="deleteModal('<?= $employee->name ?> <?= $employee->surname ?>')"
                                   class="btn btn-danger">
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

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Naozaj si prajete ostrániť zamestnanca <i id="employee-name"></i> z dochádzky?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Návrat</button>
                <a href="?c=portal&a=removeEmployee&id=<?= $employee->id ?>" class="btn btn-danger">Odstrániť</a>
            </div>
        </div>
    </div>
</div>

