<?php /** @var Array $data */ ?>
<form action="?c=portal&a=addAction" method="get">
    <input type="hidden" name="c" value="portal">
    <input type="hidden" name="a" value="addAction">
    <?php for ($i = 0; $i < count($data['actions']); $i++) { ?>
        <input class="btn btn-lg btn-primary" type="submit" name="action" value="<?= $data['actions'][$i] ?>">
    <?php } ?>
</form>
