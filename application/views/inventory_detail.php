<?php
require_once 'includes/header.php';
?>
<section class="content">
    <div class="container-fluid">
        <?php echo $lang_inventory_for_product; ?> : <?php echo $pcode; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">




                        <h3 class="card-inside-title"><?php echo $lang_inventory_by_outlet; ?></h3>

                        <div class="row clearfix">
                            <div class="row" style="padding-top: 10px; padding-bottom: 10px; padding-left: 30px;">
                                <div class="col-md-3"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_outlets; ?></b></div>
                                <div class="col-md-9"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_current_inventory_qty; ?></b></div>
                            </div>
                            <?php
                            $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
                            for ($t = 0; $t < count($outletData); ++$t) {
                                $outlet_id = $outletData[$t]->id;
                                $outlet_name = $outletData[$t]->name;
                                ?>
                                <div class="row" style="padding-top: 10px; padding-bottom: 10px; padding-left: 30px;">
                                    <div class="col-md-3" style="font-size: 16px;">
                                        <?php echo $outlet_name; ?>
                                    </div>
                                    <div class="col-md-9" style="font-size: 16px;">
                                        <?php
                                        $invQty = 0;

                                        $invQtyData = $this->Constant_model->getDataTwoColumn('inventory', 'product_code', $pcode, 'outlet_id', $outlet_id);
                                        if (count($invQtyData) > 0) {
                                            $invQty = $invQtyData[0]->qty;
                                        }
                                        echo $invQty;
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>



                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->
            </div>

        </div><!-- Row // END -->

        <?php
        if ($user_role < 3) {
            ?>
            <form action="<?= base_url() ?>inventory/updateInventoryQty" method="post" onsubmit="return confirm('Do you want to update Inventory?')">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
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



                                <h3 class="card-inside-title"><?php echo $lang_update_inventory_by_outlet; ?></h3>

                                <div class="row clearfix">
                                    <div class="row" style="padding-top: 10px; padding-bottom: 10px; padding-left: 30px;">
                                        <div class="col-md-3"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_outlets; ?></b></div>
                                        <div class="col-md-9"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_quantity; ?></b></div>
                                    </div>
                                    <?php
                                    if ($user_role == 1) {
                                        $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
                                    } else {
                                        $outletData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$user_outlet");
                                    }
                                    for ($t = 0; $t < count($outletData); ++$t) {
                                        $outlet_id = $outletData[$t]->id;
                                        $outlet_name = $outletData[$t]->name;
                                        ?>
                                        <div class="row" style="padding-top: 10px; padding-bottom: 10px; padding-left: 30px;">
                                            <div class="col-md-3" style="font-size: 16px;">
        <?php echo $outlet_name; ?>
                                            </div>
                                            <div class="col-md-1" style="font-size: 16px;">
                                                <input type="text" class="form-control" name="qty_<?php echo $outlet_id; ?>" value="0" />
                                            </div>
                                        </div>
                                        <?php
                                        unset($outlet_id);
                                        unset($outlet_name);
                                    }
                                    ?>
                                </div>
                                <div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
                                                                            <input type="hidden" name="pcode" value="<?php echo $pcode; ?>" />
										<button class="btn btn-primary"><?php echo $lang_update; ?></button>
										<a class="btn btn-primary" href="<?= base_url() ?>inventory/view"><?php echo $lang_back; ?></a>
									</div>
									
									
								</div>
							</div>



                            </div><!-- Panel Body // END -->
                        </div><!-- Panel Default // END -->
                    </div>

                </div>

            </form>
            <?php
        }
        ?>
</section>






<!--<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $lang_inventory_for_product; ?> : <?php echo $pcode; ?></h1>
                </div>
            </div>/.row

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">


                            <h1 class="page-header" style="margin-top: 0px; padding-bottom: 4px; font-size: 30px; margin: 0px 0 11px; color: #0079c0;">
<?php echo $lang_inventory_by_outlet; ?>
                            </h1>

                            <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                                <div class="col-md-3"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_outlets; ?></b></div>
                                <div class="col-md-9"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_current_inventory_qty; ?></b></div>
                            </div>
<?php
$outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
for ($t = 0; $t < count($outletData); ++$t) {
    $outlet_id = $outletData[$t]->id;
    $outlet_name = $outletData[$t]->name;
    ?>
                                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                                        <div class="col-md-3" style="font-size: 16px;">
    <?php echo $outlet_name; ?>
                                        </div>
                                        <div class="col-md-9" style="font-size: 16px;">
    <?php
    $invQty = 0;

    $invQtyData = $this->Constant_model->getDataTwoColumn('inventory', 'product_code', $pcode, 'outlet_id', $outlet_id);
    if (count($invQtyData) > 0) {
        $invQty = $invQtyData[0]->qty;
    }
    echo $invQty;
    ?>
                                        </div>
                                    </div>
    <?php
}
?>

                        </div> Panel Body // END 
                    </div> Panel Default // END 


<?php
if ($user_role < 3) {
    ?>
                            <form action="<?= base_url() ?>inventory/updateInventoryQty" method="post" onsubmit="return confirm('Do you want to update Inventory?')">
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
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">

                                                <h1 class="page-header" style="margin-top: 0px; padding-bottom: 4px; font-size: 30px; margin: 0px 0 11px; color: #0079c0; text-align: center;">
    <?php echo $lang_update_inventory_by_outlet; ?>
                                                </h1>

                                                <div class="row" style="padding-top: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                                    <div class="col-md-6"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_outlets; ?></b></div>
                                                    <div class="col-md-6"><b style="color: #0079c0; letter-spacing: 0.2px; font-size: 17px;"><?php echo $lang_quantity; ?></b></div>
                                                </div>

    <?php
    if ($user_role == 1) {
        $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
    } else {
        $outletData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$user_outlet");
    }
    for ($t = 0; $t < count($outletData); ++$t) {
        $outlet_id = $outletData[$t]->id;
        $outlet_name = $outletData[$t]->name;
        ?>
                                                        <div class="row" style="padding-top: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                                            <div class="col-md-6" style="padding-top: 10px; font-size: 15px;">
        <?php echo $outlet_name; ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="qty_<?php echo $outlet_id; ?>" value="0" />	
                                                            </div>
                                                        </div>
        <?php
        unset($outlet_id);
        unset($outlet_name);
    }
    ?>
                                                <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                                                    <div class="col-md-12" style="text-align: center; padding-top: 10px;">
                                                        <input type="hidden" name="pcode" value="<?php echo $pcode; ?>" />
                                                        <button class="btn btn-primary" style="padding: 8px 30px; font-size: 18px;">
    <?php echo $lang_update; ?>
                                                        </button>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>


                                    </div>
                                </div>
                            </form>
    <?php
}
?>




                    <a href="<?= base_url() ?>inventory/view" style="text-decoration: none;">
                        <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                            <i class="icono-caretLeft" style="color: #FFF;"></i><?php echo $lang_back; ?>
                        </div>
                    </a>

                </div> Col md 12 // END 
            </div> Row // END 

            <br /><br /><br /><br /><br />

        </div>
    </div>
</section>-->
<!--Right Colmn // END--> 



<?php
require_once 'includes/footer.php';
?>