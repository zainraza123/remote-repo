$(document).ready(function () {
    $("#togglePassword").change(function () {

        // Check the checkbox state
        if ($(this).is(':checked')) {
            // Changing type attribute
            $("#password").attr("type", "text");

            // Change the Text
            $("#toggleText").text("Hide");
        } else {
            // Changing type attribute
            $("#password").attr("type", "password");

            // Change the Text
            $("#toggleText").text("Show");
        }

    });
});