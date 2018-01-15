<?php
require_once 'includes/header.php';
?>

<section class="content">
    <div class="container-fluid">
        <?php echo $lang_add_customer; ?>
        <form action="<?= base_url() ?>customers/insertCustomer" method="post">
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
                                    <div class="alert alert-info">
                                        <strong>Heads up!</strong> <?php echo $flash_desc; ?>
                                    </div>
                                    <?php
                                }
                                if ($flash_status == 'success') {
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Well done!</strong> <?php echo $flash_desc; ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>





                            <h3 class="card-inside-title">Add Customer</h3>
                            <div class="row clearfix">

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="fullname" class="form-control"maxlength="499" autofocus required autocomplete="off"/>
                                            <label class="form-label"><?php echo $lang_full_name; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control" maxlength="254" autocomplete="off" />
                                            <label class="form-label"><?php echo $lang_email; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="mobile" class="form-control" maxlength="499" autofocus autocomplete="off"  />
                                            <label class="form-label"><?php echo $lang_mobile; ?></label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button class="btn btn-primary"><?php echo $lang_add; ?></button>
                                        <a class="btn btn-primary" href="<?= base_url() ?>customers/view"><?php echo $lang_back; ?></a>
                                    </div>


                                </div>
                            </div>
                        </div>



                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->
            </div><!-- Col md 12 // END -->
        </form>
    </div><!-- Row // END -->




</section><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>