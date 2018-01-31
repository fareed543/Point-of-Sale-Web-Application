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


/* echo $tk_c; // controller 
  echo $tk_m; // action
  exit; */

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
?>
<!DOCTYPE html>
<html ng-app="">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?php echo $setting_site_name; ?></title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Custom Css -->
        <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="<?= base_url() ?>assets/css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="index.html"><?php echo $setting_site_name; ?></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Call Search -->
                        <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                        <!-- #END# Call Search -->
                        <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="image">
                        <img src="<?= base_url() ?>assets/images/user.png" width="48" height="48" alt="User" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('fullname'); ?></div>
                        <div class="email"><?php echo $this->session->userdata('user_email'); ?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                                <li role="seperator" class="divider"></li>
                                <!--<li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                                        <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                                        <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                                <li role="seperator" class="divider"></li>-->
                                <li><a href="<?= base_url() ?>auth/logout"><i class="material-icons">input</i><?php echo $lang_logout; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>

                        <li <?php if ($tk_c == 'dashboard') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url() ?>dashboard">
                                <i class="material-icons">home</i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li <?php if ($tk_c == 'customers') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url() ?>customers/view">
                                <i class="material-icons">people</i>
                                <span><?php echo $lang_customers; ?></span>
                            </a>
                        </li>

                        <li <?php if ($tk_c == 'gift_card') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url() ?>gift_card/list_gift_card">
                                <i class="material-icons">card_giftcard</i>
                                <span><?php echo $lang_gift_card; ?></span>
                            </a>
                        </li>



                        <li <?php if ($tk_c == 'pos') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url() ?>pos">
                                <i class="material-icons">add_shopping_cart</i>
                                <span><?php echo $lang_pos; ?></span>
                            </a>
                        </li>


                        <li <?php if (($tk_c == 'sales') || ($tk_c == 'debit') || ($tk_c == 'pnl_graph_view')) { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">map</i>
                                <span>Orders</span>
                            </a>
                            <ul class="ml-menu">

                                <li <?php if ($tk_m == 'opened_bill') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>sales/opened_bill">
                                        <span><?php echo $lang_opened_bill; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_m == 'list_sales') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>sales/list_sales">
                                        <span><?php echo $lang_sales; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_m == 'view') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>debit/view">
                                        <span><?php echo $lang_debit; ?></span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li <?php if (($tk_c == 'returnorder') || ($tk_c == 'pnl') || ($tk_c == 'reports')) { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">map</i>
                                <span>Reports</span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if ($tk_m == 'pnl_report') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>pnl/pnl_report">
                                        <span><?php echo $lang_pnl_report; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_m == 'pnl_graph_view') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>pnl/pnl_graph_view">
                                        <span><?php echo $lang_pnl; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_m == 'return_report') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>returnorder/return_report">
                                        <span><?php echo $lang_return_order_report; ?></span>
                                    </a>
                                </li>


                                <li <?php if ($tk_m == 'create_return') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>returnorder/create_return">
                                        <span><?php echo $lang_create_return_order; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_c == 'reports') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>reports/sales_report">
                                        <span><?php echo $lang_sales_report; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li <?php if (($tk_c == 'inventory') || ($tk_c == 'products') || ($tk_m == 'product_category') || ($tk_m == 'addproductcategory') || ($tk_m == 'editproductcategory')) { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">map</i>
                                <span>Catalog</span>
                            </a>
                            <ul class="ml-menu">

                                <li <?php if (($tk_c == 'products') && $tk_m == 'list_products') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>products/list_products">
                                        <span><?php echo $lang_products; ?></span>
                                    </a>
                                </li>

                                <li <?php if (($tk_c == 'products') && (($tk_m == 'product_category') || ($tk_m == 'addproductcategory') || ($tk_m == 'editproductcategory'))) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>products/product_category">
                                        <span><?php echo $lang_product_category; ?></span>
                                    </a>
                                </li>

                                <li <?php if (($tk_c == 'inventory') && ($tk_m == 'view')) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>inventory/view">
                                        <span><?php echo $lang_inventory; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li <?php if (($tk_c == 'setting') || ($tk_c == 'expenses')) { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">map</i>
                                <span>Settings</span>
                            </a>
                            <ul class="ml-menu">

                                <li <?php if (($tk_m == 'outlets') || ($tk_m == 'addoutlet') || ($tk_m == 'editoutlet')) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>setting/outlets">
                                        <span><?php echo $lang_outlets; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_m == 'system_setting') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>setting/system_setting">
                                        <span><?php echo $lang_system_setting; ?></span>
                                    </a>
                                </li>

                                <li <?php if (($tk_m == 'payment_methods') || ($tk_m == 'addpaymentmethod') || ($tk_m == 'editpaymentmethod')) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>setting/payment_methods">
                                        <span><?php echo $lang_payment_methods; ?></span>
                                    </a>
                                </li>

                                <li <?php if (($tk_c == 'expenses') && ($tk_m == 'view')) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>expenses/view">
                                        <span><?php echo $lang_expenses; ?></span>
                                    </a>
                                </li>

                                <li <?php if ($tk_m == 'expense_category') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>expenses/expense_category">
                                        <span><?php echo $lang_expenses_category; ?></span>
                                    </a>
                                </li>


                                <li <?php if (($tk_m == 'users') || ($tk_m == 'adduser') || ($tk_m == 'edituser')) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>setting/users">
                                        <span><?php echo $lang_users; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li <?php if (($tk_m == 'suppliers') || ($tk_m == 'addsupplier') || ($tk_m == 'editsupplier') || ($tk_c == 'purchase_order')) { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">map</i>
                                <span>Suppliers</span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if (($tk_m == 'suppliers') || ($tk_m == 'addsupplier') || ($tk_m == 'editsupplier')) { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>setting/suppliers">
                                        <span><?php echo $lang_suppliers; ?></span>
                                    </a>
                                </li>
                                <li <?php if ($tk_c == 'purchase_order') { ?> class="active" <?php } ?>>
                                    <a href="<?= base_url() ?>purchase_order/po_view">
                                        <span><?php echo $lang_purchase_order; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>



                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2018 <a href="javascript:void(0);"><?php echo $setting_site_name; ?></a>.
                    </div>
                    <!--<div class="version">
                            <b>Version: </b> 1.0.0
                    </div>-->
                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            <aside id="rightsidebar" class="right-sidebar">
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation"><a href="#skins" data-toggle="tab">SKINS</a></li>
                    <li role="presentation" class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="skins">
                        <ul class="demo-choose-skin">
                            <li data-theme="red" class="active">
                                <div class="red"></div>
                                <span>Red</span>
                            </li>
                            <li data-theme="pink">
                                <div class="pink"></div>
                                <span>Pink</span>
                            </li>
                            <li data-theme="purple">
                                <div class="purple"></div>
                                <span>Purple</span>
                            </li>
                            <li data-theme="deep-purple">
                                <div class="deep-purple"></div>
                                <span>Deep Purple</span>
                            </li>
                            <li data-theme="indigo">
                                <div class="indigo"></div>
                                <span>Indigo</span>
                            </li>
                            <li data-theme="blue">
                                <div class="blue"></div>
                                <span>Blue</span>
                            </li>
                            <li data-theme="light-blue">
                                <div class="light-blue"></div>
                                <span>Light Blue</span>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan"></div>
                                <span>Cyan</span>
                            </li>
                            <li data-theme="teal">
                                <div class="teal"></div>
                                <span>Teal</span>
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                                <span>Green</span>
                            </li>
                            <li data-theme="light-green">
                                <div class="light-green"></div>
                                <span>Light Green</span>
                            </li>
                            <li data-theme="lime">
                                <div class="lime"></div>
                                <span>Lime</span>
                            </li>
                            <li data-theme="yellow">
                                <div class="yellow"></div>
                                <span>Yellow</span>
                            </li>
                            <li data-theme="amber">
                                <div class="amber"></div>
                                <span>Amber</span>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                                <span>Orange</span>
                            </li>
                            <li data-theme="deep-orange">
                                <div class="deep-orange"></div>
                                <span>Deep Orange</span>
                            </li>
                            <li data-theme="brown">
                                <div class="brown"></div>
                                <span>Brown</span>
                            </li>
                            <li data-theme="grey">
                                <div class="grey"></div>
                                <span>Grey</span>
                            </li>
                            <li data-theme="blue-grey">
                                <div class="blue-grey"></div>
                                <span>Blue Grey</span>
                            </li>
                            <li data-theme="black">
                                <div class="black"></div>
                                <span>Black</span>
                            </li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active in active" id="settings">
                        <div class="demo-settings">
                            <p>GENERAL SETTINGS</p>
                            <ul class="setting-list">
                                <li>
                                    <span>Report Panel Usage</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <span>Email Redirect</span>
                                    <div class="switch">
                                        <label><input type="checkbox"><span class="lever"></span></label>
                                    </div>
                                </li>
                            </ul>
                            <p>SYSTEM SETTINGS</p>
                            <ul class="setting-list">
                                <li>
                                    <span>Notifications</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <span>Auto Updates</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                            </ul>
                            <p>ACCOUNT SETTINGS</p>
                            <ul class="setting-list">
                                <li>
                                    <span>Offline</span>
                                    <div class="switch">
                                        <label><input type="checkbox"><span class="lever"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <span>Location Permission</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- #END# Right Sidebar -->
        </section>				