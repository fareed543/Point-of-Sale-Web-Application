<?php
require_once 'includes/header.php';
?>

<script src="<?= base_url() ?>assets/js/jquery-1.11.0.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/typeahead.min.js"></script>

<!-- Select2 -->
<link href="<?= base_url() ?>assets/css/select2.min.css" rel="stylesheet">

<script>
    $(document).ready(function () {
        /*
         document.getElementById("uploadBtn").onchange = function () {
         document.getElementById("uploadFile").value = this.value;
         };
         */

        $('input#typeahead').typeahead({
            name: 'typeahead',
            remote: '<?= base_url() ?>purchase_order/searchProduct?q=%QUERY',
            limit: 10
        });

        $("#addToList").click(function () {
            var row_count = document.getElementById("row_count").value;
            var pcode = document.getElementById("typeahead").value;

            if (pcode.length > 0) {

                var addNewCustomer = $.ajax({
                    url: '<?= base_url() ?>purchase_order/checkPcode?pcode=' + pcode,
                    type: 'GET',
                    cache: false,
                    data: {
                        format: 'json'
                    },
                    error: function () {
                        //alert("Sorry! we do not have stock!");
                    },
                    dataType: 'json',
                    success: function (data) {
                        var status = data.errorMsg;
                        var name = data.name;

                        if (status == "failure") {
                            alert("Invalid Product Code! Please search Product by Product Code");


                        } else {
                            var cell = $('<tr id="row_' + row_count + '"><td>' + pcode + '</td><td>' + name + '</td><td><input type="text" class="form-control" name="qty_' + row_count + '" value="1" style="width: 50%;" /></td><td><a onclick="deletediv(' + row_count + ')" style="cursor:pointer"><i class="icono-cross" style="color:#F00;"></i></a></td></tr><input type="hidden" class="form-control" name="pcode_' + row_count + '" value="' + pcode + '" />');


                            $('#addItemWrp').append(cell);


                            row_count++;

                            document.getElementById("typeahead").value = "";
                            document.getElementById("row_count").value = row_count;
                        }

                    }
                });





            } else {
                alert("Please search the product by Product Code OR Name!");
                //document.getElementById("typeahead").focus();
            }

        });

    });

    function deletediv(ele) {
        $('#row_' + ele).remove();
    }

    /*
     document.addEventListener('DOMContentLoaded', function() {
     document.getElementById("addToList").addEventListener("click", handler);
     });
     
     function handler() {
     alert("A");	
     }
     */
</script>

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

    .typeahead, .tt-query, .tt-hint {
        border: 1px solid #CCCCCC;
        border-radius: 4px;
        font-size: 14px;
        height: 40px;
        line-height: 30px;
        outline: medium none;
        padding: 8px 12px;
        width: 312px;
    }
    .typeahead {
        background-color: #FFFFFF;
    }
    .typeahead:focus {
        border: 2px solid #0097CF;
    }
    .tt-query {
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }
    .tt-hint {
        color: #999999;
    }
    .tt-dropdown-menu {
        background-color: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 4px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        margin-top: 0px;
        padding: 8px 0;
        width: 312px;
    }
    .tt-suggestion {
        font-size: 14px;
        line-height: 24px;
        padding: 3px 20px;
    }
    .tt-suggestion.tt-is-under-cursor {
        background-color: #0097CF;
        color: #FFFFFF;
    }
    .tt-suggestion p {
        margin: 0;
    }
