<?php
require_once 'includes/header.php';
?>
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><a href="<?= base_url() ?>setting/outlets"><i class="material-icons">store</i> Outlets</a></li>
                    <li class="active"><i class="material-icons">add</i> <?php echo $lang_add_new_outlet; ?></li>
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

                <form action="<?= base_url() ?>setting/insertOutlet" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3 class="card-inside-title">Infomation</h3>
                                    <div class="row clearfix">

                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="outlet_name" class="form-control" maxlength="499" autofocus required autocomplete="off" />
                                                    <label class="form-label"><?php echo $lang_outlet_name; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="outlet_contact" class="form-control" maxlength="30" required autocomplete="off" />
                                                    <label class="form-label"><?php echo $lang_contact_number; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea class="form-control" name="outlet_address" rows="5" required></textarea>
                                                    <label class="form-label"><?php echo $lang_address; ?></label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2><?php echo $lang_receipt_footer; ?><small>It Appear on Bills at footer section </small></h2>
                                                </div>
                                                <div class="body">
                                                    <?php echo $this->ckeditor->editor('receipt_footer', ''); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary"><?php echo $lang_add; ?></button>
                                                <a class="btn btn-primary" href="<?= base_url() ?>setting/outlets"><?php echo $lang_back; ?></a>
                                            </div>


                                        </div>
                                    </div>
                                </div>



                            </div><!-- Panel Body // END -->
                        </div><!-- Panel Default // END -->
                    </div><!-- Col md 12 // END -->
                </form>
            </div><!-- Row // END --> 
        </div><!-- Row // END --> 
    </div><!-- Row // END -->




</section>

<?php
require_once 'includes/footer.php';
?>			