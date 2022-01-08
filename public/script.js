let modal, day, month, year, userId, id, time, action;

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

function changeDayType(paDay, paMonth, paYear, paUserId) {
    modal = new bootstrap.Modal(document.getElementById('changeDayModal'));
    modal.show();
    day = paDay;
    month = paMonth;
    year = paYear;
    userId = paUserId;
}

function editAction(paTime, paUserId, paId = null, paAction = -1) {
    modal = new bootstrap.Modal(document.getElementById('changeActionModal'));
    modal.show();
    time = new Date(paTime);
    id = paId;
    userId = paUserId;
    action = paAction;
      
    if (paAction == -1) {
      var now = new Date();
      $('#deleteAction').hide(0);
      $('#modalHeaderDate').text("Pridanie novej akcie");
      $('#actionTime').val(now.getHours().toString().padStart(2,0) + ":" + now.getMinutes().toString().padStart(2,0));
    } else {
      $('#modalHeaderDate').text(time.getDate() + "." + (time.getMonth() + 1) + "." + time.getFullYear());
      $('#actionTime').val(time.getHours().toString().padStart(2,0) + ":" + time.getMinutes().toString().padStart(2,0));
    }
}

$(document).ready(function(e) {   
  $('.day-type').click(function(e) {
      e.preventDefault();
      let dayType = $(this).val();
      $.ajax({
          type: "POST",
          url: "?c=portal&a=setDayType",
          data: { day, month, year, dayType, userId },
          success: function(response) {
            $('#changeDayType' + day).text(dayType);
            modal.hide();
          },
          error: function() {
              alert('Hodnotu sa nepodarilo ulozit!');
          }
      });
      return false;
  });

  $('#saveAction').click(function(e) {
    e.preventDefault();
    var selected = $('#actionTime').val().split(":");
    var newTime = new Date(time.getUTCFullYear(), time.getMonth(), time.getDate(), parseInt(selected[0]) + 1, selected[1]);
    $.ajax({
        type: "POST",
        url: "?c=portal&a=editAction",
        data: { id, userId, time: newTime.toISOString().slice(0, 19).replace('T', ' '), action: $('#actionSelect').prop('selectedIndex') + 1 },
        success: function(response) {
          modal.hide();
        },
        error: function() {
            alert('Hodnotu sa nepodarilo ulozit!');
        }
    });
    return false;
  });
  $('#deleteAction').click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "?c=portal&a=editAction",
        data: { id, action: -1 },
        success: function(response) {
          modal.hide();
        },
        error: function() {
            alert('Hodnotu sa nepodarilo ulozit!');
        }
    });
    return false;
  });
});