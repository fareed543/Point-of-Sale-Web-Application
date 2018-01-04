<?php
$alert_msg = $this->session->flashdata('alert_msg');
$settingResult = $this->db->get_where('site_setting');
$settingData = $settingResult->row();
$setting_site_name = $settingData->site_name;
$setting_timezone = $settingData->timezone;
$setting_pagination = $settingData->pagination;
$setting_tax = $settingData->tax;
$setting_currency = $settingData->currency;
$setting_date = $settingData->datetime_format;
$setting_product = $settingData->display_product;
$setting_keyboard = $settingData->display_keyboard;
$setting_customer_id = $settingData->default_customer_id;
date_default_timezone_set("$setting_timezone");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1  maximum-scale=1" />
        <title><?php echo $setting_site_name; ?></title>
		<link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
		<link href="<?= base_url() ?>assets/css/pin-login.css" rel="stylesheet">
        <?php /*?>
		<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
		<?php */ ?>
        
        
        <!--[if lt IE 9]>
        <script src="<?= base_url() ?>assets/js/html5shiv.js"></script>
        <script src="<?= base_url() ?>assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body background="<?= base_url() ?>assets/images/login-backgrounds.jpg">
        <div class="pincode login_with_username_form" style="display:<?php echo (!empty($alert_msg)) ? 'block' : 'none'; ?>">
            <div id="anleitung">
                <?php
                if (!empty($alert_msg)) {
                    $flash_status = $alert_msg[0];
                    $flash_header = $alert_msg[1];
                    $flash_desc = $alert_msg[2];

                    if ($flash_status == 'failure') {
                        ?>
                        <div class="form-group warning-message" style="text-align: center; color: #c72a25; margin-top: 107px;    margin-bottom: -103px;">
                            <?php echo $flash_desc; ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="panel-heading">
                Login Page
                <br />
                <img src="<?= base_url() ?>assets/img/logo/logo.jpg" height="100px" />
            </div>
            <div class="panel-body table">
                <form action="<?= base_url() ?>auth/login" method="post" id="loginform">
                    <fieldset>
                        <div class="form-group">
                            <input type="hidden" name="pin" id="pin" placeholder="Pin" />
                            <input type="email" name="email" class="form-control" autofocus autocomplete="off" required placeholder="Email Address" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" />
                        </div>
                        <br />
                        <center>
                            <input type="submit" name="sp_login" class="btn btn-primary" value="Login">
                            <input type="button" class="btn btn-primary" id="login_with_pin" value="Login in with PIN">
                        </center>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="pin-section">
            <div class="pincode login_with_pin_form" style="display:<?php echo (!empty($alert_msg)) ? 'none' : 'block'; ?>">
                <div class="table">
                    <div class="cell">
                        <div id="anleitung">
                            <?php
                            if (!empty($alert_msg)) {
                                $flash_status = $alert_msg[0];
                                $flash_header = $alert_msg[1];
                                $flash_desc = $alert_msg[2];

                                if ($flash_status == 'failure') {
                                    ?>
                                    <div class="form-group warning-message" style="text-align: center; color: #c72a25; margin-top: 15px;">
                                        <?php echo $flash_desc; ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <p><strong>Please enter the correct PIN-Code.</strong></p>
                        </div>
                        <div id="fields">
                            <div class="grid">
                                <div class="grid__col grid__col--1-of-4 numberfield"><span></span></div>
                                <div class="grid__col grid__col--1-of-4 numberfield"><span></span></div>
                                <div class="grid__col grid__col--1-of-4 numberfield"><span></span></div>
                                <div class="grid__col grid__col--1-of-4 numberfield"><span></span></div>
                            </div>
                        </div>
                        <div id="numbers">
                            <div class="grid">
                                <div class="grid__col grid__col--1-of-3"><button>1</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>2</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>3</button></div>

                                <div class="grid__col grid__col--1-of-3"><button>4</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>5</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>6</button></div>

                                <div class="grid__col grid__col--1-of-3"><button>7</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>8</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>9</button></div>

                                <div class="grid__col grid__col--1-of-3"></div>
                                <div class="grid__col grid__col--1-of-3"><button>0</button></div>
                                <div class="grid__col grid__col--1-of-3"><button>DEL</button></div>
                            </div>
                        </div>
                        <div id="button">
                            <input type="button" class="btn btn-primary" id="login_with_username" value="Login with Username">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="login_footer">
            <div class="copy">&copy; <?php echo date('Y', time()); ?> - Test Codeigniter App - All Rights Reserved.</div>
        </div>
    </body>


    <script>
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
                            url: '<?= base_url() ?>auth/checkpin',
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
    </script>
</html>
