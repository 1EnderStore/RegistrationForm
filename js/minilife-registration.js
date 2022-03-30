$(document).ready(function () {
    $("#form_registration_submit").submit(function (e) {
        minilife.registration.handleForm('/handler.php', this, e, true);
    });
});
