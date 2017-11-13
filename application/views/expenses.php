<?php
require_once 'includes/header.php';
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
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

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_expenses; ?></h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

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

                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?= base_url() ?>expenses/addNewExpenses" style="text-decoration: none">
                                <button class="btn btn-primary" style="padding: 0px 12px;"><i class="icono-plus"></i>
                                    <?php echo $lang_add_new_expenses; ?>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <?php
                            if ($user_role < 3) {
                                ?>
                                <a href="<?= base_url() ?>expenses/exportExpenses" style="text-decoration: none;">
                                    <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                        <?php echo $lang_export_to_excel; ?>
                                    </button>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <form action="<?= base_url() ?>expenses/searchExpenses" method="get" style="margin-top: 7px;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo $lang_expenses_number; ?></label>
                                    <input type="text" name="expenses_numb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo $lang_expenses_category; ?></label>
                                    <select name="search_category" class="form-control">
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
                                <div class="form-group">
                                    <label><?php echo $lang_outlets; ?></label>
                                    <select name="outlet" class="form-control">
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
                                <div class="form-group">
                                    <label><?php echo $lang_date_from; ?></label>
                                    <input type="text" name="start_date" class="form-control" id="startDate" style="height: 35px" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo $lang_date_to; ?></label>
                                    <input type="text" name="end_date" class="form-control" id="endDate" style="height: 35px" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button class="btn btn-primary" style="width: 100%;">&nbsp;&nbsp;<?php echo $lang_search; ?>&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row" style="margin-top: 0px;">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table">
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
                                                        <a href="<?= base_url() ?>expenses/editExpenses?id=<?php echo $id; ?>" style="text-decoration: none">
                                                            <button class="btn btn-primary">&nbsp;&nbsp;<?php echo $lang_edit; ?>&nbsp;&nbsp;</button>
                                                        </a>
                                                        <?php
                                                        if ($user_outlet < 3) {
                                                            ?>								
                                                            <a href="<?= base_url() ?>expenses/deleteExpenses?id=<?php echo $id; ?>" style="text-decoration: none; margin-left: 10px;" title="Delete" onclick="return confirm('<?php echo $lang_expenses_delete_confirm; ?>')">
                                                                <i class="icono-crossCircle" style="color: #F00"></i>
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
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="float: left; padding-top: 10px;">
                            <?php echo $displayshowingentries; ?>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <?php echo $links; ?>
                        </div>
                    </div>

                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->
        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->

    <br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>