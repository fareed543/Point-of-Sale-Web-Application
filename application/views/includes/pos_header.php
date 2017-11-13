<?php
$user_id = $this->session->userdata('user_id');
$user_em = $this->session->userdata('user_email');
$user_role = $this->session->userdata('user_role');
$user_outlet = $this->session->userdata('user_outlet');

if (empty($user_id)) {
    redirect(base_url(), 'refresh');
}

$tk_c = $this->router->class;
$tk_m = $this->router->method;

$alert_msg = $this->session->flashdata('alert_msg');

$settingResult = $this->db->get_where('site_setting');
$settingData = $settingResult->row();

$setting_site_name = $settingData->site_name;
$setting_pagination = $settingData->pagination;
$setting_tax = $settingData->tax;
$setting_currency = $settingData->currency;
$setting_date = $settingData->datetime_format;
$setting_product = $settingData->display_product;
$setting_keyboard = $settingData->display_keyboard;
$setting_customer_id = $settingData->default_customer_id;
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

        <link href="<?= base_url() ?>assets/css/icono.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="<?= base_url() ?>assets/js/html5shiv.js"></script>
        <script src="<?= base_url() ?>assets/js/respond.min.js"></script>
        <![endif]-->

        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#closeAlert").click(function () {
                    $("#notificationWrp").fadeToggle(1000);
                });
            });
        </script>
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url() ?>dashboard">
                        <?php echo $setting_site_name; ?>
                    </a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?= base_url() ?>auth/logout"><i class="icono-power" style="color: #30a5ff;"></i> <?php echo $lang_logout; ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown pull-right">
                            <a href="<?= base_url() ?>dashboard" style="text-decoration: none; color: #005b8a;">
                                <span style="">
                                    <img src="<?= base_url() ?>assets/img/home_icon.png" style="height: 28px; margin-top: -5px;" />
                                </span>
                            </a>
                        </li>
                        <?php
                        if ($user_role == '1') {
                            if (isset($_COOKIE['outlet'])) {
                                ?>
                                <li class="dropdown pull-right" style="margin-right: 10px;">
                                    <a href="#openedBill" data-toggle="modal" style="text-decoration: none;">
                                        <div style="background-color: #c72a25; color: #FFF; padding: 7px 6px; border-radius: 3px; margin-top: -5px;">
                                            &nbsp;<?php echo $lang_opened_hold; ?>
                                        </div>
                                    </a>
                                </li>

                                <li class="dropdown pull-right" style="margin-right: 10px;">
                                    <a href="#totalSales" data-toggle="modal" style="text-decoration: none;">
                                        <div style="background-color: #3fb618; color: #FFF; padding: 7px 6px; border-radius: 3px; margin-top: -5px;">
                                            &nbsp;<?php echo $lang_today_sales; ?>
                                        </div>
                                    </a>
                                </li>

                                <?php
                            }
                        } else {
                            ?>
                            <li class="dropdown pull-right" style="margin-right: 10px;">
                                <a href="#openedBill" data-toggle="modal" style="text-decoration: none;">
                                    <div style="background-color: #c72a25; color: #FFF; padding: 7px 6px; border-radius: 3px; margin-top: -5px;">
                                        &nbsp;<?php echo $lang_opened_hold; ?>
                                    </div>
                                </a>
                            </li>

                            <li class="dropdown pull-right" style="margin-right: 10px;">
                                <a href="#totalSales" data-toggle="modal" style="text-decoration: none;">
                                    <div style="background-color: #3fb618; color: #FFF; padding: 7px 6px; border-radius: 3px; margin-top: -5px;">
                                        &nbsp;<?php echo $lang_today_sales; ?>
                                    </div>
                                </a>
                            </li>

                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php
                                $temp_site_lang = $this->session->userdata('site_lang');
                                if ($temp_site_lang == 'english') {
                                    echo '<img src="' . base_url() . 'assets/img/english_flag.png" />';
                                } elseif ($temp_site_lang == 'spanish') {
                                    echo '<img src="' . base_url() . 'assets/img/spanish_flag.png" />';
                                } else {
                                    echo '<img src="' . base_url() . 'assets/img/english_flag.png" />';
                                }
                                ?>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?= base_url() ?>LangSwitch/switchLanguage/english" style="text-decoration: none; color: #00598c;">
                                        <img src="<?= base_url() ?>assets/img/english_flag.png" /> &nbsp;&nbsp;English
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>LangSwitch/switchLanguage/spanish" style="text-decoration: none; color: #00598c;">
                                        <img src="<?= base_url() ?>assets/img/spanish_flag.png" /> &nbsp;&nbsp;Spanish
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>