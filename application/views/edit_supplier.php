<?php
require_once 'includes/header.php';
?>

<?php
$supplierData = $this->Constant_model->getDataOneColumn('suppliers', 'id', $id);

if (count($supplierData) == 0) {
    redirect(base_url());
}

$supplier_name = $supplierData[0]->name;
$supplier_email = $supplierData[0]->email;
$supplier_tel = $supplierData[0]->tel;
$supplier_fax = $supplierData[0]->fax;
$supplier_address = $supplierData[0]->address;
$supplier_status = $supplierData[0]->status;
$supplier_tax = $supplierData[0]->tax;
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_edit_supplier; ?> : <?php echo $supplier_name; ?></h1>
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

                    <?php
                    if ($user_role == 1) {
                        ?>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right;">
                                <form action="<?= base_url() ?>setting/deleteSupplier" method="post" onsubmit="return confirm('Do you want to delete this Suppler : <?php echo $supplier_name; ?>?')">
                                    <input type="hidden" name="supplier_id" value="<?php echo $id; ?>" />
                                    <input type="hidden" name="supplier_name" value="<?php echo $supplier_name; ?>" />
                                    <button type="submit" class="btn btn-primary" style="border: 0px; background-color: #c72a25;">
                                        <?php echo $lang_delete_supplier; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <form action="<?= base_url() ?>setting/updateSupplier" method="post">				
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_supplier_name; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="name" class="form-control"  maxlength="499" autofocus required autocomplete="off" value="<?php echo $supplier_name; ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_email; ?> </label>
                                    <input type="email" name="email" class="form-control" maxlength="254" autocomplete="off" value="<?php echo $supplier_email; ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_telephone; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="tel" class="form-control"  maxlength="499" required autocomplete="off" value="<?php echo $supplier_tel; ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_fax; ?> </label>
                                    <input type="text" name="fax" class="form-control" maxlength="254" autocomplete="off" value="<?php echo $supplier_fax; ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address <span style="color: #F00">*</span></label>
                                    <textarea name="address" class="form-control" required style="height: 100px;"><?php echo $supplier_address; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_status; ?> <span style="color: #F00">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1" <?php
                                        if ($supplier_status == '1') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_active; ?></option>
                                        <option value="0" <?php
                                        if ($supplier_status == '0') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_inactive; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>		

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_supplier_tax; ?></label>
                                    <input type="text" name="tax" class="form-control"  maxlength="499" autocomplete="off" value="<?php echo $supplier_tax; ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_update; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>				


                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->

            <a href="<?= base_url() ?>setting/suppliers" style="text-decoration: none;">
                <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                    <i class="icono-caretLeft" style="color: #FFF;"></i><?php echo $lang_back; ?>
                </div>
            </a>

        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->


    <br /><br /><br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>