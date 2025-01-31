$(document).ready(function () {

    // Map View
    $("#ShowMap").click(function () {
        $("#MapView").addClass("MapShow");
    });

    $("#MapClose").click(function () {
        $("#MapView").removeClass("MapShow");
    });

    // Forgot Password Modal
    $("#ForgotPassModal").click(function () {
        $("#ForgotModalView").addClass("ForgotShow");
    });

    $("#ForgotModalClose").click(function () {
        $("#ForgotModalView").removeClass("ForgotShow");
    });
});