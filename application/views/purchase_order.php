<?php
require_once 'includes/header.php';
?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><i class="material-icons">shopping_basket</i> <?php echo $lang_purchase_order; ?></li>
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
                        <h2><?php echo $lang_purchase_order; ?></h2>
                        <?php
                        if ($user_role < 3) {
                            ?>
                            <ul class="header-dropdown m-r--5">
                                <a href="<?= base_url() ?>purchase_order/create_purchase_order">
                                    <button class="btn btn-primary"><?php echo $lang_create_purchase_order; ?></button>
                                </a>

                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th width="20%"><?php echo $lang_purchase_order_number; ?></th>
                                        <th width="16%"><?php echo $lang_outlets; ?></th>
                                        <th width="16%"><?php echo $lang_suppliers; ?></th>
                                        <th width="16%"><?php echo $lang_created_date; ?></th>
                                        <th width="16%"><?php echo $lang_status; ?></th>
                                        <th width="16%"><?php echo $lang_action; ?></th>
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
                                                        <a href="<?= base_url() ?>purchase_order/editpo?id=<?php echo $id; ?>">
                                                            <i class="material-icons">mode_edit</i>
                                                        </a>


                                                        <?php
                                                        if ($user_role == '1') {
                                                            ?>
                                                    <a href="<?= base_url() ?>purchase_order/deletePO?id=<?php echo $id; ?>&po_numb=<?php echo $po_numb; ?>" onclick="return confirm('Are you sure to delete this Purchase Order : <?php echo $po_numb; ?>?')">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                           
                                                        <?php }
                                                        ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <?php
                                                        if ($status_id == '2') {
                                                            ?>
                                                      <a href="<?= base_url() ?>purchase_order/receivepo?id=<?php echo $id; ?>">
                                                            <i class="material-icons">settings_ethernet</i>
                                                        </a>

                                                            
                                                        <?php }
                                                        ?>
                                                     <a href="<?= base_url() ?>purchase_order/viewpo?id=<?php echo $id; ?>">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </a>
                                                       

                                                        <?php
                                                        if ($status_id == '2') {
                                                            if ($user_role == '1') {
                                                                ?>
                                                                <a href="<?= base_url() ?>purchase_order/deletePO?id=<?php echo $id; ?>&po_numb=<?php echo $po_numb; ?>" style="text-decoration: none; margin-left: 10px;" onclick="return confirm('Are you sure to delete this Purchase Order : <?php echo $po_numb; ?>?')">
                                                                    <i class="material-icons" >delete_forever</i>
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
                    <div class="row clearfix" style="padding-left: 20px; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <?php echo $displayshowingentries; ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $links; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>