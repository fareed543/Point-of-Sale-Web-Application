<?php
require_once 'includes/header.php';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_add_supplier; ?></h1>
        </div>
    </div><!--/.row-->

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
                                <div class="form-group">
                                    <label><?php echo $lang_supplier_name; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="name" class="form-control"  maxlength="499" autofocus required autocomplete="off" value="<?php
                                    if (!empty($alert_msg)) {
                                        echo $alert_msg[3];
                                    }
                                    ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_email; ?> </label>
                                    <input type="email" name="email" class="form-control" maxlength="254" autocomplete="off" value="<?php
                                    if (!empty($alert_msg)) {
                                        echo $alert_msg[4];
                                    }
                                    ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_telephone; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="tel" class="form-control"  maxlength="499" required autocomplete="off" value="<?php
                                    if (!empty($alert_msg)) {
                                        echo $alert_msg[5];
                                    }
                                    ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_fax; ?></label>
                                    <input type="text" name="fax" class="form-control" maxlength="254" autocomplete="off" value="<?php
                                    if (!empty($alert_msg)) {
                                        echo $alert_msg[6];
                                    }
                                    ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo $lang_supplier_address; ?> <span style="color: #F00">*</span></label>
                                    <textarea name="address" class="form-control" required style="height: 100px;"><?php
                                        if (!empty($alert_msg)) {
                                            echo $alert_msg[7];
                                        }
                                        ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_supplier_tax; ?> </label>
                                    <input type="text" name="tax" class="form-control"  maxlength="499" autocomplete="off" value="<?php
                                    if (!empty($alert_msg)) {
                                        echo $alert_msg[8];
                                    }
                                    ?>" />
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
                                    <button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_add; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>



                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->

                <a href="<?= base_url() ?>setting/suppliers" style="text-decoration: none;">
                    <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                        <i class="icono-caretLeft" style="color: #FFF;"></i><?php echo $lang_back; ?>
                    </div>
                </a>

            </div><!-- Col md 12 // END -->
        </div><!-- Row // END -->
    </form>

    <br /><br /><br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>