<?php require_once 'includes/header.php'; ?>
<!--Select Dropdown js start-->     
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!--Select Dropdown js end-->
<style type="text/css">
    .fileUpload {
        position: relative;
        overflow: hidden;
        border-radius: 0px;
        margin-left: -4px;
        margin-top: -2px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    });
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><a href="<?= base_url() ?>products/list_products"><i class="material-icons">view_module</i> <?php echo $lang_list_products; ?></a></li>
                    <li class="active"><i class="material-icons">mode_edit</i> <?php echo $lang_add_product; ?></li>
                </ol>

                <form action="<?= base_url() ?>products/insertProduct" method="post" enctype="multipart/form-data">

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



                                    <h3 class="card-inside-title"><?php echo $lang_add_product; ?></h3>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label"><?php echo $lang_product_code; ?></label>
                                                    <input type="text" name="code" class="form-control" maxlength="250" autofocus required autocomplete="off" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label"><?php echo $lang_product_name; ?></label>
                                                    <input type="text" name="name" class="form-control" maxlength="250" required autocomplete="off" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <!--<label><?php echo $lang_product_category; ?></label>-->
                                                    <select name="category" class="form-control" required>
                                                        <option value=""><?php echo $lang_select_product_category; ?></option>
                                                        <?php
                                                        $catData = $this->Constant_model->getDataOneColumn('category', 'status', '1');
                                                        for ($c = 0; $c < count($catData); ++$c) {
                                                            $cat_id = $catData[$c]->id;
                                                            $cat_name = $catData[$c]->name;
                                                            ?>
                                                            <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label><?php echo $lang_purchase_price; ?> (<?php echo $lang_cost; ?>)</label>
                                                    <input type="text" name="purchase" class="form-control" maxlength="250" autofocus required autocomplete="off" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label><?php echo $lang_retail_price; ?> (<?php echo $lang_price; ?>) <span>*</span></label>
                                                    <input type="text" name="retail" class="form-control" maxlength="250" required autocomplete="off" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <label><?php echo $lang_product_image; ?> <span>*</span></label>
                                                    <br />
                                                    <input id="uploadFile" readonly/>
                                                    <div class="fileUpload btn btn-primary">
                                                        <span><?php echo $lang_browse; ?></span>
                                                        <input id="uploadBtn" name="uploadFile" type="file" class="upload" />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label>Color <span style="color: #F00"></span></label>
                                                    <input type="text" name="color" class="form-control jscolor" maxlength="250" autofocus autocomplete="off" />


                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>



                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">

                                                <button class="btn btn-primary"><?php echo $lang_add; ?></button>
                                                <a class="btn btn-primary" href="<?= base_url() ?>products/list_products"><?php echo $lang_back; ?></a>
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

</section><!-- Right Colmn // END -->



<?php require_once 'includes/footer.php'; ?>