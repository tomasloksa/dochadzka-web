<?php /** @var Array $data */ ?>
<div class="center-clock">
    <h1 id="current-time"></h1>
    <form class="buttons" action="?c=portal&a=addAction" method="get">
        <input type="hidden" name="c" value="portal">
        <input type="hidden" name="a" value="addAction">
        <?php for ($i = 1; $i <= count($data['actions']); $i++) { ?>
            <input class="btn btn-lg btn-primary" type="submit" name="action" value="<?= $data['actions'][$i] ?>">
        <?php } ?>
    </form>
</div>

<script type="text/javascript">
    displayClock();
</script>

