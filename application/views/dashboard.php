<?php require_once 'includes/header.php'; ?>
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">			
            <a href="<?= base_url() ?>pos">
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                    <div class="demo-color-box bg-pink">
                        <i class="material-icons">extension</i>
                        <div class="color-code"><?php echo $lang_point_of_sales; ?></div>
                    </div>
                </div>
            </a>

            <a href="<?= base_url() ?>sales/list_sales">
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                    <div class="demo-color-box bg-cyan">
                        <i class="material-icons">extension</i>
                        <div class="color-code"><?php echo $lang_sales; ?></div>
                    </div>
                </div>
            </a>


            <a href="<?= base_url() ?>reports/sales_report">
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                    <div class="demo-color-box bg-light-green">
                        <i class="material-icons">extension</i>
                        <div class="color-code"><?php echo $lang_reports; ?></div>
                    </div>
                </div>
            </a>


            <a href="<?= base_url() ?>setting/outlets">
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                    <div class="demo-color-box bg-orange">
                        <i class="material-icons">extension</i>
                        <div class="color-code"><?php echo $lang_outlets; ?></div>
                    </div>
                </div>
            </a>

            <a href="<?= base_url() ?>setting/users">
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                    <div class="demo-color-box bg-brown">
                        <i class="material-icons">extension</i>
                        <div class="color-code"><?php echo $lang_users; ?></div>
                    </div>
                </div>
            </a>


            <a href="<?= base_url() ?>setting/system_setting">
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                    <div class="demo-color-box bg-teal">
                        <i class="material-icons">person_add</i>
                        <div class="color-code"><?php echo $lang_system_setting; ?></div>
                    </div>
                </div>
            </a>
        </div>


        <div class="card">
            <div class="header">
                <h2>BAR CHART</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div id="bar_chart" class="graph"></div>
            </div>
        </div>
        <link href="<?= base_url() ?>assets/plugins/morrisjs/morris.css" rel="stylesheet" />
        <script src="<?= base_url() ?>assets/js/pages/charts/morris.js"></script>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>