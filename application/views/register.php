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
    </head>
    <body>
        <div class="pincode">
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
            
            <div class="panel-body table">
			Create Your Store
                <form action="<?= base_url() ?>auth/createstore" method="post" id="loginform">
                        <div class="form-group">
                            <input type="text" name="outlet" class="form-control" autofocus autocomplete="off" required placeholder="Outlet Name" />
                        </div>
						<div class="form-group">
                            <input type="text" name="contact_number" class="form-control" autofocus autocomplete="off" required placeholder="Contact Number" />
                        </div>
						<div class="form-group">
                            <input type="text" name="address" class="form-control" autofocus autocomplete="off" required placeholder="Address" />
                        </div>
						<div class="form-group">
                            <input type="text" name="owner" class="form-control" autofocus autocomplete="off" required placeholder="Owner Name" />
                        </div>
						<div class="form-group">
                            <input type="text" name="email" class="form-control" autofocus autocomplete="off" required placeholder="Email" />
                        </div>		
						<div class="form-group">
                            <input type="password" name="pin" class="form-control" placeholder="PIN" required autocomplete="off" />
                        </div>
						<div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" />
                        </div>
                        <center>
                            <input type="submit" name="register" class="btn btn-primary" value="CREATE NOW">
                        </center>
                </form>
            </div>
        </div>    
    </body>
    <script src="<?= base_url() ?>assets/js/login.js"></script>
</html>