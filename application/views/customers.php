<?php require_once 'includes/header.php'; ?>
<?php echo $lang_customers; ?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->
            <?php
            if (!empty($alert_msg)) {
                $flash_status = $alert_msg[0];
                $flash_header = $alert_msg[1];
                $flash_desc = $alert_msg[2];

                if ($flash_status == 'failure') {
                    ?>
                    <div class="row" id="notificationWrp">
                        <div class="col-md-12">
                            <div class="alert bg-warning" role="alert">
                                <i class="icono-exclamationCircle" style="color: #FFF;"></i> 
                                <?php echo $flash_desc; ?> <i class="icono-cross" id="closeAlert" style="cursor: pointer; color: #FFF; float: right;"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if ($flash_status == 'success') {
                    ?>
                    <div class="row" id="notificationWrp">
                        <div class="col-md-12">
                            <div class="alert bg-success" role="alert">
                                <i class="icono-check" style="color: #FFF;"></i> 
                                <?php echo $flash_desc; ?> <i class="icono-cross" id="closeAlert" style="cursor: pointer; color: #FFF; float: right;"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


            <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
            <div class="card">
                <?php
                if ($user_role < 3) {
                    ?>
                    <div class="header">
                        <ul >

                            <a href="<?= base_url() ?>customers/addCustomer"  >
                                <button type="button" info="" class="btn btn-primary " >
                                    <?php echo $lang_add_customer; ?>
                                </button>
                            </a>
                        </ul>
                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>customers/exportCustomer" style="text-decoration: none;">
                                <button type="button" info="" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo $lang_export; ?>
                                </button>
                            </a>
                        </ul>
                    </div>
                    <?php
                }
                ?>

                <div class="row header" style="margin-top: 10px;">
                    <form action="<?= base_url() ?>customers/searchcustomer" method="get">
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_name; ?></label>
                                <input type="text" name="name" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_email; ?></label>
                                <input type="text" name="email" class="form-control" />

                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_mobile; ?></label>
                                <input type="text" name="mobile" class="form-control" />

                            </div>


                        </div>

                        <div class="col-md-3">
                            <div class="form-line">
                                <label>&nbsp;</label><br />
                                <button class="btn btn-primary" style="width: 100%;">&nbsp;&nbsp;<?php echo $lang_search; ?>&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th width="15%"><?php echo $lang_customer_name; ?></th>
                                    <th width="15%"><?php echo $lang_email; ?></th>
                                    <th width="15%"><?php echo $lang_mobile; ?></th>
                                    <!-- <th width="15%">Total Cost</th> -->
                                    <th width="10%"><?php echo $lang_action; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($results) > 0) {
                                    foreach ($results as $data) {
                                        $cust_id = $data->id;
                                        $cust_fn = $data->fullname;
                                        $cust_em = $data->email;
                                        $cust_mb = $data->mobile;
                                        ?>
                                        <tr>
                                            <td><?php echo $cust_fn; ?></td>
                                            <td> <?php
                                                if (empty($cust_em)) {
                                                    echo '-';
                                                } else {
                                                    echo $cust_em;
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                if (empty($cust_mb)) {
                                                    echo '-';
                                                } else {
                                                    echo $cust_mb;
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url() ?>customers/edit_customer?cust_id=<?php echo $cust_id; ?>">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>

                                                <a href="<?= base_url() ?>customers/customer_history?cust_id=<?php echo $cust_id; ?>">
                                                    <i class="material-icons">history</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr class="no-records-found">
                                        <td colspan="5"><?php echo $lang_no_match_found; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row clearfix" >
                    <div class="col-md-6" style="float: left; padding-top: 10px; padding-left: 30px; padding-bottom: 15px;">
                        <?php echo $displayshowingentries; ?>
                    </div>
                    <div class="col-md-6" style="text-align: right; padding-right: 30px; padding-bottom: 15px;">
                        <?php echo $links; ?>
                    </div>
                </div>


            </div>
            <!--</div>-->
            <!-- #END# Task Info -->
        </div>
    </div>
</section>






<?php require_once 'includes/footer.php'; ?>