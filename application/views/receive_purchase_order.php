<?php
require_once 'includes/header.php';
?>
<?php
$poDtaData = $this->Constant_model->getDataOneColumn('purchase_order', 'id', $id);

if (count($poDtaData) == 0) {
    redirect(base_url());
}

$po_numb = $poDtaData[0]->po_number;
$po_supplier_id = $poDtaData[0]->supplier_id;
$po_outlet_id = $poDtaData[0]->outlet_id;
$po_date = $poDtaData[0]->po_date;
$po_attachment = $poDtaData[0]->attachment_file;
$po_note = $poDtaData[0]->note;
$po_status = $poDtaData[0]->status;

$po_outlet_name = $poDtaData[0]->outlet_name;
$po_supplier_name = $poDtaData[0]->supplier_name;

$discount = $poDtaData[0]->discount_amount;
$subTotal = $poDtaData[0]->subTotal;
$taxTotal = $poDtaData[0]->tax;
$grandTotal = $poDtaData[0]->grandTotal;
?>

<script src="<?= base_url() ?>assets/js/jquery-1.11.0.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/typeahead.min.js"></script>

<script>
    $(document).ready(function () {

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
                alert("Please search the product by Product Code!");
                document.getElementById("typeahead").focus();
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
        width: 360px;
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
        width: 360px;
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
            <h1 class="page-header"><?php echo $lang_receive_from_supplier; ?></h1>
        </div>
    </div><!--/.row-->

    <form action="<?= base_url() ?>purchase_order/ReceiveItemsPO" method="post" enctype="multipart/form-data">
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
                        if ($po_status != '1') {
                            ?>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="<?= base_url() ?>purchase_order/exportPurchaseOrder?id=<?php echo $id; ?>" style="text-decoration: none;" target="_blank">
                                        <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                            <?php echo $lang_print_purchase_order; ?>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_purchase_order_number; ?> <span style="color: #F00">*</span></label><br />
                                    <?php echo $po_numb; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_outlets; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <?php echo $po_outlet_name; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_suppliers; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <?php echo $po_supplier_name; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_created_date; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <?php echo date($dateformat, time()); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_note; ?></label>
                                    <br />
                                    <?php echo $po_note; ?>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="color: #c72a25;">
                                    <label style="color: #c72a25;"><?php echo $lang_purchase_order_status; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <?php
                                    $poStatusData = $this->Constant_model->getDataOneColumn('purchase_order_status', 'id', "$po_status");
//echo $poStatusData[0]->name;

                                    if ($po_status == '1') {
                                        echo $lang_created;
                                    } elseif ($po_status == '2') {
                                        echo $lang_sent_to_supplier;
                                    } elseif ($po_status == '3') {
                                        echo $lang_received_from_supplier;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-8"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="border-top: 1px solid #ccc;"></div>
                        </div>

                        <!-- Product List // START -->

                        <script type="text/javascript">
                            function getValue() {
                                var total_count = document.getElementById("total_row_count").value;
                                var dbTax = document.getElementById("dbtax").value;
                                var discount = document.getElementById("discount").value;

                                if (discount.length == 0) {
                                    discount = 0;
                                }
                                discount = parseFloat(discount);

                                var total_amt = 0;
                                for (var i = 1; i < total_count; i++) {
                                    var qty = document.getElementById("qty_" + i).value;
                                    var cost = document.getElementById("cost_" + i).value;

                                    if (qty.length == 0) {
                                        qty = 0;
                                    }
                                    if (cost.length == 0) {
                                        cost = 0;
                                    }

                                    qty = parseInt(qty);
                                    cost = parseFloat(cost);

                                    total_amt += (qty * cost);
                                }

                                total_amt = total_amt - discount;

                                var subTotal = 0;
                                var taxTotal = 0;
                                var grandTotal = 0;

                                var taxTotal = total_amt * (dbTax / 100);

                                subTotal = total_amt - taxTotal;
                                grandTotal = subTotal + taxTotal;

                                document.getElementById("subTotal").value = subTotal.toFixed(2);
                                document.getElementById("tax").value = taxTotal.toFixed(2);
                                document.getElementById("grandTotal").value = grandTotal.toFixed(2);
                            }
                            function calculateDiscount(ele) {
                                var total_count = document.getElementById("total_row_count").value;
                                var dbTax = document.getElementById("dbtax").value;
                                var discount = document.getElementById("discount").value;

                                if (discount.length == 0) {
                                    discount = 0;
                                }
                                discount = parseFloat(discount);

                                var total_amt = 0;
                                for (var i = 1; i < total_count; i++) {
                                    var qty = document.getElementById("qty_" + i).value;
                                    var cost = document.getElementById("cost_" + i).value;

                                    if (qty.length == 0) {
                                        qty = 0;
                                    }
                                    if (cost.length == 0) {
                                        cost = 0;
                                    }

                                    qty = parseInt(qty);
                                    cost = parseFloat(cost);

                                    total_amt += (qty * cost);
                                }

                                total_amt = total_amt - discount;

                                var subTotal = 0;
                                var taxTotal = 0;
                                var grandTotal = 0;

                                var taxTotal = total_amt * (dbTax / 100);

                                subTotal = total_amt - taxTotal;
                                grandTotal = subTotal + taxTotal;

                                document.getElementById("subTotal").value = subTotal.toFixed(2);
                                document.getElementById("tax").value = taxTotal.toFixed(2);
                                document.getElementById("grandTotal").value = grandTotal.toFixed(2);
                            }
                        </script>

                        <div class="row" style="margin-top: 7px;">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="15%" style="background-color: #686868; color: #FFF;"><?php echo $lang_product_code; ?></th>
                                                <th width="15%" style="background-color: #686868; color: #FFF;"><?php echo $lang_product_name; ?></th>
                                                <th width="15%" style="background-color: #686868; color: #FFF;"><?php echo $lang_ordered_quantity; ?></th>
                                                <th width="15%" style="background-color: #686868; color: #FFF;"><?php echo $lang_received_quantity; ?></th>
                                                <th width="15%" style="background-color: #686868; color: #FFF;"><?php echo $lang_each_cost; ?> (<?php echo $currency; ?>)</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $jj = 1;

                                        $poItemData = $this->Constant_model->getDataOneColumnSortColumn('purchase_order_items', 'po_id', $id, 'id', 'ASC');
                                        for ($pi = 0; $pi < count($poItemData); ++$pi) {
                                            $po_item_id = $poItemData[$pi]->id;
                                            $po_item_pcode = $poItemData[$pi]->product_code;
                                            $po_item_qty = $poItemData[$pi]->ordered_qty;
                                            $po_rec_qty = $poItemData[$pi]->received_qty;
                                            $po_rec_cost = $poItemData[$pi]->cost;

                                            $poNameResult = $this->db->query("SELECT * FROM products WHERE code = '$po_item_pcode' ");
                                            $poNameData = $poNameResult->result();

                                            $po_name = $poNameData[0]->name;
                                            ?>
                                            <tr>
                                                <td><?php echo $po_item_pcode; ?></td>
                                                <td><?php echo $po_name; ?></td>
                                                <td>
                                                    <input type="text" name="existQty_<?php echo $po_item_id; ?>" class="form-control" value="<?php echo $po_item_qty; ?>" style="width: 80%;" <?php
                                                    if ($po_status != '1') {
                                                        echo 'readonly';
                                                    }
                                                    ?> />
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($po_rec_qty != 0) {
                                                        echo $po_rec_qty;
                                                    } else {
                                                        ?>
                                                        <input type="text" id="qty_<?php echo $jj; ?>" name="receiveQty_<?php echo $po_item_id; ?>" class="form-control" style="width: 80%;" onkeyup="getValue()" />
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($po_rec_qty != 0) {
                                                        echo number_format($po_rec_cost, 2, '.', '');
                                                    } else {
                                                        ?>
                                                        <input type="text" id="cost_<?php echo $jj; ?>" name="receiveCost_<?php echo $po_item_id; ?>" class="form-control" style="width: 80%;" onkeyup="getValue()" />
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            ++$jj;
                                        }
                                        ?>
                                        <tr>
                                            <td style="vertical-align: middle; text-align: right; border-top: 1px solid #000;">
                                                <b><?php echo $lang_discount_amount; ?> (<?php echo $currency; ?>) :</b>
                                            </td>
                                            <td style="border-top: 1px solid #000; vertical-align: middle;">
                                                <?php
                                                if ($po_status != '3') {
                                                    ?>
                                                    <input type="text" name="discount" id="discount" class="form-control" onkeyup="calculateDiscount(this.value)" />
                                                    <?php
                                                } else {
                                                    echo number_format($discount, 2, '.', '');
                                                }
                                                ?>
                                            </td>
                                            <td colspan="2" align="right" valign="middle" style="vertical-align : middle; border-top: 1px solid #000;"><b><?php echo $lang_total; ?> (<?php echo $currency; ?>) : </b></td>
                                            <td style="border-top: 1px solid #000;">
                                                <?php
                                                if ($po_status != '3') {
                                                    ?>
                                                    <input type="text" name="subTotal" id="subTotal" class="form-control" required readonly style="width: 80%;" />
                                                    <?php
                                                } else {
                                                    echo number_format($subTotal, 2, '.', '');
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right" valign="middle" style="vertical-align : middle;"><b><?php echo $lang_tax; ?> (<?php echo $tax; ?>%) (<?php echo $currency; ?>) :</b></td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                if ($po_status != '3') {
                                                    ?>
                                                    <input type="text" name="tax" id="tax" class="form-control" required readonly style="width: 80%;" />
                                                    <?php
                                                } else {
                                                    echo number_format($taxTotal, 2, '.', '');
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right" valign="middle" style="vertical-align : middle;"><b><?php echo $lang_totat_payable; ?> (<?php echo $currency; ?>):</b></td>
                                            <td>
                                                <?php
                                                if ($po_status != '3') {
                                                    ?>
                                                    <input type="text" name="grandTotal" id="grandTotal" class="form-control" required readonly style="width: 80%;" />
                                                    <?php
                                                } else {
                                                    echo number_format($grandTotal, 2, '.', '');
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <input type="hidden" id="total_row_count" value="<?php echo $jj; ?>" />
                                        <input type="hidden" id="dbtax" name="dbtax" value="<?php echo $tax; ?>" />
                                        <tr>
                                            <td colspan="5" align="center">
                                                <?php
                                                if ($po_status != '3') {
                                                    ?>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                    <input type="hidden" name="outlet_id" value="<?php echo $po_outlet_id; ?>" />
                                                    <button class="btn btn-primary" style="font-size: 15px; padding: 15px 40px;"><?php echo $lang_receive; ?></button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Product List // END -->




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

