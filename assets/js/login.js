jQuery(document).ready(function ($) {
    $(document).ready(function () {
        $("#login_with_username").on("click", function () {
            $("#pin").val();
            $(".warning-message").hide();
            $(".login_with_username_form").show();
            $(".login_with_pin_form").hide();
            return false;
        });
        $("#login_with_pin").on("click", function () {
            $("#pin").val();
            $(".warning-message").hide();
            $(".login_with_pin_form").show();
            $(".login_with_username_form").hide();
            return false;
        });

        var enterCode = "";
        enterCode.toString();
        var lengthCode = -1;
        $("#numbers button").click(function () {
            var clickedNumber = $(this).text().toString();
            if (clickedNumber == 'DEL') {
                enterCode = enterCode.substring(0, lengthCode);
                $("#fields .numberfield:eq(" + lengthCode + ")").removeClass("active");
                lengthCode--;
            } else {
                enterCode = enterCode + clickedNumber;
                lengthCode = parseInt(enterCode.length);
                lengthCode--;
                $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");
            }
            if (lengthCode == 3) {
                $.ajax({
                    url: 'auth/checkpin',
                    type: 'POST',
                    cache: false,
                    data: {
                        pin: enterCode
                    },
                    error: function () {
                        $("#fields").addClass("miss");
                        enterCode = "";
                        setTimeout(function () {
                            $("#fields .numberfield").removeClass("active");
                        }, 200);
                        setTimeout(function () {
                            $("#fields").removeClass("miss");
                        }, 500);
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            $("#fields .numberfield").addClass("right");
                            $("#numbers").addClass("hide");
                            $("#anleitung p").html("Loading...");
                            $("#pin").val(enterCode);
                            $("#loginform").submit();
                        } else {
                            $("#fields").addClass("miss");
                            enterCode = "";
                            setTimeout(function () {
                                $("#fields .numberfield").removeClass("active");
                            }, 200);
                            setTimeout(function () {
                                $("#fields").removeClass("miss");
                            }, 500);
                        }
                    }
                });
            }

        });

        $("#restartbtn").click(function () {
            enterCode = "";
            $("#fields .numberfield").removeClass("active");
            $("#fields .numberfield").removeClass("right");
            $("#numbers").removeClass("hide");
            $("#anleitung p").html("<strong>Please enter the correct PIN-Code.</strong><br> It is: 1234 / Also try a wrong code");
        });

    });
});