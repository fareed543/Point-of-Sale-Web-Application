<?php
require_once 'includes/header.php';
?>
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

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_add_product; ?></h1>
        </div>
    </div><!--/.row-->

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_product_code; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="code" class="form-control" maxlength="250" autofocus required autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_product_name; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="name" class="form-control" maxlength="250" required autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_product_category; ?> <span style="color: #F00">*</span></label>
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


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_purchase_price; ?> (<?php echo $lang_cost; ?>) <span style="color: #F00">*</span></label>
                                    <input type="text" name="purchase" class="form-control" maxlength="250" autofocus required autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_retail_price; ?> (<?php echo $lang_price; ?>) <span style="color: #F00">*</span></label>
                                    <input type="text" name="retail" class="form-control" maxlength="250" required autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_product_image; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <input id="uploadFile" readonly style="height: 40px; width: 230px; border: 1px solid #ccc" />
                                    <div class="fileUpload btn btn-primary" style="padding: 9px 12px;">
                                        <span><?php echo $lang_browse; ?></span>
                                        <input id="uploadBtn" name="uploadFile" type="file" class="upload" />
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color <span style="color: #F00"></span></label>
                                    <input type="text" name="color" class="form-control jscolor" maxlength="250" autofocus autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
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

                <a href="<?= base_url() ?>products/list_products" style="text-decoration: none;">
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