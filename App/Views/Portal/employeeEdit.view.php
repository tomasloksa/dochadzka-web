<?php /** @var Array $data */ ?>
<form method="post" action="?c=portal&a=saveEmployee">
    <input type="hidden" name="id" value="<?= $data['employee']->id ?? 0 ?>">
    <input type="text" name="name" placeholder="Meno" value="<?= $data['employee']->name ?? "" ?>">
    <input type="text" name="surname" placeholder="Priezvisko" value="<?= $data['employee']->surname ?? "" ?>">
    <input type="email" name="mail" placeholder="Email" value="<?= $data['employee']->mail ?? "" ?>">
    <input type="submit" value="Ulož">
</form>