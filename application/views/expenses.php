<?php
require_once 'includes/header.php';
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>



<!--Select Dropdown js start-->     
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!--Select Dropdown js end-->
<script>
    $(function () {
        $("#startDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });

        $("#endDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });
    });
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->



            <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
            <ol class="breadcrumb breadcrumb-bg-cyan">
                <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">attach_money</i> <?php echo $lang_expenses; ?></li>

            </ol>

            <?php
            if (!empty($alert_msg)) {
                $flash_status = $alert_msg[0];
                $flash_header = $alert_msg[1];
                $flash_desc = $alert_msg[2];
                ?>
                <?php if ($flash_status == 'failure') { ?>
                    <div class="alert alert-info">
                        <strong>Heads up!</strong> <?php echo $flash_desc; ?>
                    </div>
                <?php } ?>


                <?php if ($flash_status == 'success') { ?>
                    <div class="alert alert-success">
                        <strong>Well done!</strong> <?php echo $flash_desc; ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="card">

                <div class="header">
                    <h3><?php echo $lang_expenses; ?></h3>
                    <ul class="header-dropdown m-r--5">
                        <a href="<?= base_url() ?>expenses/addNewExpenses">
                            <button class="btn btn-primary"><?php echo $lang_add_new_expenses; ?></button>
                        </a>
                        <?php
                        if ($user_role < 3) {
                            ?>
                            <a href="<?= base_url() ?>expenses/exportExpenses" style="text-decoration: none;">
                                <button type="button" info="" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo $lang_export_to_excel; ?>
                                </button>
                            </a>
                            <?php
                        }
                        ?>
                    </ul>
                </div>


                <div class="row header" style="margin-top: 10px;">
                    <form action="<?= base_url() ?>expenses/searchExpenses" method="get">

                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_expenses_number; ?></label>
                                <input type="text" name="expenses_numb" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_expenses_category; ?></label>
                                <select name="search_category" class="form-control show-tick" data-live-search="true" required>
                                    <option value="-"><?php echo $lang_all_category; ?></option>
                                    <?php
                                    $sExpData = $this->Constant_model->getDataAll('expense_categories', 'name', 'ASC');
                                    for ($se = 0; $se < count($sExpData); ++$se) {
                                        $se_id = $sExpData[$se]->id;
                                        $se_name = $sExpData[$se]->name;
                                        ?>
                                        <option value="<?php echo $se_id; ?>">
                                            <?php echo $se_name; ?>
                                        </option>
                                        <?php
                                        unset($se_id);
                                        unset($se_name);
                                    }
                                    ?>
                                </select>

                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_outlets; ?></label>
                                <select name="outlet" class="form-control show-tick" data-live-search="true" required>
                                    <?php
                                    if ($user_role == 1) {
                                        $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
                                        ?>
                                        <option value="-"><?php echo $lang_all_outlets; ?></option>
                                        <?php
                                    } else {
                                        $outletData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$user_outlet");
                                    }
                                    ?>


                                    <?php
                                    for ($ot = 0; $ot < count($outletData); ++$ot) {
                                        $outlet_id = $outletData[$ot]->id;
                                        $outlet_name = $outletData[$ot]->name;
                                        ?>
                                        <option value="<?php echo $outlet_id; ?>"><?php echo $outlet_name; ?></option>
                                        <?php
                                        unset($outlet_id);
                                        unset($outlet_name);
                                    }
                                    ?>
                                </select>
                            </div>


                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_date_from; ?></label>
                                <input type="text" name="start_date" class="form-control" />

                            </div>


                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_date_to; ?></label>
                                <input type="text" name="end_date" class="form-control" />

                            </div>


                        </div>

                        <div class="col-md-2">
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
                                    <th width="10%"><?php echo $lang_expenses_number; ?></th>
                                    <th width="10%"><?php echo $lang_expenses_category; ?></th>
                                    <th width="10%"><?php echo $lang_outlets; ?></th>
                                    <th width="10%"><?php echo $lang_date; ?></th>
                                    <th width="10%"><?php echo $lang_amount; ?> (<?php echo $site_currency; ?>)</th>
                                    <th width="10%"><?php echo $lang_action; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($results) > 0) {
                                    foreach ($results as $data) {
                                        $id = $data->id;
                                        $number = $data->expenses_number;
                                        $outlet_id = $data->outlet_id;
                                        $amount = $data->amount;
                                        $date = date("$setting_dateformat", strtotime($data->date));
                                        $exp_cat_id = $data->expense_category;

                                        $exp_cat_name = '';
                                        $expCatNameData = $this->Constant_model->getDataOneColumn('expense_categories', 'id', $exp_cat_id);
                                        if (count($expCatNameData) > 0) {
                                            $exp_cat_name = $expCatNameData[0]->name;
                                        }

                                        $outlet_name = '';
                                        $outletNameData = $this->Constant_model->getDataOneColumn('outlets', 'id', $outlet_id);
                                        $outlet_name = $outletNameData[0]->name;
                                        ?>
                                        <tr>

                                            <td><?php echo $number; ?></td>
                                            <td><?php echo $exp_cat_name; ?></td>
                                            <td><?php echo $outlet_name; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo number_format($amount, 2); ?></td>
                                            
                                            <td>
                                                <a href="<?= base_url() ?>expenses/editExpenses?id=<?php echo $id; ?>">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                                <?php
                                                if ($user_outlet < 3) {
                                                    ?>
                                                    <a href="<?= base_url() ?>expenses/deleteExpenses/<?php echo $id; ?>" onclick="return confirm('<?php echo $lang_expenses_delete_confirm; ?>')">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                <?php }
                                                ?>
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
</section><!--   section end-->



<?php
require_once 'includes/footer.php';
?>