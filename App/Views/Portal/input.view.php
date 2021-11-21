<?php /** @var Array $data */ ?>
<form>
    <?php for ($i = 0; $i < count($data['actions']); $i++) { ?>
        <input class="btn btn-lg btn-primary" type="submit" name="action" value="<?= $data['actions'][$i] ?>" formaction="?c=portal&a=addAction&id=<?= $i ?>">
    <?php } ?>
</form>
