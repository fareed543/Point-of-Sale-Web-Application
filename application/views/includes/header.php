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

if (isset($_COOKIE['outlet'])) {
    $this->load->helper('cookie');
    delete_cookie('outlet');
}

$login_name = '';
$this->db->where('id', $user_id);
$query = $this->db->get('users');
$result = $query->result();

$login_name = $result[0]->fullname;
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
        <script src="<?= base_url() ?>assets/jscolor/jscolor.js"></script>
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url() ?>dashboard">
                        <?php echo $setting_site_name; ?>
                    </a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $login_name; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?= base_url() ?>auth/logout"><i class="icono-power" style="color: #30a5ff;"></i> <?php echo $lang_logout; ?></a></li>
                            </ul>
                        </li>
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

        <?php
        if ($tk_c != 'pos') {
            ?>
            <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
                <ul class="nav menu">
                    <li <?php if ($tk_c == 'dashboard') {
                ?> class="active" <?php }
            ?>>
                        <a href="<?= base_url() ?>dashboard"><?php echo $lang_dashboard; ?></a>
                    </li>
                    <li <?php if ($tk_c == 'customers') {
                ?> class="active" <?php }
            ?>>
                        <a href="<?= base_url() ?>customers/view"><?php echo $lang_customers; ?></a>
                    </li>

                    <li <?php if ($tk_c == 'gift_card') {
                ?> class="parent active" <?php
                        } else {
                            echo 'class="parent"';
                        }
                        ?>>
                        <a data-toggle="collapse" href="#sub-item-gift">
                            <?php echo $lang_gift_card; ?>
                        </a>
                        <ul class="children <?php if ($tk_c != 'gift_card') {
                                ?> collapse <?php }
                            ?>" id="sub-item-gift">
                            <?php
                            if ($user_role == '1') {
                                ?>
                                <li>
                                    <a <?php if (($tk_m == 'add_gift_card')) {
                                    ?> style="background-color: #e9ecf2;" <?php }
                                ?> href="<?= base_url() ?>gift_card/add_gift_card">
                                            <?php echo $lang_add_gift_card; ?>
                                    </a>
                                </li>
                            <?php }
                            ?>
                            <li>
                                <a <?php if (($tk_m == 'list_gift_card')) {
                                ?> style="background-color: #e9ecf2;" <?php }
                            ?> href="<?= base_url() ?>gift_card/list_gift_card">
                                        <?php echo $lang_list_gift_card; ?>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li <?php if ($tk_c == 'debit') {
                                            ?> class="active" <?php }
                                        ?>>
                        <a href="<?= base_url() ?>debit/view"><?php echo $lang_debit; ?></a>
                    </li>

                    <li <?php if ($tk_c == 'sales') {
                                            ?> class="parent active" <?php
                        } else {
                            echo 'class="parent"';
                        }
                        ?>>
                        <a data-toggle="collapse" href="#sub-item-sales">
                            <?php echo $lang_sales; ?>
                        </a>
                        <ul class="children <?php if ($tk_c != 'sales') {
                                ?> collapse <?php }
                            ?>" id="sub-item-sales">
                            <li>
                                <a <?php if (($tk_m == 'list_sales')) {
                                ?> style="background-color: #e9ecf2;" <?php }
                            ?> href="<?= base_url() ?>sales/list_sales">
                                        <?php echo $lang_today_sales; ?>
                                </a>
                            </li>
                            <li>
                                <a <?php if (($tk_m == 'opened_bill')) {
                                            ?> style="background-color: #e9ecf2;" <?php }
                                        ?> href="<?= base_url() ?>sales/opened_bill">
                                        <?php echo $lang_opened_bill; ?>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php
                    if ($user_role < 3) {
                        ?>
                        <li <?php if ($tk_c == 'reports') {
                            ?> class="parent active" <?php
                            } else {
                                echo 'class="parent"';
                            }
                            ?>>
                            <a data-toggle="collapse" href="#sub-item-reports">
                                <?php echo $lang_reports; ?>
                            </a>
                            <ul class="children <?php if ($tk_c != 'reports') {
                                    ?> collapse <?php }
                                ?>" id="sub-item-reports">
                                <li>
                                    <a <?php if (($tk_m == 'sales_report')) {
                                    ?> style="background-color: #e9ecf2;" <?php }
                                ?> href="<?= base_url() ?>reports/sales_report">
                                            <?php echo $lang_sales_report; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php }
                    ?>



                    <li <?php if ($tk_c == 'expenses') {
                        ?> class="parent active" <?php
                        } else {
                            echo 'class="parent"';
                        }
                        ?>>
                        <a data-toggle="collapse" href="#sub-item-expenses">
                            <?php echo $lang_expenses; ?>
                        </a>
                        <ul class="children <?php if ($tk_c != 'expenses') {
                                ?> collapse <?php }
                            ?>" id="sub-item-expenses">
                            <li>
                                <a <?php if (($tk_m == 'view') || ($tk_m == 'addNewExpenses') || ($tk_m == 'searchExpenses') || ($tk_m == 'editExpenses')) {
                                ?> style="background-color: #e9ecf2;" <?php }
                            ?> href="<?= base_url() ?>expenses/view">
                                        <?php echo $lang_expenses; ?>
                                </a>
                                <?php
                                if ($user_role < 3) {
                                    ?>
                                    <a <?php if (($tk_m == 'expense_category') || ($tk_m == 'expense_category_add') || ($tk_m == 'expense_category_edit')) {
                                        ?> style="background-color: #e9ecf2;" <?php }
                                    ?> href="<?= base_url() ?>expenses/expense_category">
                                            <?php echo $lang_expenses_category; ?>
                                    </a>
                                <?php }
                                ?>
                            </li>
                        </ul>
                    </li>



                    <?php
                    if ($user_role == 1) {
                        ?>
                        <li <?php if (($tk_c == 'pnl')) {
                            ?> class="parent active" <?php
                            } else {
                                echo 'class="parent"';
                            }
                            ?>>
                            <a data-toggle="collapse" href="#sub-item-pnlreport">
                                <?php echo $lang_pnl; ?>
                            </a>
                            <ul class="children <?php if (($tk_c != 'pnl')) {
                                    ?> collapse <?php }
                                ?>" id="sub-item-pnlreport">
                                <li>
                                    <a <?php if (($tk_m == 'pnl_graph_view')) {
                                    ?> style="background-color: #e9ecf2;" <?php }
                                ?> href="<?= base_url() ?>pnl/pnl_graph_view">
                                            <?php echo $lang_pnl; ?>
                                    </a>
                                    <a <?php if (($tk_m == 'pnl_report')) {
                                                ?> style="background-color: #e9ecf2;" <?php }
                                            ?> href="<?= base_url() ?>pnl/pnl_report">
                                            <?php echo $lang_pnl_report; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php }
                    ?>


                    <li <?php if ($tk_c == 'pos') {
                        ?> class="active" <?php }
                    ?>>
                        <a href="<?= base_url() ?>pos"><?php echo $lang_pos; ?></a>
                    </li>

                    <li <?php if ($tk_c == 'returnorder') {
                        ?> class="parent active" <?php
                        } else {
                            echo 'class="parent"';
                        }
                        ?>>
                        <a data-toggle="collapse" href="#sub-item-return">
                            <?php echo $lang_return_order; ?>
                        </a>
                        <ul class="children <?php if ($tk_c != 'returnorder') {
                                ?> collapse <?php }
                            ?>" id="sub-item-return">
                            <li>
                                <a <?php if (($tk_m == 'create_return') || ($tk_m == 'confirmation')) {
                                ?> style="background-color: #e9ecf2;" <?php }
                            ?> href="<?= base_url() ?>returnorder/create_return">
                                        <?php echo $lang_create_return_order; ?>
                                </a>
                            </li>
                            <li>
                                <a <?php if (($tk_m == 'return_report')) {
                                            ?> style="background-color: #e9ecf2;" <?php }
                                        ?> href="<?= base_url() ?>returnorder/return_report">
                                        <?php echo $lang_return_order_report; ?>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li <?php if ($tk_c == 'inventory') {
                                            ?> class="active" <?php }
                                        ?>>
                        <a href="<?= base_url() ?>inventory/view"><?php echo $lang_inventory; ?></a>
                    </li>

                    <li <?php if ($tk_c == 'products') {
                                            ?> class="parent active" <?php
                        } else {
                            echo 'class="parent"';
                        }
                        ?>>
                        <a data-toggle="collapse" href="#sub-item-product">
                            <?php echo $lang_products; ?>
                        </a>
                        <ul class="children <?php if ($tk_c != 'products') {
                                ?> collapse <?php }
                            ?>" id="sub-item-product">
                            <li>
                                <a <?php if (($tk_m == 'list_products') || ($tk_m == 'addproduct')) {
                                ?> style="background-color: #e9ecf2;" <?php }
                            ?> href="<?= base_url() ?>products/list_products">
                                        <?php echo $lang_list_products; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>products/print_label">
                                    <?php echo $lang_print_product_label; ?>
                                </a>
                            </li>
                            <?php
                            if ($user_role == '1') {
                                ?>
                                <li>
                                    <a <?php if (($tk_m == 'product_category') || ($tk_m == 'addproductcategory') || ($tk_m == 'editproductcategory')) {
                                    ?> style="background-color: #e9ecf2;" <?php }
                                ?> href="<?= base_url() ?>products/product_category">
                                            <?php echo $lang_product_category; ?>
                                    </a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </li>


                    <?php
                    if ($user_role < 3) {
                        ?>
                        <li <?php if ($tk_c == 'purchase_order') {
                            ?> class="active" <?php }
                        ?>>
                            <a href="<?= base_url() ?>purchase_order/po_view"><?php echo $lang_purchase_order; ?></a>
                        </li>
                    <?php }
                    ?>

                    <li <?php if ($tk_c == 'setting') {
                        ?> class="parent active" <?php
                        } else {
                            echo 'class="parent"';
                        }
                        ?>>
                        <a data-toggle="collapse" href="#sub-item-1">
                            <?php echo $lang_setting; ?>
                        </a>
                        <ul class="children <?php if ($tk_c != 'setting') {
                                ?> collapse <?php }
                            ?>" id="sub-item-1">
                            <li>
                                <a <?php if (($tk_m == 'outlets') || ($tk_m == 'addoutlet') || ($tk_m == 'editoutlet')) {
                                ?> style="background-color: #e9ecf2;" <?php }
                            ?> href="<?= base_url() ?>setting/outlets">
                                        <?php echo $lang_outlets; ?>
                                </a>
                            </li>
                            <li>
                                <a <?php if (($tk_m == 'users') || ($tk_m == 'adduser') || ($tk_m == 'edituser')) {
                                            ?> style="background-color: #e9ecf2;" <?php }
                                        ?> href="<?= base_url() ?>setting/users">
                                        <?php echo $lang_users; ?>
                                </a>
                            </li>
                            <?php
                            if ($user_role == '1') {
                                ?>
                                <li>
                                    <a <?php if (($tk_m == 'suppliers') || ($tk_m == 'addsupplier') || ($tk_m == 'editsupplier')) {
                                    ?> style="background-color: #e9ecf2;" <?php }
                                ?> href="<?= base_url() ?>setting/suppliers">
                                            <?php echo $lang_suppliers; ?>
                                    </a>
                                </li>
                                <li>
                                    <a <?php if ($tk_m == 'system_setting') {
                                                ?> style="background-color: #e9ecf2;" <?php }
                                            ?> href="<?= base_url() ?>setting/system_setting">
                                            <?php echo $lang_system_setting; ?>
                                    </a>
                                </li>
                                <li>
                                    <a <?php if (($tk_m == 'payment_methods') || ($tk_m == 'addpaymentmethod') || ($tk_m == 'editpaymentmethod')) {
                                                ?> style="background-color: #e9ecf2;" <?php }
                                            ?> href="<?= base_url() ?>setting/payment_methods">
                                            <?php echo $lang_payment_methods; ?>
                                    </a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </li>
                    <li role="presentation" class="divider"></li>
                </ul>

            </div><!--/.sidebar-->
            <?php
        }
        ?>