</style>



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_create_purchase_order; ?></h1>
        </div>
    </div><!--/.row-->

    <form action="<?= base_url() ?>purchase_order/insertNewPO" method="post" enctype="multipart/form-data">
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
                                    <label><?php echo $lang_purchase_order_number; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="po_number" class="form-control" maxlength="250" autofocus required autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_outlets; ?> <span style="color: #F00">*</span></label>
                                    <select name="outlet" class="form-control" required>
                                        <option value=""><?php echo $lang_choose_outlet; ?></option>
                                        <?php
                                        if ($user_role == 1) {
                                            $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
                                        } else {
                                            $outletData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$user_outlet");
                                        }
                                        for ($u = 0; $u < count($outletData); ++$u) {
                                            $outlet_id = $outletData[$u]->id;
                                            $outlet_name = $outletData[$u]->name;
                                            ?>
                                            <option value="<?php echo $outlet_id; ?>">
                                                <?php echo $outlet_name; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_suppliers; ?> <span style="color: #F00">*</span></label>
                                    <select name="supplier" class="form-control" required>
                                        <option value=""><?php echo $lang_choose_supplier; ?></option>
                                        <?php
                                        $supplierData = $this->Constant_model->getDataOneColumnSortColumn('suppliers', 'status', '1', 'name', 'ASC');
                                        for ($s = 0; $s < count($supplierData); ++$s) {
                                            $supplier_id = $supplierData[$s]->id;
                                            $supplier_name = $supplierData[$s]->name;
                                            ?>
                                            <option value="<?php echo $supplier_id; ?>"><?php echo $supplier_name; ?></option>
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
                                    <label><?php echo $lang_created_date; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="po_date" value="<?php echo date($dateformat, time()); ?>" readonly class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_note; ?></label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!--
                                <div class="form-group">
                                        <label>File</label>
                                        <br />
                                        <input id="uploadFile" readonly style="height: 40px; width: 270px; border: 1px solid #ccc" />
                                        <div class="fileUpload btn btn-primary" style="padding: 9px 12px;">
                                            <span>Browse</span>
                                            <input id="uploadBtn" name="uploadFile" type="file" class="upload" />
                                        </div>
                                </div>
                                -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="border-top: 1px solid #ccc;"></div>
                        </div>

                        <!-- Product List // START -->
                        <div class="row" style="padding-top: 7px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_search_product; ?> <span style="color: #F00">*</span></label>
                                    <!-- <input type="text" class="form-control" id="typeahead" placeholder="Search Product" name="typeahead" /> -->
                                    <select id="typeahead" class="add_product_po form-control">
                                        <option value=""><?php echo $lang_search_product_by_namecode; ?></option>
                                        <?php
                                        $prodData = $this->Constant_model->getDataAll('products', 'id', 'DESC');
                                        for ($p = 0; $p < count($prodData); ++$p) {
                                            $prod_code = $prodData[$p]->code;
                                            $prod_name = $prodData[$p]->name;
                                            ?>
                                            <option value="<?php echo $prod_code; ?>">
                                                <?php echo $prod_name . ' [' . $prod_code . ']'; ?>
                                            </option>
                                            <?php
                                            unset($prod_code);
                                            unset($prod_name);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>&nbsp;</label>
                                <div style="background-color: #686868; color: #FFF; width: 200px; text-align: center; border-radius: 4px; padding: 9px 0px; cursor: pointer;" id="addToList"><?php echo $lang_add_to_list; ?></div>
                            </div>
                        </div>

                        <!--
                                                                <div class="row">
                                                                        <div class="col-md-4" id="displaySearchProduct">
                                                                                
                                                                        </div>
                                                                </div>
                        -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="30%" style="background-color: #686868; color: #FFF;"><?php echo $lang_product_name; ?></th>
                                                <th width="30%" style="background-color: #686868; color: #FFF;"><?php echo $lang_product_code; ?></th>
                                                <th width="30%" style="background-color: #686868; color: #FFF;"><?php echo $lang_order_qty; ?></th>
                                                <th width="10%" style="background-color: #686868; color: #FFF;"><?php echo $lang_action; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="addItemWrp">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Product List // END -->





                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <div class="form-group">
                                        <input type="hidden" id="row_count" name="row_count" value="1" />
                                        <button class="btn btn-primary" style="padding: 15px 40px;"><?php echo $lang_submit; ?></button>
                                    </div>
                                </center>
                            </div>
                        </div>



                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->

                <a href="<?= base_url() ?>purchase_order/po_view" style="text-decoration: none;">
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

<script src="<?= base_url() ?>assets/js/select2.full.min.js"></script>
<!-- Select2 -->
<script>
    $(document).ready(function () {
        $(".add_product_po").select2({
            placeholder: "<?php echo $lang_search_product_by_namecode; ?>",
            allowClear: true
        });
    });
</script>
