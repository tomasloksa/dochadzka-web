<?php /** @var Array $data */ ?>
<div class="center-clock">
    <h1 id="current-time"></h1>
    <form class="buttons" action="?c=portal&a=addAction" method="get">
        <input type="hidden" name="c" value="portal">
        <input type="hidden" name="a" value="addAction">
        <?php for ($i = 0; $i < count(App\Models\Action::ActionStrings); $i++) { ?>
          <button class="btn btn-lg btn-primary" type="submit" name="action" value="<?= $i ?>">
            <?= App\Models\Action::ActionStrings[$i] ?>
          </button>
        <?php } ?>
    </form>
</div>

<script type="text/javascript">
    displayClock();
</script>

