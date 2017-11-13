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
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title><?php echo $setting_site_name; ?></title>

        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/css/datepicker3.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="<?= base_url() ?>assets/js/html5shiv.js"></script>
        <script src="<?= base_url() ?>assets/js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body style="background-color: #e1e0de;">

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="height: 175px;">
                        Login Page
                        <br />
                        <img src="<?= base_url() ?>assets/img/logo/logo.jpg" height="100px" />
                    </div>
                    <div class="panel-body">

                        <form action="<?= base_url() ?>auth/login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" autofocus autocomplete="off" required placeholder="Email Address" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" />
                                </div>
                                <br />
                                <center>
                                    <button class="btn btn-primary" name="sp_login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </center>

                                <?php
                                if (!empty($alert_msg)) {
                                    $flash_status = $alert_msg[0];
                                    $flash_header = $alert_msg[1];
                                    $flash_desc = $alert_msg[2];

                                    if ($flash_status == 'failure') {
                                        ?>
                                        <div class="form-group" style="text-align: center; color: #c72a25; margin-top: 15px;">
                                            <?php echo $flash_desc; ?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>


                            </fieldset>
                        </form>

                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->	



        <div class="login_footer">
            <div class="copy">&copy; <?php echo date('Y', time()); ?> - <?php echo $setting_site_name; ?> - All Rights Reserved.</div>
        </div>



    </body>
</html>
