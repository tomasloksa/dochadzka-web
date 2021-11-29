<h2>Zmena hesla</h2>

<form id="password-form" action="?c=portal&a=changePassword" onsubmit="return validatePasswordMatch()">
    <div class="form-group">
        <label>Pôvodné heslo</label>
        <input type="password" id="oldPassword" name="oldPassword" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nové heslo</label>
        <input type="password" id="newPassword" name="newPassword" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Heslo znovu</label>
        <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>