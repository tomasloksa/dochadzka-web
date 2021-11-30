<?php /** @var Array $data */ ?>

<?php if (isset($data['error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $data['error'] ?>
    </div>
<?php } ?>

<form method="post" action="?c=portal&a=saveEmployee">
    <input type="hidden" name="id" value="<?= $data['employee']->id ?? 0 ?>">
    <div class="form-group">
        <label>Meno</label>
        <input type="text" class="form-control" name="name" placeholder="Meno" value="<?= $data['employee']->name ?? "" ?>" maxlength="255" required>
    </div>
    <div class="form-group">
        <label>Priezvisko</label>
        <input type="text" class="form-control" name="surname" placeholder="Priezvisko" value="<?= $data['employee']->surname ?? "" ?>" maxlength="255" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="mail" placeholder="Email" value="<?= $data['employee']->mail ?? "" ?>" maxlength="255" required>
    </div>
    <input type="submit" class="btn btn-primary" value="Ulož">
</form>