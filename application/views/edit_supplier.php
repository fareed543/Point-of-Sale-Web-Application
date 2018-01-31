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


<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<section class="content">
    <div class="container-fluid">
        <ol class="breadcrumb breadcrumb-bg-cyan">
            <li><a href="<?= base_url() ?>dashboard"><i class="material-icons">home</i> Home</a></li>
            <li><a href="<?= base_url() ?>setting/suppliers"><i class="material-icons">input</i><?php echo $lang_suppliers; ?></a></li>
            <li><i class="material-icons">mode_edit</i><?php echo $lang_edit_supplier; ?> : <?php echo $supplier_name; ?></li>
        </ol>
        <form action="<?= base_url() ?>setting/updateSupplier" method="post">
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



                            <h3 class="card-inside-title">Edit Supplier</h3>
                            <div class="row clearfix">

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" maxlength="499" autofocus required autocomplete="off" value="<?php echo $supplier_name; ?>" />
                                            <label class="form-label"><?php echo $lang_supplier_name; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control" maxlength="254"  autocomplete="off" value="<?php echo $supplier_email; ?>"/>
                                            <label class="form-label"><?php echo $lang_email; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="tel" class="form-control"   maxlength="499" required autocomplete="off" value="<?php echo $supplier_tel; ?>"/>
                                            <label class="form-label"><?php echo $lang_telephone; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="fax" class="form-control"   maxlength="254" autocomplete="off" value="<?php echo $supplier_fax; ?>" />
                                            <label class="form-label"><?php echo $lang_fax; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea class="form-control" name="address" required><?php echo $supplier_address; ?></textarea>
                                            <label class="form-label"> Address </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select name="status" class="form-control show-tick" data-live-search="true">
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
                                            <label class="form-label"><?php echo $lang_status; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary"><?php echo $lang_update; ?></button>
                                        <a class="btn btn-primary" href="<?= base_url() ?>setting/suppliers"><?php echo $lang_back; ?></a>
                                    </div>


                                </div>
                            </div>
                        </div>



                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->
            </div><!-- Col md 12 // END -->
        </form>
    </div><!-- Row // END -->

</section>



















<?php
require_once 'includes/footer.php';
?>