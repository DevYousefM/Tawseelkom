// Remove Alert Boxes After Two Seconds
let alert = document.getElementById("success") || document.getElementById("error") || document.getElementById(
  "message");
if (alert) {
  setTimeout(() => {
    alert.remove();
  }, 2000);
}
$(document).ready(function () {
  $(".password-toggle").on('click', function (event) {
    var passwordInput = $(this).parent().find('input');
    var passwordField = passwordInput.attr('type');
    if (passwordField === 'password') {
      passwordInput.attr('type', 'text');
    } else {
      passwordInput.attr('type', 'password');
    }
  });
});