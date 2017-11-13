<?php
require_once 'includes/header.php';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_purchase_order; ?></h1>
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
                        <div class="col-md-12">
                            <?php
                            if ($user_role < 3) {
                                ?>
                                <a href="<?= base_url() ?>purchase_order/create_purchase_order" style="text-decoration: none">
                                    <button class="btn btn-primary" style="padding: 0px 12px;"><i class="icono-plus"></i>
                                        <?php echo $lang_create_purchase_order; ?>
                                    </button>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="15%"><?php echo $lang_purchase_order_number; ?></th>
                                            <th width="12%"><?php echo $lang_outlets; ?></th>
                                            <th width="10%"><?php echo $lang_suppliers; ?></th>
                                            <th width="10%"><?php echo $lang_created_date; ?></th>
                                            <th width="13%"><?php echo $lang_status; ?></th>
                                            <th width="20%"><?php echo $lang_action; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($results) > 0) {
                                            foreach ($results as $data) {
                                                $id = $data->id;
                                                $po_numb = $data->po_number;
                                                $supplier_id = $data->supplier_id;
                                                $outlet_id = $data->outlet_id;
                                                $po_date = $data->po_date;
                                                $status_id = $data->status;

                                                $outlet_name = $data->outlet_name;
                                                $supplier_name = $data->supplier_name;

                                                $status_name = '';
                                                $statusData = $this->Constant_model->getDataOneColumn('purchase_order_status', 'id', "$status_id");
                                                $status_name = $statusData[0]->name;
                                                ?>
                                                <tr>
                                                    <td><?php echo $po_numb; ?></td>
                                                    <td><?php echo $outlet_name; ?></td>
                                                    <td><?php echo $supplier_name; ?></td>
                                                    <td><?php echo date("$dateformat", strtotime($po_date)); ?></td>
                                                    <td style="font-weight: bold;">
                                                        <?php
                                                        if ($status_id == '1') {
                                                            echo $lang_created;
                                                        } elseif ($status_id == '2') {
                                                            echo $lang_send_to_supplier;
                                                        } elseif ($status_id == '3') {
                                                            echo $lang_received_from_supplier;
                                                        }
                                                        //echo $status_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($status_id == '1') {
                                                            ?>
                                                            <a href="<?= base_url() ?>purchase_order/editpo?id=<?php echo $id; ?>" style="text-decoration: none; margin-left: 5px;">
                                                                <button class="btn btn-primary" style="padding: 5px 12px;">&nbsp;&nbsp;<?php echo $lang_edit; ?>&nbsp;&nbsp;</button>
                                                            </a>

                                                            <?php
                                                            if ($user_role == '1') {
                                                                ?>
                                                                <a href="<?= base_url() ?>purchase_order/deletePO?id=<?php echo $id; ?>&po_numb=<?php echo $po_numb; ?>" style="text-decoration: none; margin-left: 10px;" onclick="return confirm('Are you sure to delete this Purchase Order : <?php echo $po_numb; ?>?')">
                                                                    <i class="icono-cross" style="color:#F00;"></i>
                                                                </a>
                                                            <?php }
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php
                                                            if ($status_id == '2') {
                                                                ?>
                                                                <a href="<?= base_url() ?>purchase_order/receivepo?id=<?php echo $id; ?>" style="text-decoration: none; margin-left: 5px;">
                                                                    <button class="btn btn-primary" style="padding: 5px 12px;">&nbsp;&nbsp;<?php echo $lang_receive; ?>&nbsp;&nbsp;</button>
                                                                </a>
                                                            <?php }
                                                            ?>
                                                            <a href="<?= base_url() ?>purchase_order/viewpo?id=<?php echo $id; ?>" style="text-decoration: none; margin-left: 5px;">
                                                                <button class="btn btn-primary" style="padding: 5px 12px;">&nbsp;&nbsp;<?php echo $lang_view; ?>&nbsp;&nbsp;</button>
                                                            </a>

                                                            <?php
                                                            if ($status_id == '2') {
                                                                if ($user_role == '1') {
                                                                    ?>
                                                                    <a href="<?= base_url() ?>purchase_order/deletePO?id=<?php echo $id; ?>&po_numb=<?php echo $po_numb; ?>" style="text-decoration: none; margin-left: 10px;" onclick="return confirm('Are you sure to delete this Purchase Order : <?php echo $po_numb; ?>?')">
                                                                        <i class="icono-cross" style="color:#F00;"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        <?php }
                                                        ?>	
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="no-records-found">
                                                <td colspan="6"><?php echo $lang_no_match_found; ?></td>
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