<?php /** @var Array $data */ ?>

<?php if ($data['error'] != "") { ?>
    <div class="alert alert-danger" role="alert">
        <?= $data['error'] ?>
    </div>
<?php } ?>
<?php if ($data['success'] != "") { ?>
    <div class="alert alert-success" role="alert">
        <?= $data['success'] ?>
    </div>
<?php } ?>
<h2>Zmena hesla</h2>
<form method="post" id="passwordForm" action="?c=portal&a=changePassword">
    <div class="form-group">
        <label>Pôvodné heslo</label>
        <input type="password" id="oldPassword" name="oldPassword" class="form-control">
    </div>
    <div class="form-group">
        <label>Nové heslo</label>
        <input type="password" id="newPassword" name="newPassword" class="form-control" onkeyup="validatePasswordMatch();" required>
    </div>
    <div class="form-group">
        <label>Heslo znovu</label>
        <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" class="form-control" onkeyup="validatePasswordMatch();" required>
    </div>
    <div id="passwordMatchError"></div>
    <input id="submitButton" type="submit" class="btn btn-primary" value="Ulož">
</form>