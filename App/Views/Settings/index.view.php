<?php /** @var Array $data */ ?>

<?php if ($data['error'] != "") { ?>
    <div class="alert alert-danger" role="alert">
        <?= $data['error'] ?>
    </div>
<?php } ?>

<?php if (isset($data['success'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $data['success'] ?>
    </div>
<?php } ?>

<div class="center">
    <?php if ($_SESSION['role'] == 1) { ?>
    <h2><b>Zmena názvu firmy</b></h2>
    <form method="post" id="companyNameForm" action="?c=settings&a=changeCompanyName">
        <div class="form-group">
            <label>Nový názov firmy</label>
            <input type="text" id="companyName" name="companyName" maxlength="255" class="form-control" value="<? echo $_SESSION['companyName'] ?>" required>
        </div>
        <input id="submitCompanyButton" type="submit" class="btn btn-primary" value="Ulož názov">
    </form>
    <?php } ?>

    <h2><b>Zmena hesla</b></h2>
    <form method="post" id="passwordForm" action="?c=settings&a=changePassword">
        <div class="form-group">
            <label>Pôvodné heslo</label>
            <input type="password" id="oldPassword" name="oldPassword" maxlength="255" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nové heslo</label>
            <input type="password" id="newPassword" name="newPassword" class="form-control" maxlength="255" onkeyup="validatePasswordMatch();" required>
        </div>
        <div class="form-group">
            <label>Heslo znovu</label>
            <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" class="form-control" maxlength="255" onkeyup="validatePasswordMatch();" required>
        </div>
        <div id="passwordMatchError"></div>
        <input id="submitPasswordButton" type="submit" class="btn btn-primary" value="Ulož heslo">
    </form>
</div>