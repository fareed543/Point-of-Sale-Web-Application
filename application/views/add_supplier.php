<?php
require_once 'includes/header.php';
?>
<section class="content">
    <div class="container-fluid">
        <!--<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">-->
        <ol class="breadcrumb breadcrumb-bg-cyan">
			<li><a href="<?= base_url() ?>dashboard"><i class="material-icons">home</i> Home</a></li>
			 <li><a href="<?= base_url() ?>setting/suppliers"><i class="material-icons">input</i><?php echo $lang_suppliers; ?></a></li>
			<li><i class="material-icons">add</i> Add Suppliers</li>
		</ol>
        <?php echo $lang_add_supplier; ?>
        <form action="<?= base_url() ?>setting/insertSupplier" method="post">
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
                                                <?php echo $flash_desc; ?> <i class="icono-cross" id="closeAlert"></i>
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

                            <h3 class="card-inside-title">Add Suppliers</h3>
                            <div class="row clearfix">

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" maxlength="499" autofocus required autocomplete="off" value="<?php
                                            if (!empty($alert_msg)) {
                                                echo $alert_msg[3];
                                            }
                                            ?>" />
                                            <label class="form-label"><?php echo $lang_supplier_name; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="email" class="form-control" maxlength="254" autocomplete="off" value="<?php
                                            if (!empty($alert_msg)) {
                                                echo $alert_msg[4];
                                            }
                                            ?>"/>
                                            <label class="form-label"><?php echo $lang_email; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="tel" class="form-control" maxlength="499" required autocomplete="off" value="<?php
                                            if (!empty($alert_msg)) {
                                                echo $alert_msg[5];
                                            }
                                            ?>"  />
                                            <label class="form-label"><?php echo $lang_telephone; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="fax" class="form-control" maxlength="254" autocomplete="off" value="<?php
                                            if (!empty($alert_msg)) {
                                                echo $alert_msg[6];
                                            }
                                            ?>" />
                                            <label class="form-label"><?php echo $lang_fax; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea class="form-control" name="address" required ><?php
                                                if (!empty($alert_msg)) {
                                                    echo $alert_msg[7];
                                                }
                                                ?></textarea>
                                            <label class="form-label"><?php echo $lang_supplier_address; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="tax" class="form-control" maxlength="499" autocomplete="off" value="<?php
                                            if (!empty($alert_msg)) {
                                                echo $alert_msg[8];
                                            }
                                            ?>" />
                                            <label class="form-label"><?php echo $lang_supplier_tax; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button class="btn btn-primary"><?php echo $lang_add; ?></button>
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