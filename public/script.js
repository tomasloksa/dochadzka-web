let modal;

function displayClock() {
    const element = document.getElementById('current-time');

    updateClock(element);
    setInterval(_ => { updateClock(element); }, 1000);
}

function updateClock(element) {
    const date = new Date();
    let hours = date.getHours().toString().padStart(2, "0");
    let minutes = date.getMinutes().toString().padStart(2, "0");
    let seconds = date.getSeconds().toString().padStart(2, "0");
    element.innerText = hours + ":" + minutes + ":" + seconds;
}

function validatePasswordMatch() {
    var pass1 = document.getElementById('newPassword').value;
    var pass2 = document.getElementById('newPasswordRepeat').value;

    var errorDiv = document.getElementById('passwordMatchError');
    var button = document.getElementById('submitButton');
    
    if (pass1 != pass2 && pass2 != "") {
        errorDiv.innerText = "Heslá sa nezhodujú!";
        errorDiv.classList.add('text-danger');
        button.disabled = true;
    }
    else {
        errorDiv.innerText = "";
        button.disabled = false;
    }
}

function deleteModal(employeeName) {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
    let name = document.getElementById('employeeName');
    name.innerText = employeeName;
}

function changeDayType(day) {
    modal = new bootstrap.Modal(document.getElementById('changeDayModal'));
    modal.show();
}

$(document).ready(function(e) {   
  $('.day-type').click(function(e) {
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "?c=portal&a=setDayType",
          success: function(response) {
            $('#changeDayType2').text("Ahoj");
            modal.hide();
          },
          error: function() {
              alert('Hodnotu sa nepodarilo ulozit!');
          }
      });
      return false;
  });
});