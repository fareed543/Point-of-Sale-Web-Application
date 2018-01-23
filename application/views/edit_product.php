<?php
require_once 'includes/header.php';
?>
<?php
$prodData = $this->Constant_model->getDataOneColumn('products', 'id', $id);

if (count($prodData) == 0) {
redirect(base_url());
}

$code = $prodData[0]->code;
$name = $prodData[0]->name;
$category = $prodData[0]->category;
$cost = $prodData[0]->purchase_price;
$price = $prodData[0]->retail_price;
$thumbnail = $prodData[0]->thumbnail;
$color = $prodData[0]->color;
$status = $prodData[0]->status;
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

<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><a href="<?= base_url() ?>setting/outlets"><i class="material-icons">store</i> Outlets</a></li>
                    <li class="active"><i class="material-icons">mode_edit</i> <?php echo $lang_edit_product; ?> : <?php echo $code; ?></li>
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

                <form action="<?= base_url() ?>products/updateProduct" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">




                                    <h3 class="card-inside-title"><?php echo $lang_edit_product; ?> </h3>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="code" class="form-control" maxlength="250" autofocus required autocomplete="off" value="<?php echo $code; ?>" readonly />
                                                    <label class="form-label"><?php echo $lang_product_code; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <input type="text" name="name" class="form-control" maxlength="250" required autocomplete="off" value="<?php echo $name; ?>" />
                                                    <label class="form-label"><?php echo $lang_product_name; ?> <span style="color: #F00">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <select name="category"  class="form-control show-tick" data-live-search="true" required>
                                                        <option value="">Choose Category</option>
                                                        <?php
                                                        $catData = $this->Constant_model->getDataOneColumn('category', 'status', '1');
                                                        for ($c = 0; $c < count($catData); ++$c) {
                                                            $cat_id = $catData[$c]->id;
                                                            $cat_name = $catData[$c]->name;
                                                            ?>
                                                            <option value="<?php echo $cat_id; ?>" <?php
                                                            if ($category == $cat_id) {
                                                                echo 'selected="selected"';
                                                            }
                                                            ?>><?php echo $cat_name; ?></option>
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
                                                    <label class="form-label"><?php echo $lang_purchase_price; ?> (<?php echo $lang_cost; ?>) <span style="color: #F00">*</span></label>
                                                    <input type="text" name="purchase" class="form-control" maxlength="250" autofocus required autocomplete="off" value="<?php echo $cost; ?>" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label"><?php echo $lang_retail_price; ?> (<?php echo $lang_price; ?>) <span style="color: #F00">*</span></label>
                                                    <input type="text" name="retail" class="form-control" maxlength="250" required autocomplete="off" value="<?php echo $price; ?>" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
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



                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select name="status" class="form-control show-tick" data-live-search="true" required>
                                                        <option value="1" <?php
                                                        if ($status == '1') {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>><?php echo $lang_active; ?></option>
                                                        <option value="0" <?php
                                                        if ($status == '0') {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>><?php echo $lang_inactive; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label">Color <span style="color: #F00"></span></label>
                                                    <input name="color" class="form-control jscolor"  value="<?php echo $color; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <?php
                                                    if ($thumbnail != 'no_image.jpg') {
                                                        ?>
                                                        <img src="<?= base_url() ?>assets/upload/products/xsmall/<?php echo $code; ?>/<?php echo $thumbnail; ?>" />
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <?php
                                    if ($user_role == '1') {
                                        ?>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                    <button class="btn btn-primary"><?php echo $lang_update; ?></button>
                                                    <a class="btn btn-primary" href="<?= base_url() ?>products/list_products"><?php echo $lang_back; ?></a>
                                                </div>


                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                </div>

                            </div><!-- Panel Body // END -->
                        </div><!-- Panel Default // END -->
                    </div><!-- Col md 12 // END -->
                </form>
            </div><!-- Row // END -->
        </div><!-- Row // END -->
    </div><!-- Row // END -->

</section><!-- Right Colmn // END -->

<?php
require_once 'includes/footer.php';
?>
