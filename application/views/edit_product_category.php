<?php
require_once 'includes/header.php';
?>

<?php
$categoryData = $this->Constant_model->getDataOneColumn('category', 'id', $id);

if (count($categoryData) == 0) {
    redirect(base_url(), 'refresh');
}

$category_name = $categoryData[0]->name;
$status = $categoryData[0]->status;
?>
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<section class="content">
	<div class="container-fluid">
<!--<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_edit_product_category; ?> : <?php echo $category_name; ?></h1>
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
                                <form action="<?= base_url() ?>products/deleteproductcategory" method="post" onsubmit="return confirm('Do you want to delete this Product Category?')">
                                    <input type="hidden" name="cat_id" value="<?php echo $id; ?>" />
                                    <input type="hidden" name="cat_name" value="<?php echo $category_name; ?>" />
                                    <button type="submit" class="btn btn-primary" style="border: 0px; background-color: #c72a25;">
                                        <?php echo $lang_delete_product_category; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <form action="<?= base_url() ?>products/updateProductCategory" method="post">				
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_name; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="category" class="form-control" maxlength="490" autofocus required autocomplete="off" value="<?php echo $category_name; ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $lang_status; ?> <span style="color: #F00">*</span></label>
                                    <select name="status" class="form-control show-tick" data-live-search="true">
                                        <option value="0" <?php
                                        if ($status == '0') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_inactive; ?></option>
                                        <option value="1" <?php
                                        if ($status == '1') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_active; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

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

            <a href="<?= base_url() ?>products/product_category" style="text-decoration: none;">
                <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                    <i class="icono-caretLeft" style="color: #FFF;"></i><?php echo $lang_back; ?>
                </div>
            </a>

        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->


    <br /><br /><br /><br /><br />

<!--</div> Right Colmn // END -->
        </div>
</section>


<?php
require_once 'includes/footer.php';
?>