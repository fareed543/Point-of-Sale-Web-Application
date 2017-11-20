<?php
require_once 'includes/pos_header.php';
?>
<style>
    .payment-load-customer{
        width: 268px !important;
    }
    .close-button{
        float:right;
    }
</style>
<script src="<?= base_url() ?>assets/js/jquery-1.10.2.js"></script>

<div class="col-sm-12 col-lg-12 main">
    <div class="row">
        <div class="col-lg-12">
            &nbsp;
        </div>
    </div><!--/.row-->

    <?php
    if (!empty($alert_msg)) {
        ?>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $("#notification").show().delay(5000).fadeOut();
            });
        </script>
        <?php
        $flash_status = $alert_msg[0];
        $flash_header = $alert_msg[1];
        $flash_desc = $alert_msg[2];

        if ($flash_status == 'failure') {
            
        }

        if ($flash_status == 'success') {
            ?>
            <div class="row" id="notification">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-size: 20px; height: 50px; line-height: 27px;">
                            <i class="icono-checkCircle" style="color: #090; font-size: 11px;"></i> <?php echo $flash_desc; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>	


    <form action="<?= base_url() ?>pos/insertSale" method="post">	
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row" style="margin-top: 0px;">
                            <div class="col-md-4" style="padding-right: 0px;">

                                <script type="text/javascript">
                                    $(document).on('ready', function () {
                                        //$('body').on('click','button',function(){});
                                        $("#searchProd").keyup(function () {
                                            // Retrieve the input field text
                                            var filter = $(this).val();

                                            $("#allProd #proname").each(function () {
                                                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                                                    $(this).parent().hide();
                                                } else {
                                                    $(this).parent().show();
                                                }
                                            });
                                        });

                                        $("#pop_add_cust_submit").click(function () {
                                            var fn = document.getElementById("pop_cust_fn").value;
                                            var em = document.getElementById("pop_cust_em").value;
                                            var mb = document.getElementById("pop_cust_mb").value;

                                            if (fn.length == 0) {
                                                alert("Please enter your Full Name!");
                                                document.getElementById("pop_cust_fn").focus();
                                            } else {
                                                var addNewCustomer = $.ajax({
                                                    url: '<?= base_url() ?>pos/addNewCustomer?fn=' + fn + '&em=' + em + '&mb=' + mb,
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
                                                        document.getElementById("pop_cust_fn").value = "";
                                                        document.getElementById("pop_cust_em").value = "";
                                                        document.getElementById("pop_cust_mb").value = "";

                                                        $('#addCustomerPopUp').modal('hide');
                                                        $('#successaddedNewCustomer').modal('show');
                                                    }
                                                });
                                            }	// End of Else;
                                        });


                                        $("#pcodeBarcode").keyup(function (e) {
                                            if (e.keyCode == 13) {
                                                var pcode = document.getElementById("pcodeBarcode").value;

                                                var row_count = document.getElementById("row_count").value;
                                                row_count = parseInt(row_count);
                                                var add_row_count = row_count;

                                                var discount_amt = document.getElementById("dis_amt").value;
                                                if (discount_amt.length == 0) {
                                                    discount_amt = 0;
                                                }
                                                discount_amt = parseFloat(discount_amt);

                                                var tax = document.getElementById("tax").value;
                                                tax = parseFloat(tax);

                                                //document.getElementById("row_count").value 	= add_row_count;

                                                var temp_outlet = document.getElementById("outlet").value;

                                                var resultPrice = $.ajax({
                                                    url: '<?= base_url() ?>pos/getProductDetail?pcode=' + pcode + '&outlet_id=' + temp_outlet,
                                                    type: 'GET',
                                                    cache: false,
                                                    data: {
                                                        format: 'json'
                                                    },
                                                    error: function () {
                                                        alert("Please check your code and try again!");
                                                    },
                                                    dataType: 'json',
                                                    success: function (data) {
                                                        var name = data.prod_name;
                                                        var price = data.price;
                                                        var qty = data.qty;

                                                        if (add_row_count == 1) {

                                                            if (qty >= 1) {
                                                                var msgs = '<div class="row" id="item_row_' + add_row_count + '" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-4" style="background-color: #4d9fe4; color: #FFF;">' + name + ' <br />[' + pcode + ']</div><div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;"><div class="row"><div class="col-md-3" style="padding-top:7px"><span onclick="minusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/minus_icon.png" /></span></div><div class="col-md-6" style="padding-left: 0px; padding-right: 0px;"><input type="text" id="display_qty_' + add_row_count + '" class="form-control" value="1" onchange="manualQty(this.value, ' + add_row_count + ')" style="text-align:center;" /></div><div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span onclick="plusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/plus_icon.png" /></span></div></div></div><div class="col-md-3">' + price + '</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(' + add_row_count + ')" style="cursor:pointer;">x</span></div></div><input type="hidden" name="pcode_' + add_row_count + '" id="pcode_' + add_row_count + '" value="' + pcode + '" /><input type="hidden" name="price_' + add_row_count + '" id="price_' + add_row_count + '" value="' + price + '" /><input type="hidden" name="qty_' + add_row_count + '" id="qty_' + add_row_count + '" value="1" />';
                                                                logDiv.append(msgs + "");

                                                                add_row_count++;
                                                                document.getElementById("row_count").value = add_row_count;
                                                            } else {
                                                                $('#outofstockwrp').modal('show');
                                                                //alert("Out of Stock! Please Make Purchase Order!");
                                                            }
                                                        } else {

                                                            var check_existing_pcode = 0;

                                                            for (var q = 1; q < add_row_count; q++) {
                                                                var exist_pcode = document.getElementById("pcode_" + q).value;

                                                                if (pcode == exist_pcode) {
                                                                    check_existing_pcode++;
                                                                }
                                                            }

                                                            if (check_existing_pcode == 0) {

                                                                if (qty >= 1) {
                                                                    var msgs = '<div class="row" id="item_row_' + add_row_count + '" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-4" style="background-color: #4d9fe4; color: #FFF;">' + name + ' <br />[' + pcode + ']</div><div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;"><div class="row"><div class="col-md-3" style="padding-top:7px"><span onclick="minusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/minus_icon.png" /></span></div><div class="col-md-6" style="padding-left: 0px; padding-right: 0px;"><input type="text" id="display_qty_' + add_row_count + '" class="form-control" value="1" onchange="manualQty(this.value, ' + add_row_count + ')" style="text-align:center;" /></div><div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span onclick="plusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/plus_icon.png" /></span></div></div></div><div class="col-md-3">' + price + '</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(' + add_row_count + ')" style="cursor:pointer;">x</span></div></div><input type="hidden" name="pcode_' + add_row_count + '" id="pcode_' + add_row_count + '" value="' + pcode + '" /><input type="hidden" name="price_' + add_row_count + '" id="price_' + add_row_count + '" value="' + price + '" /><input type="hidden" name="qty_' + add_row_count + '" id="qty_' + add_row_count + '" value="1" />';
                                                                    logDiv.append(msgs + "");

                                                                    add_row_count++;
                                                                    document.getElementById("row_count").value = add_row_count;
                                                                } else {
                                                                    $('#outofstockwrp').modal('show');
                                                                    //alert("Out of Stock! Please make Purchase Order!");
                                                                }
                                                            } else {

                                                                for (var q = 1; q < add_row_count; q++) {
                                                                    var exist_pcode = document.getElementById("pcode_" + q).value;
                                                                    var exist_qty = document.getElementById("qty_" + q).value;

                                                                    exist_qty = parseInt(exist_qty);

                                                                    if (pcode == exist_pcode) {
                                                                        var new_qty = exist_qty + 1;

                                                                        if (qty >= new_qty) {
                                                                            //document.getElementById("display_qty_"+q).innerHTML 	= new_qty;	
                                                                            document.getElementById("display_qty_" + q).value = new_qty;
                                                                            document.getElementById("qty_" + q).value = new_qty;
                                                                        } else {
                                                                            $('#outofstockwrp').modal('show');
                                                                            //alert("Out of Stock! Please make Purchase Order!");
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        /*
                                                         var msgs 		= '<div class="row" id="item_row_'+add_row_count+'" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-6" style="background-color: #4d9fe4; color: #FFF;">'+name+' <br />['+pcode+']</div><div class="col-md-2">1</div><div class="col-md-3">'+price+'</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv('+add_row_count+')" style="cursor:pointer;">x</span></div><input type="hidden" name="pcode_'+add_row_count+'" id="pcode_'+add_row_count+'" value="'+pcode+'" /></div><input type="hidden" name="price_'+add_row_count+'" id="price_'+add_row_count+'" value="'+price+'" />';
                                                         logDiv.append( msgs + "" );
                                                         */

                                                        //document.getElementById("row_count").value 	= add_row_count;

                                                        var total_item_qty = 0;
                                                        var total_item_price = 0;
                                                        for (var p = 1; p < add_row_count; p++) {
                                                            var each_price = document.getElementById("price_" + p).value;
                                                            var each_qty = document.getElementById("qty_" + p).value;

                                                            each_price = parseFloat(each_price);
                                                            each_qty = parseInt(each_qty);

                                                            total_item_price += (each_price * each_qty);

                                                            if (each_price > 0) {
                                                                total_item_qty += each_qty;
                                                            }
                                                        }

                                                        total_item_price = total_item_price - discount_amt;

                                                        var total_tax_amt = total_item_price * (tax / 100);

                                                        var grandTotal = total_item_price + total_tax_amt;
                                                        grandTotal = grandTotal.toFixed(2);


                                                        document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                                                        document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                                                        document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
                                                        document.getElementById("total_payable").innerHTML = grandTotal;

                                                        // To display at Model;
                                                        document.getElementById("final_payable_amt").innerHTML = grandTotal;
                                                        document.getElementById("final_purchased_item").innerHTML = total_item_qty;

                                                        // To Insert DB;
                                                        document.getElementById("final_total_payable").value = grandTotal;
                                                        document.getElementById("final_total_qty").value = total_item_qty;

                                                        document.getElementById("total_item_qty").innerHTML = total_item_qty;

                                                        document.getElementById("subTotal").value = total_item_price.toFixed(2);

                                                        document.getElementById("pcodeBarcode").value = "";

                                                    }	// end of success;
                                                });
                                            }
                                        });

                                    });
                                </script>

                                <div class="row" style="margin-bottom: 5px;">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary" href="#addCustomerPopUp" data-toggle="modal" style="border: 0px; width: 100%; padding: 0px 12px;">
                                            <i class="icono-plus"></i> <?php echo $lang_add_customer; ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="pcodeBarcode" style="border: 1px solid #373942;" placeholder="<?php echo $lang_scan_barcode; ?>" />
                                    </div>
                                </div>
                                <div class="row" style="background-color: #373942; color: #FFF; font-weight: bold; padding-top: 10px; padding-bottom: 10px; margin: 0px; margin-top: 7px;">
                                    <div class="col-md-4"><?php echo $lang_products; ?></div>
                                    <div class="col-md-4"><?php echo $lang_qty; ?></div>
                                    <div class="col-md-3"><?php echo $lang_per_item; ?></div>
                                    <div class="col-md-1" style="font-weight: bold;">X</div>
                                </div>

                                <div style="overflow: scroll; height: 330px; width: 100%;">
                                    <?php
                                    $suspend_id = 0;
                                    $subTotal = 0;
                                    $dis_amt = 0;
                                    $tax_amt = 0;
                                    $grandTotal = 0;
                                    $total_items = 0;

                                    $sus_row_count = 1;

                                    if (isset($_GET['suspend_id'])) {
                                        $sus_id = $_GET['suspend_id'];

                                        $suspend_id = $_GET['suspend_id'];

                                        $susData = $this->Constant_model->getDataTwoColumn('suspend', 'id', "$sus_id", 'status', '0');
                                        if (count($susData) == 1) {
                                            $subTotal = $susData[0]->subtotal;
                                            $dis_amt = $susData[0]->discount_total;
                                            $tax_amt = $susData[0]->tax;
                                            $grandTotal = $susData[0]->grandtotal;
                                            $total_items = $susData[0]->total_items;

                                            $susItemData = $this->Constant_model->getDataOneColumn('suspend_items', 'suspend_id', $sus_id);
                                            if (count($susItemData) > 0) {
                                                //$sus_row_count 	= 1;
                                            }

                                            for ($si = 0; $si < count($susItemData); ++$si) {
                                                $sus_pcode = $susItemData[$si]->product_code;
                                                $sus_price = $susItemData[$si]->product_price;
                                                $sus_qty = $susItemData[$si]->qty;
                                                $pcode_name = $susItemData[$si]->product_name;
                                                ?>
                                                <div class="row" id="item_row_<?php echo $sus_row_count; ?>" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;">
                                                    <div class="col-md-4" style="background-color: #4d9fe4; color: #FFF;"><?php echo $pcode_name; ?><br />[<?php echo $sus_pcode; ?>]</div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-3" style="padding-top:7px">
                                                                <span onclick="minusDiv('<?php echo $sus_row_count; ?>')" style="cursor:pointer;">
                                                                    <img src="<?= base_url() ?>assets/img/minus_icon.png" />
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
                                                                <input type="text" id="display_qty_<?php echo $sus_row_count; ?>" class="form-control" value="<?php echo $sus_qty; ?>" onchange="manualQty(this.value, '<?php echo $sus_row_count; ?>')" style="text-align:center;" />
                                                            </div>
                                                            <div class="col-md-3" style="padding-left:5px; padding-top:7px;">
                                                                <span onclick="plusDiv('<?php echo $sus_row_count; ?>')" style="cursor:pointer;">
                                                                    <img src="<?= base_url() ?>assets/img/plus_icon.png" />
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3"><?php echo $sus_price; ?></div>
                                                    <div class="col-md-1" style="font-weight: bold;">
                                                        <span onclick="deleteDiv('<?php echo $sus_row_count; ?>')" style="cursor:pointer;">x</span>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="pcode_<?php echo $sus_row_count; ?>" id="pcode_<?php echo $sus_row_count; ?>" value="<?php echo $sus_pcode; ?>" />
                                                <input type="hidden" name="price_<?php echo $sus_row_count; ?>" id="price_<?php echo $sus_row_count; ?>" value="<?php echo $sus_price; ?>" />	
                                                <input type="hidden" name="qty_<?php echo $sus_row_count; ?>" id="qty_<?php echo $sus_row_count; ?>" value="<?php echo $sus_qty; ?>" />				
                                                <?php
                                                ++$sus_row_count;
                                            }

                                            if (count($susItemData) > 0) {
                                                //$sus_row_count 	= $sus_row_count - 1;
                                            }
                                        }
                                    }
                                    ?>

                                    <div id="log"></div>
                                </div>

                                <!-- <div style="width: 100%; height: 110px; background-color: #373942;"> -->
                                <div class="row">
                                    <div class="col-md-12" style="background-color: #373942;">

                                        <div class="row" style="margin: 0px; font-weight: bold; color: #FFF; padding-top: 5px; font-size: 13px;">
                                            <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                                <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                                                    <tr>
                                                        <td width="25%" height="25px" style="font-size: 12px;"><?php echo $lang_total_items; ?> :</td>
                                                        <td width="25%" height="25px" align="right">
                                                            <div id="total_item_qty"><?php echo $total_items; ?></div>
                                                        </td>
                                                        <td width="25%" height="25px" align="right">
                                                            <?php echo $lang_total; ?> :
                                                        </td>
                                                        <td width="25%" height="25px" align="right">
                                                            <div id="total_price"><?php echo $subTotal; ?></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!--
                                                    <div class="col-md-4">Total Items : </div>
                                                    <div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
                                                    <div id="total_item_qty"><?php echo $total_items; ?></div>
                                                    </div>
                                                    <div class="col-md-3" style="text-align: right;">Total : </div>
                                                    <div class="col-md-3" style="text-align: right;">
                                                    <div id="total_price"><?php echo $subTotal; ?></div>
                                                    </div>
                                            -->
                                        </div>

                                        <div class="row" style="margin: 0px; font-weight: bold; color: #FFF; font-size: 13px;">
                                            <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                                <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                                                    <tr>
                                                        <td width="30%" height="25px">
                                                            <?php echo $lang_dis_amt; ?>/% : 
                                                        </td>
                                                        <td width="20%" height="25px">
                                                            <input type="text" name="dis_amt" id="dis_amt" value="<?php echo $dis_amt; ?>" style="width: 100%; color: #000; font-size: 13px; font-weight: normal; border: 0px; padding-left: 5px; font-family: Arial, Helvetica, sans-serif; padding-top: 5px; padding-bottom: 5px;" onkeyup="calculateDiscount(this.value)" />
                                                        </td>
                                                        <td width="30%" height="25px" align="right">
                                                            <?php echo $lang_tax; ?> (<?php echo $tax; ?>%) :
                                                        </td>
                                                        <td width="20%" height="25px" align="right">
                                                            <div id="display_tax_amt"><?php echo $tax_amt; ?></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!--
                                                    <div class="col-md-4">Disc. Amt. / % : </div>
                                                    <div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
                                                    <input type="text" name="dis_amt" id="dis_amt" value="<?php echo $dis_amt; ?>" style="width: 100%; color: #000; font-size: 13px; font-weight: normal; border: 0px; padding-left: 5px; font-family: Arial, Helvetica, sans-serif; padding-top: 5px; padding-bottom: 5px;" onkeyup="calculateDiscount(this.value)" />
                                                    </div>
                                                    <div class="col-md-3" style="text-align: right;">Tax (<?php echo $tax; ?>%) : </div>
                                                    <div class="col-md-3" style="text-align: right;">
                                                    <div id="display_tax_amt"><?php echo $tax_amt; ?></div>
                                                    </div>
                                            -->
                                        </div>

                                        <div class="row" style="margin: 0px; font-weight: bold; color: #FFF; padding-top: 7px; padding-bottom: 7px; font-size: 13px; border-top: 1px solid #dddddd;">
                                            <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                                <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                                                    <tr>
                                                        <td width="50%" height="30px"><?php echo $lang_total_payable; ?> :</td>
                                                        <td width="50%" height="30px" align="right">
                                                            <div id="total_payable"><?php echo $grandTotal; ?></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!--
                                                    <div class="col-md-6">Total Payable : </div>
                                                    <div class="col-md-6" style="text-align: right;">
                                                    <div id="total_payable"><?php echo $grandTotal; ?></div>
                                                    </div>
                                            -->
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-4" style="margin-top: 8px;">
                                                <div style="background-color: #c72a25; color: #FFF; text-align: center; font-weight: bold; border-radius: 4px; cursor: pointer; padding-top: 10px; padding-bottom: 10px; width: 100%;" onclick="cancelSelected()">
                                                    <?php echo $lang_cancel; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 8px;">
                                                <a href="#holdmodel" data-toggle="modal" style="text-decoration: none;">
                                                    <div style="background-color: #834f50; color: #FFF; text-align: center; font-weight: bold; border-radius: 4px; padding-top: 10px; padding-bottom: 10px; width: 100%;">
                                                        <?php echo $lang_hold; ?>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 8px;">
                                                <a class="btn btn-primary" href="#timepicker4Modal" data-toggle="modal" style="background-color: #3fb618; float: right; font-weight: bold; color: #FFF; border: 0px; padding-top: 10px; padding-bottom: 10px; width: 100%;">
                                                    <?php echo $lang_payment; ?>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div><!-- Items to pay List // END -->
                            <div class="col-md-8">

                                <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/carousel/slick/slick.css">
                                <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/carousel/slick/slick-theme.css">
                                <style type="text/css">
                                    .slider {
                                        width: 50%;
                                    }

                                    .slick-slide {
                                        margin: 0px 3px;
                                    }

                                    .slick-slide img {
                                        width: 100%;
                                    }

                                    .slick-prev:before,
                                    .slick-next:before {
                                        color: black;
                                    }
                                </style>



                                <div class="panel panel-default" style="border: 1px solid #ddd;">
                                    <div class="panel-body tabs">

                                        <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                            <div class="col-md-12" style="padding-left: 15px; padding-right: 15px; padding-top: 10px;">
                                                <input type="text" class="form-control" style="border: 1px solid #3a3a3a; color: #010101;" placeholder="<?php echo $lang_search_product_by_namecode; ?>" id="searchProd"  />
                                            </div>
                                            <!--
                                                    <div class="col-md-3" style="padding-top: 10px;">
                                                    <a class="btn btn-primary" href="#addProductPopUp" data-toggle="modal" style="border: 0px; width: 100%; padding: 3px 12px; background-color: #b205c2;">
                                                    <i class="icono-plus"></i> Add Product
                                                    </a>
                                                    </div>
                                            -->
                                        </div>



                                        <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                            <div class="col-md-12" style="border-bottom: 1px solid #ddd; padding-top: 11px;">
                                                <div class="regular slider" style="width: 100%">

                                                    <!--
                                                            <div data-toggle="tab" href="#pilltabAll" style="cursor: pointer;">
                                                            <img src="http://placehold.it/120x60/373942/FFFFFF?text=All" />
                                                            </div>
                                                    -->
                                                    <div data-toggle="tab" href="#pilltabAll" style="cursor: pointer; text-align: center; background-color: #373942; color: #FFF; width: 100px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;">
                                                        All
                                                    </div>

                                                    <?php
                                                    $catData = $this->Constant_model->getDataOneColumn('category', 'status', '1');

                                                    for ($ct = 0; $ct < count($catData); ++$ct) {
                                                        $cat_id = $catData[$ct]->id;
                                                        $cat_name = $catData[$ct]->name;
                                                        ?>
                                                        <!--
                                                                <div data-toggle="tab" href="#pilltab<?php echo $cat_id; ?>" style="cursor: pointer;">
                                                                <img src="http://placehold.it/120x60/373942/FFFFFF?text=<?php echo $cat_name; ?>" />
                                                                </div>
                                                        -->

                                                        <div data-toggle="tab" href="#pilltab<?php echo $cat_id; ?>" style="cursor: pointer; text-align: center; background-color: #373942; color: #FFF; width: 100px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;">
                                                            <?php echo $cat_name; ?>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>

                                                </div>
                                                <script src="<?= base_url() ?>assets/js/jquery-2.2.0.min.js" type="text/javascript"></script>
                                                <script src="<?= base_url() ?>assets/carousel/slick/slick.js" type="text/javascript" charset="utf-8"></script>
                                                <script type="text/javascript">
                                                    $(document).on('ready', function () {
                                                        $(".regular").slick({
                                                            dots: true,
                                                            infinite: true,
                                                            slidesToShow: 7,
                                                            slidesToScroll: 3
                                                        });
                                                        $(".center").slick({
                                                            dots: true,
                                                            infinite: true,
                                                            centerMode: true,
                                                            slidesToShow: 3,
                                                            slidesToScroll: 3
                                                        });
                                                        $(".variable").slick({
                                                            dots: true,
                                                            infinite: true,
                                                            variableWidth: true
                                                        });
                                                    });
                                                </script>								
                                                <!--
                                                        <ul class="nav nav-pills" style="margin-top: 0px;">
                                                <?php
                                                $catData = $this->Constant_model->getDataOneColumn('category', 'status', '1');

                                                for ($ct = 0; $ct < count($catData); ++$ct) {
                                                    $cat_id = $catData[$ct]->id;
                                                    $cat_name = $catData[$ct]->name;
                                                    ?>
                                                                                                                        <li <?php if ($ct == 0) {
                                                        ?> class="active" <?php }
                                                    ?>><a href="#pilltab<?php echo $cat_id; ?>" data-toggle="tab">
                                                    <?php echo $cat_name; ?></a>
                                                                                                                        </li>	
                                                    <?php
                                                    unset($cat_id);
                                                    unset($cat_name);
                                                }
                                                ?>
                                                        </ul>
                                                -->
                                            </div>
                                        </div>

                                        <div class="tab-content" style="overflow: scroll; height: 436px;" id="allProd">

                                            <?php
                                            $pp = 0;
                                            ?>	
                                            <div class="tab-pane fade in active" id="pilltabAll">
                                                <?php
                                                $allProdData = $this->Constant_model->getPOSProducts('products', 'status', '1');



                                                /* echo "<pre>";
                                                  print_r($allProdData);
                                                  echo "query : ".$allProdData['qty'];
                                                  echo "</pre>"; */

                                                for ($ap = 0; $ap < count($allProdData); ++$ap) {


                                                    if ($allProdData[$ap]->qty > 0) {


                                                        $pcode = $allProdData[$ap]->code;
                                                        $name = $allProdData[$ap]->name;
                                                        $color = $allProdData[$ap]->color;
                                                        $image = $allProdData[$ap]->thumbnail;
                                                        ?>
                                                        <button type="button" id="txtMessage_<?php echo $pp; ?>" value="<?php echo $pcode; ?>" 
                                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; 
                                                                <?php
                                                                if (!empty($color)) {
                                                                    echo 'background-color: #' . $color . ';';
                                                                } else {
                                                                    echo 'background-color: #005b8a;';
                                                                }
                                                                ?>					
                                                                border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">
                                                                <?php
                                                                if (($display_prod == '3') || ($display_prod == '2')) {
                                                                    ?>	
                                                                    <?php
                                                                    if ($image == 'no_image.jpg') {
                                                                        ?>
                                                                    <img src="<?= base_url() ?>assets/upload/products/xsmall/no_image.jpg" height="50px" style="padding-bottom: 5px;" /><br />
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img src="<?= base_url() ?>assets/upload/products/xsmall/<?php echo $pcode; ?>/<?php echo $image; ?>" height="50px" style="padding-bottom: 5px;" /><br />
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            if (($display_prod == '1') || ($display_prod == '3')) {
                                                                ?>
                                                                <span id="proname"><?php echo $name; ?> <br/>[<?php echo $pcode; ?>]</span>
                                                            <?php }
                                                            ?>
                                                        </button>
                                                        <?php
                                                        ++$pp;
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            // $pp = 0;

                                            $catData = $this->Constant_model->getDataOneColumn('category', 'status', '1');
                                            for ($ca = 0; $ca < count($catData); ++$ca) {
                                                $category_id = $catData[$ca]->id;
                                                ?>
                                                <div class="tab-pane fade in <?php if ($ca == 0) {
                                                    ?><?php }
                                                ?>" id="pilltab<?php echo $category_id; ?>">
                                                     <?php
                                                     $prodData = $this->Constant_model->getDataTwoColumn('products', 'status', '1', 'category', $category_id);
                                                     for ($d = 0; $d < count($prodData); ++$d) {
                                                         if ($prodData[$d]->qty > 0) {
                                                             $pcode = $prodData[$d]->code;
                                                             $name = $prodData[$d]->name;
                                                             $color = $prodData[$d]->color;
                                                             $image = $prodData[$d]->thumbnail;
                                                             ?>
                                                            <button type="button" id="txtMessage_<?php echo $pp; ?>" value="<?php echo $pcode; ?>" 
                                                                    style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; 					
                                                                    <?php
                                                                    if (!empty($color)) {
                                                                        echo 'background-color: #' . $color . ';';
                                                                    } else {
                                                                        echo 'background-color: #005b8a;';
                                                                    }
                                                                    ?> border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">
                                                                    <?php
                                                                    if (($display_prod == '3') || ($display_prod == '2')) {
                                                                        ?>	
                                                                        <?php
                                                                        if ($image == 'no_image.jpg') {
                                                                            ?>
                                                                        <img src="<?= base_url() ?>assets/upload/products/xsmall/no_image.jpg" height="50px" style="padding-bottom: 5px;" /><br />
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <img src="<?= base_url() ?>assets/upload/products/xsmall/<?php echo $pcode; ?>/<?php echo $image; ?>" height="50px" style="padding-bottom: 5px;" /><br />
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <?php
                                                                if (($display_prod == '1') || ($display_prod == '3')) {
                                                                    ?>
                                                                    <span id="proname"><?php echo $name; ?> <br/>[<?php echo $pcode; ?>]</span>
                                                                <?php }
                                                                ?>
                                                            </button>
                                                            <?php
                                                            ++$pp;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                                unset($category_id);
                                            }
                                            unset($catData);

//$pp += 100;
                                            ?>
                                        </div>



                                    </div>
                                </div><!--/.panel-->

                            </div><!-- Product List // END -->
                        </div>


                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->
            </div><!-- Col md 12 // END -->
        </div><!-- Row // END -->




        <script type="text/javascript">
            $(document).ready(function () {
                $('#holdmodel').on('shown.bs.modal', function () {
                    $("#hold_ref").attr("required", true);
                    $("#hold_ref").focus();

                    var addNewCustomer = $.ajax({
                        url: '<?= base_url() ?>pos/loadCustomer',
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
                            //var data_display = data.display;
                            //document.getElementById("loadHoldCustomer").innerHTML = data_display;

                            var jsonData = jQuery.parseJSON(JSON.stringify(data));

                            var select, i, option;

                            document.getElementById("openBillLoadCust").options.length = 0;

                            select = document.getElementById('openBillLoadCust');

                            for (var i = 0; i < jsonData.categories.length; i++) {
                                var counter = jsonData.categories[i];

                                var cust_id = counter.cust_id;
                                var cust_name = counter.cust_name;

                                option = document.createElement('option');
                                option.value = cust_id;
                                option.text = cust_name;
                                select.add(option);
                            }

                        }
                    });
                })

                $('#holdmodel').on('hidden.bs.modal', function () {
                    document.getElementById("hold_ref").required = false;
                })



                $('#timepicker4Modal').on('shown.bs.modal', function () {

                    var cartitem = document.getElementById("final_total_qty").value;

                    if (cartitem == 0) {
                        $('#timepicker4Modal').modal('hide');
                        $('#errornoitem').modal('show');
                    } else {

                        $("#paid").attr("required", true);
                        $("#paid").focus();
                        //document.getElementById("hold_bill_submit").style.display = "none";

                        var addNewCustomer = $.ajax({
                            url: '<?= base_url() ?>pos/loadCustomer',
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
                                //var data_display = data.display;
                                //var category 	= data.categories;

                                var jsonData = jQuery.parseJSON(JSON.stringify(data));

                                var select, i, option;

                                document.getElementById("paymentLoadCust").options.length = 0;

                                select = document.getElementById('paymentLoadCust');

                                for (var i = 0; i < jsonData.categories.length; i++) {
                                    var counter = jsonData.categories[i];
                                    //console.log(counter.cust_id);

                                    var cust_id = counter.cust_id;
                                    var cust_name = counter.cust_name;

                                    option = document.createElement('option');
                                    option.value = cust_id;
                                    option.text = cust_name;
                                    select.add(option);
                                }



                                //document.getElementById("loadPaymentCustomer").innerHTML = data_display;
                            }
                        });

                    }

                })
                $('#timepicker4Modal').on('hidden.bs.modal', function () {
                    document.getElementById("paid").required = false;
                    //document.getElementById("hold_bill_submit").style.display = "block";
                })

                $('html').bind('keypress', function (e)
                {
                    if (e.keyCode == 13)
                    {
                        return false;
                    }
                });


                $('#addCustomerPopUp').on('shown.bs.modal', function () {
                    //$("#pop_cust_fn").attr("required", true);
                    $("#pop_cust_fn").focus();
                })

                $('#addCustomerPopUp').on('hidden.bs.modal', function () {
                    //document.getElementById("pop_cust_fn").required = false;
                })


                $('#addProductPopUp').on('shown.bs.modal', function () {
                    $("#pop_pcode").attr("required", true);
                    $("#pop_pcode").focus();

                    $("#pop_pname").attr("required", true);
                    $("#pop_pcate").attr("required", true);
                    $("#pop_price").attr("required", true);
                })

                $('#addProductPopUp').on('hidden.bs.modal', function () {
                    document.getElementById("pop_pcode").required = false;
                    document.getElementById("pop_pname").required = false;
                    document.getElementById("pop_pcate").required = false;
                    document.getElementById("pop_price").required = false;
                })


                $('#totalSales').on('shown.bs.modal', function () {

                    var temp_outlet = document.getElementById("outlet").value;

                    var loadTodaySales = $.ajax({
                        url: '<?= base_url() ?>pos/loadTodaySales?outlet_id=' + temp_outlet,
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
                            var todayDate = data.todaydate;
                            var totalCash = data.totalCash;
                            var totalMaster = data.totalMaster;
                            var totalNett = data.totalNett;
                            var totalVisa = data.totalVisa;

                            var totalCheque = data.totalCheque;
                            var totalAmt = data.totalAmt;


                            document.getElementById("todayDateWrp").innerHTML = todayDate;
                            document.getElementById("todayCash").innerHTML = totalCash.toFixed(2);
                            document.getElementById("todayMaster").innerHTML = totalMaster.toFixed(2);
                            document.getElementById("todayNett").innerHTML = totalNett.toFixed(2);
                            document.getElementById("todayVisa").innerHTML = totalVisa.toFixed(2);

                            document.getElementById("todayCheque").innerHTML = totalCheque.toFixed(2);
                            document.getElementById("todayTotal").innerHTML = totalAmt.toFixed(2);

                        }
                    });

                });


            });

            function searchOpenedBill(ele) {

                if (ele.length == 0) {

                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('searchOpenedResult').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "<?= base_url() ?>pos/getopenedBill?q=", true);
                    xmlhttp.send();

                    //document.getElementById('searchOpenedResult').innerHTML=xmlhttp.responseText;;
                    //return;
                }
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('searchOpenedResult').innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "<?= base_url() ?>pos/getopenedBill?q=" + ele, true);
                xmlhttp.send();
            }

        </script>	


        <div id="addProductPopUp" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;">Add New Product</h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b>Product Code</b></div>
                            <div class="col-md-6">
                                <input type="text" name="pop_pcode" id="pop_pcode" class="form-control" />
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b>Product Name</b></div>
                            <div class="col-md-6">
                                <input type="text" name="pop_pname" id="pop_pname" class="form-control" />
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b>Product Category</b></div>
                            <div class="col-md-6">
                                <select name="pop_pcate" id="pop_pcate" class="form-control">
                                    <option value="">Select Product Category</option>
                                    <?php
                                    $pCatData = $this->Constant_model->getDataOneColumnSortColumn('category', 'status', '1', 'name', 'ASC');
                                    for ($pc = 0; $pc < count($pCatData); ++$pc) {
                                        $pCat_id = $pCatData[$pc]->id;
                                        $pCat_name = $pCatData[$pc]->name;
                                        ?>
                                        <option value="<?php echo $pCat_id; ?>"><?php echo $pCat_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b>Selling Price</b></div>
                            <div class="col-md-6">
                                <input type="text" name="pop_price" id="pop_price" class="form-control" />
                            </div>
                        </div>

                        <div class="modal-footer" style="margin-top: 10px;">
                            <input type="submit" name="add_prod_submit" id="add_prod_submit" value="Add New Product" class="btn btn-primary" style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right;" />

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="outofstockwrp" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--
                            <div class="modal-header" style="background-color: #373942;">
                            <h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
                            </div>
                    -->
                    <div class="modal-body" style="overflow: visible; background-color: #FFF; border-radius: 12px;">

                        <div class="row">
                            <div class="col-md-12" style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #c72a25;">
                                <?php echo $lang_out_of_stock; ?>
                                <br />
                                <?php echo $lang_please_update_inven; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="openreachmini" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--
                            <div class="modal-header" style="background-color: #373942;">
                            <h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
                            </div>
                    -->
                    <div class="modal-body" style="overflow: visible; background-color: #FFF; border-radius: 12px;">

                        <div class="row">
                            <div class="col-md-12" style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #c72a25;">
                                Can not reduce quantity to less than 1. 
                                <br />
                                If you do not want, please remove by clicking cross sign!
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="errornoitem" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--
                            <div class="modal-header" style="background-color: #373942;">
                            <h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
                            </div>
                    -->
                    <div class="modal-body" style="overflow: visible; background-color: #FFF; border-radius: 12px;">

                        <div class="row">
                            <div class="col-md-12" style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #090;">
                                <?php echo $lang_please_add_product; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="successaddedNewCustomer" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;"><?php echo $lang_add_new_customer; ?></h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                        <div class="row">
                            <div class="col-md-12" style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #090;">
                                <?php echo $lang_success_add_cust; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="addCustomerPopUp" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;"><?php echo $lang_add_new_customer; ?></h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_customer_name; ?></b></div>
                            <div class="col-md-6">
                                <input type="text" name="pop_cust_fn" id="pop_cust_fn" class="form-control" />
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_customer_email; ?></b></div>
                            <div class="col-md-6">
                                <input type="text" name="pop_cust_em" id="pop_cust_em" class="form-control" />
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_customer_mobile; ?></b></div>
                            <div class="col-md-6">
                                <input type="text" name="pop_cust_mb" id="pop_cust_mb" class="form-control" />
                            </div>
                        </div>

                        <div class="modal-footer" style="margin-top: 10px;">
                            <div name="pop_add_cust_submit" id="pop_add_cust_submit" value="Add Customer" class="btn btn-primary" style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right;"><?php echo $lang_add_customer; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="totalSales" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;">
                            <?php echo $lang_today_sales; ?> : <span id="todayDateWrp">0000-00-00</span> 
                            <span onclick="closetotalSalesModel()" class="close-button">X</span>
                        </h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                        <div class="row" style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #ededed; font-size: 15px;">
                            <div class="col-md-4" style="padding-top: 10px;">Cash</div>
                            <div class="col-md-8" style="padding-top: 10px;">
                                : <span id="todayCash">0.00</span>
                            </div>
                        </div>

                        <div class="row" style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #fff; font-size: 15px;">
                            <div class="col-md-4" style="padding-top: 10px;">Card Payment </div>
                            <div class="col-md-8" style="padding-top: 10px;">
                                : <span id="todayMaster">0.00</span>
                            </div>
                        </div>


                        <div class="row" style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #fff; font-size: 15px;">
                            <div class="col-md-4" style="padding-top: 10px;">Wire Transfer</div>
                            <div class="col-md-8" style="padding-top: 10px;">
                                : <span id="todayNett">0.00</span>
                            </div>
                        </div>

                        <div class="row" style="display: none; margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #ededed; font-size: 15px;">
                            <div class="col-md-4" style="padding-top: 10px;">VISA </div>
                            <div class="col-md-8" style="padding-top: 10px;">
                                : <span id="todayVisa">0.00</span>
                            </div>
                        </div>



                        <div class="row" style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #ededed; font-size: 15px;">
                            <div class="col-md-4" style="padding-top: 10px;">Cheque Payment</div>
                            <div class="col-md-8" style="padding-top: 10px;">
                                : <span id="todayCheque">0.00</span>
                            </div>
                        </div>

                        <div class="row" style="margin-left: 10px; margin-right: 10px; padding-top: 7px; padding-bottom: 7px; background-color: #005b8a; letter-spacing: 0.5px; font-size: 16px;">
                            <div class="col-md-4" style="padding-left: 15px; padding-right: 15px; font-weight: bold; color: #FFF;">
                                <?php echo $lang_total; ?>
                            </div>
                            <div class="col-md-8" style="padding-left: 15px; padding-right: 15px; font-weight: bold; color: #FFF;">
                                : <span id="todayTotal">0.00</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div id="openedBill" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;">
                            <?php echo $lang_opened_bill; ?>
                            <span onclick="closeopenedBillModel()" class="close-button">X</span>
                        </h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                        <div class="row" style="padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                            <div class="col-md-4" style="padding-top: 10px;"><b><?php echo $lang_search_opened_bills; ?> : </b></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" style="border: 1px solid #373942;" placeholder="<?php echo $lang_ref_number; ?>" value="" onKeyUp="searchOpenedBill(this.value)" />
                            </div>
                        </div>

                        <div class="row" style="padding-left: 10px; padding-right: 10px; overflow: scroll; height: 400px; margin-top: 10px;" id="searchOpenedResult">
                            <center>
                                <?php
                                if ($user_role == '1') {
                                    $openedBillData = $this->Constant_model->getDataOneColumnSortColumn('suspend', 'status', '0', 'created_datetime', 'DESC');
                                } else {
                                    $openedBillData = $this->Constant_model->getDataTwoColumnSortColumn('suspend', 'outlet_id', "$user_outlet", 'status', '0', 'created_datetime', 'DESC');
                                }

                                for ($op = 0; $op < count($openedBillData); ++$op) {
                                    $openedBill_id = $openedBillData[$op]->id;
                                    $openedBill_cust_id = $openedBillData[$op]->customer_id;
                                    $openedBill_cust_fn = $openedBillData[$op]->fullname;
                                    $openedBill_ref = $openedBillData[$op]->ref_number;
                                    $openedBill_grand = $openedBillData[$op]->grandtotal;
                                    $openedBill_item_qty = $openedBillData[$op]->total_items;
                                    $openedBill_date = date("$pos_dateformat H:i A", strtotime($openedBillData[$op]->created_datetime));
                                    ?>
                                    <a href="<?= base_url() ?>pos?suspend_id=<?php echo $openedBill_id; ?>" style="text-decoration: none;">
                                        <div class="col-md-5" style="background-color: #834f50; color: #FFF; margin: 7px 20px; padding-top: 10px; padding-bottom: 10px;">
                                            <b><?php echo $lang_ref_number; ?></b> : <?php echo $openedBill_ref; ?><br />
                                            <b><?php echo $lang_customer_name; ?> </b> : <?php echo $openedBill_cust_fn; ?><br />
                                            <b><?php echo $lang_date; ?> </b> : <?php echo $openedBill_date; ?><br />
                                            <b><?php echo $lang_qty; ?></b> : <?php echo $openedBill_item_qty; ?><br /> 
                                            <b><?php echo $lang_total; ?> </b> : <?php echo $openedBill_grand; ?>
                                        </div>
                                    </a>
                                    <?php
                                }
                                ?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="holdmodel" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;"><?php echo $lang_save_to_opened_bill; ?></h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                        <div class="row">
                            <div class="col-md-6"><b><?php echo $lang_customers; ?></b></div>
                            <div class="col-md-6">

                                <select name="customer" id="openBillLoadCust" class="form-control" style="border: 1px solid #3a3a3a; color: #010101;">

                                </select>

                                <!-- <div id="loadHoldCustomer"></div> -->
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_hold_ref_number; ?></b></div>
                            <div class="col-md-6">
                                <input type="text" name="hold_ref" id="hold_ref" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 10px;">
                            <input type="submit" name="hold_bill_submit" id="hold_bill_submit" value="<?php echo $lang_submit; ?>" class="btn btn-primary" style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="timepicker4Modal" class="modal fade"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #373942;">
                        <h3 class="modal-title" style="color: #FFF;"><?php echo $lang_payment; ?></h3>
                    </div>
                    <div class="modal-body" style="overflow: visible; background-color: #FFF;">
                        <div class="row">
                            <div class="col-md-6">
                                <b><?php echo $lang_customers; ?></b>
                            </div>
                            <div class="col-md-6">

                                <script type="text/javascript" src="<?= base_url() ?>assets/js/search/jquery.searchabledropdown.js"></script>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        jQuery.browser = {};
                                        (function () {
                                            jQuery.browser.msie = false;
                                            jQuery.browser.version = 0;
                                            if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                                                jQuery.browser.msie = true;
                                                jQuery.browser.version = RegExp.$1;
                                            }
                                        })();

                                        $("#paymentLoadCust").searchable();
                                        $("#openBillLoadCust").searchable();
                                    });
                                </script>

                                <select name="customer" id="paymentLoadCust" onchange="changeCustomerType(this.value)" class="form-control payment-load-customer" style="border: 1px solid #3a3a3a; color: #010101; ">

                                </select>
                                <!-- <div id="loadPaymentCustomer"></div> -->

                            </div>
                        </div>

                        <div class="row" id="final_payable_amt_wrp" style="padding-top: 10px; padding-bottom: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_total_payable_amt; ?></b></div>
                            <div class="col-md-6">
                                <span id="final_payable_amt" style="background-color: #FFFF99; padding: 5px 10px;"><?php echo $grandTotal; ?></span>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_total_purchase_items; ?></b></div>
                            <div class="col-md-6">
                                <span id="final_purchased_item" style="background-color: #FFFF99; padding: 5px 10px;"><?php echo $total_items; ?></span>
                            </div>
                        </div>

                        <script type="text/javascript">
                            function closetotalSalesModel() {
                                $('#totalSales').modal('hide');
                            }
                            function closeopenedBillModel() {
                                $('#openedBill').modal('hide');
                            }

                            function changeCustomerType(ele) {
                                document.getElementById("paid_by_wrp").style.display = "block";
                                document.getElementById("submit_btn").style.display = "none";
                                document.getElementById("final_payable_amt_wrp").style.display = "block";
                                if (ele == "3" || ele == "4") {			// Complimentory, Expire/Damaged
                                    document.getElementById("final_payable_amt_wrp").style.display = "none";
                                    document.getElementById("paid").readOnly = false;
                                    document.getElementById("paid").value = 0;
                                    document.getElementById("return_change").innerHTML = 0;
                                    document.getElementById("card_numb").value = "";
                                    document.getElementById("cheque").value = "";

                                    document.getElementById("paid_by_wrp").style.display = "none";
                                    document.getElementById("submit_btn").style.display = "block";

                                    document.getElementById("addi_card_numb_wrp").style.display = "block";
                                    document.getElementById("addi_card_numb").required = false;

                                    document.getElementById("card_wrp").style.display = "none";
                                    document.getElementById("card_numb").required = false;

                                    document.getElementById("cheque_wrp").style.display = "none";
                                    document.getElementById("cheque").required = false;
                                    //document.getElementById("cheque").focus();

                                    document.getElementById("paid_wrp").style.display = "none";
                                    document.getElementById("return_wrp").style.display = "none";
                                } else {
                                    var e = document.getElementById("paid_by");
                                    var paidbyValue = e.options[e.selectedIndex].value;
                                    checkChequePayment(paidbyValue);
                                }

                            }

                            function checkChequePayment(ele) {
                                if (ele == "5") {			// Cheque;
                                    document.getElementById("paid").readOnly = false;
                                    document.getElementById("paid").value = 0;
                                    document.getElementById("return_change").innerHTML = 0;
                                    document.getElementById("card_numb").value = "";
                                    document.getElementById("cheque").value = "";



                                    document.getElementById("submit_btn").style.display = "none";

                                    document.getElementById("card_wrp").style.display = "none";
                                    document.getElementById("card_numb").required = false;

                                    document.getElementById("cheque_wrp").style.display = "block";
                                    document.getElementById("cheque").required = true;

                                    document.getElementById("paid_wrp").style.display = "block";
                                    document.getElementById("return_wrp").style.display = "block";


                                    document.getElementById("cheque").focus();

                                } else if ((ele == "3") || (ele == "4")) {		// VISA and Master;

                                    document.getElementById("paid").readOnly = false;
                                    document.getElementById("paid").value = 0;
                                    document.getElementById("return_change").innerHTML = 0;
                                    document.getElementById("card_numb").value = "";
                                    document.getElementById("cheque").value = "";
                                    document.getElementById("addi_card_numb").value = "";

                                    document.getElementById("addi_card_numb_wrp").style.display = "block";
                                    document.getElementById("addi_card_numb").required = true;
                                    document.getElementById("addi_card_numb").focus();

                                    document.getElementById("submit_btn").style.display = "none";

                                    document.getElementById("card_wrp").style.display = "none";
                                    document.getElementById("card_numb").required = false;

                                    document.getElementById("cheque_wrp").style.display = "none";
                                    document.getElementById("cheque").required = false;


                                    document.getElementById("paid_wrp").style.display = "block";
                                    document.getElementById("return_wrp").style.display = "block";

                                } else if (ele == "7") {		// Gift Card;
                                    document.getElementById("paid").value = 0;
                                    document.getElementById("return_change").innerHTML = 0;
                                    document.getElementById("card_numb").value = "";
                                    document.getElementById("cheque").value = "";
                                    document.getElementById("addi_card_numb").value = "";

                                    document.getElementById("submit_btn").style.display = "none";

                                    document.getElementById("cheque_wrp").style.display = "none";
                                    document.getElementById("cheque").required = false;

                                    document.getElementById("addi_card_numb_wrp").style.display = "none";
                                    document.getElementById("addi_card_numb").required = false;

                                    document.getElementById("card_wrp").style.display = "block";
                                    document.getElementById("card_numb").required = true;
                                    document.getElementById("card_numb").focus();


                                    document.getElementById("paid_wrp").style.display = "block";
                                    document.getElementById("return_wrp").style.display = "block";

                                } else if (ele == "6") {			// Debit;
                                    document.getElementById("paid").readOnly = false;
                                    document.getElementById("paid").value = 0;
                                    document.getElementById("return_change").innerHTML = 0;
                                    document.getElementById("card_numb").value = "";
                                    document.getElementById("cheque").value = "";
                                    document.getElementById("addi_card_numb").value = "";

                                    document.getElementById("submit_btn").style.display = "block";

                                    document.getElementById("cheque_wrp").style.display = "none";
                                    document.getElementById("cheque").required = false;

                                    document.getElementById("addi_card_numb_wrp").style.display = "block";
                                    document.getElementById("addi_card_numb").required = false;

                                    document.getElementById("card_wrp").style.display = "none";
                                    document.getElementById("card_numb").required = false;


                                    document.getElementById("paid_wrp").style.display = "block";
                                    document.getElementById("return_wrp").style.display = "block";


                                } else {

                                    document.getElementById("paid").readOnly = false;
                                    document.getElementById("paid").value = 0;
                                    document.getElementById("return_change").innerHTML = 0;
                                    document.getElementById("card_numb").value = "";
                                    document.getElementById("cheque").value = "";
                                    document.getElementById("addi_card_numb").value = "";

                                    document.getElementById("submit_btn").style.display = "none";

                                    document.getElementById("cheque_wrp").style.display = "none";
                                    document.getElementById("cheque").required = false;

                                    document.getElementById("addi_card_numb_wrp").style.display = "none";
                                    document.getElementById("addi_card_numb").required = false;

                                    document.getElementById("card_wrp").style.display = "none";
                                    document.getElementById("card_numb").required = false;


                                    document.getElementById("paid_wrp").style.display = "block";
                                    document.getElementById("return_wrp").style.display = "block";
                                }

                                if (document.getElementById('advance').checked) {
                                    document.getElementById("submit_btn").style.display = "block";

                                    document.getElementById("addi_card_numb_wrp").style.display = "block";
                                    //document.getElementById("addi_card_numb").required 				= true;

                                }
                            }




                        </script>	
                        <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                            <div class="col-md-6"><b>Advance Order :</b></div>
                            <div class="col-md-6">
                                <input type="checkbox" name="advance" id="advance" style="height: 35px; width: 35px;">
                            </div>
                        </div>

                        <div class="row" id="paid_by_wrp" style="padding-top: 10px; padding-bottom: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_paid_by; ?> :</b></div>
                            <div class="col-md-6">
                                <select name="paid_by" id="paid_by" class="form-control" style="border: 1px solid #3a3a3a; color: #010101;" onchange="checkChequePayment(this.value)">
                                    <?php
                                    $payMethodData = $this->Constant_model->getDataOneColumn('payment_method', 'status', '1');
                                    for ($p = 0; $p < count($payMethodData); ++$p) {
                                        $payMethod_id = $payMethodData[$p]->id;
                                        $payMethod_name = $payMethodData[$p]->name;
                                        ?>
                                        <option value="<?php echo $payMethod_id; ?>"><?php echo $payMethod_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="cheque_wrp" style="padding-top: 10px; padding-bottom: 10px; display: none;">
                            <div class="col-md-6"><b><?php echo $lang_cheque_number; ?> :</b></div>
                            <div class="col-md-6">
                                <input type="text" name="cheque" class="form-control" id="cheque" placeholder="<?php echo $lang_cheque_number; ?>" style="border: 1px solid #3a3a3a; color: #010101;" />
                            </div>
                        </div>

                        <script src="<?= base_url() ?>assets/js/input-mask/jquery.inputmask.js" type="text/javascript"></script>
                        <script src="<?= base_url() ?>assets/js/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
                        <script type="text/javascript">
                                    $(document).ready(function () {

                                        $('#advance').change(function () {
                                            if (this.checked) {
                                                checkChequePayment(6);
                                            } else {
                                                var e = document.getElementById("paid_by");
                                                var paidbyValue = e.options[e.selectedIndex].value;
                                                checkChequePayment(paidbyValue);
                                            }
                                        });

                                        $('#card_numb').inputmask("9999 9999 9999 9999");

                                        $("#card_numb").on("keyup", function (event) {

                                            var card_numb = document.getElementById("card_numb").value;

                                            //alert(card_numb.length);

                                            if (card_numb.length == 0) {
                                                document.getElementById("submit_btn").style.display = "none";
                                            } else if (card_numb.indexOf('_') == -1) {

                                                var addNewCustomer = $.ajax({
                                                    url: '<?= base_url() ?>pos/loadGiftCardValue?card_numb=' + card_numb,
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
                                                        var card_value = data.value;
                                                        var card_status = data.errorMsg;

                                                        if (card_status == "failure") {

                                                            document.getElementById("paid").value = 0;
                                                            document.getElementById("return_change").innerHTML = 0;

                                                            document.getElementById("submit_btn").style.display = "none";
                                                            alert("Card Do not Exist!");
                                                            document.getElementById("card_numb").value = "";

                                                        } else if (card_status == "used") {

                                                            document.getElementById("paid").value = 0;
                                                            document.getElementById("return_change").innerHTML = 0;

                                                            document.getElementById("submit_btn").style.display = "none";
                                                            alert("Card used!");
                                                            document.getElementById("card_numb").value = "";

                                                        } else if (card_status == "expired") {

                                                            document.getElementById("paid").value = 0;
                                                            document.getElementById("return_change").innerHTML = 0;

                                                            document.getElementById("submit_btn").style.display = "none";
                                                            alert("Card Expired!");
                                                            document.getElementById("card_numb").value = "";

                                                        } else if (card_status == "success") {

                                                            document.getElementById("paid").readOnly = true;
                                                            document.getElementById("paid").value = card_value;
                                                            document.getElementById("submit_btn").style.display = "block";

                                                            document.getElementById("paid").onclick = false;

                                                            calculatePaidAmtGift(card_value);
                                                        }

                                                    }
                                                });

                                                //document.getElementById("submit_btn").style.display = "block";
                                            } else {
                                                document.getElementById("submit_btn").style.display = "none";
                                            }


                                        });


                                    });
                        </script> 

                        <div class="row" id="card_wrp" style="padding-top: 10px; padding-bottom: 10px; display: none;">
                            <div class="col-md-6"><b><?php echo $lang_gift_card_number; ?> :</b></div>
                            <div class="col-md-6">
                                <input type="text" name="card_numb" class="form-control" id="card_numb" placeholder="<?php echo $lang_gift_card_number; ?>" style="border: 1px solid #3a3a3a; color: #010101;" />
                            </div>
                        </div>

                        <div class="row" id="paid_wrp" style="padding-top: 10px; padding-bottom: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_paid_amt; ?> :</b></div>
                            <div class="col-md-6">
                                <input type="text" name="paid" id="paid" class="form-control" placeholder="0.00" style="border: 1px solid #3a3a3a; color: #010101;" <?php if ($keyboard == '1') {
                                        ?>onchange="calculatePaidAmt(this.value)"<?php }
                                    ?> <?php if ($keyboard == '0') {
                                        ?>onkeyup="calculatePaidAmt(this.value)"<?php }
                                    ?> autocomplete="off" />
                            </div>
                        </div>

                        <div class="row" id="addi_card_numb_wrp" style="padding-top: 10px; padding-bottom: 10px; display: none;">
                            <div class="col-md-6"><b><?php echo $lang_card_number; ?> :</b></div>
                            <div class="col-md-6">
                                <input type="text" name="addi_card_numb" id="addi_card_numb" class="form-control" style="border: 1px solid #3a3a3a; color: #010101;" />
                            </div>
                        </div>

                        <div class="row" id="return_wrp" style="padding-top: 10px; padding-bottom: 10px;">
                            <div class="col-md-6"><b><?php echo $lang_return_change; ?> :</b></div>
                            <div class="col-md-6">
                                <span id="return_change" style="background-color: #FFFF99; padding: 10px 10px;"></span>
                                <input type="hidden" id="returned_change" name="returned_change" value="0" />
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer" style="margin-top: 0px;">
                        <input type="submit" value="<?php echo $lang_submit; ?>" class="btn btn-primary" id="submit_btn" style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right; display: none;" />
                    </div>
                </div>
            </div>
        </div>


        <input type="hidden" name="row_count" id="row_count" value="<?php echo $sus_row_count; ?>" />
        <!-- 	<input type="hidden" name="row_count" id="row_count" value="1" /> -->

        <input type="hidden" name="final_total_payable" id="final_total_payable" value="<?php echo $grandTotal; ?>" />
        <input type="hidden" name="final_total_qty" id="final_total_qty" value="<?php echo $total_items; ?>" />

        <input type="hidden" name="tax" id="tax" value="<?php echo $tax; ?>" />
        <input type="hidden" name="tax_amt" id="tax_amt" value="<?php echo $tax_amt; ?>" />

        <input type="hidden" name="subTotal" id="subTotal" value="<?php echo $subTotal; ?>" />

        <input type="hidden" name="suspend_id" value="<?php echo $suspend_id; ?>" />

        <input type="hidden" name="outlet" id="outlet" value="<?php echo $outlet; ?>" />

</div><!-- Right Colmn // END -->



<script>


    var logDiv = $("#log");

    for (var i = 0; i <= <?php echo $pp; ?>; i++) {
        $("button").eq(i).on("click", {val: $('#txtMessage_' + i).val()}, function (event) {


            var row_count = document.getElementById("row_count").value;
            row_count = parseInt(row_count);
            add_row_count = row_count;

            var discount_amt = document.getElementById("dis_amt").value;
            if (discount_amt.length == 0) {
                discount_amt = 0;
            }
            discount_amt = parseFloat(discount_amt);

            var tax = document.getElementById("tax").value;
            tax = parseFloat(tax);

            var pcode = event.data.val;

            var temp_outlet = document.getElementById("outlet").value;


            //document.getElementById("row_count").value 	= add_row_count;

            var resultPrice = $.ajax({
                url: '<?= base_url() ?>pos/getProductDetail?pcode=' + pcode + '&outlet_id=' + temp_outlet,
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
                    var name = data.prod_name;
                    var price = data.price;
                    var qty = data.qty;


                    if (add_row_count == 1) {

                        if (qty >= 1) {
                            var msgs = '<div class="row" id="item_row_' + add_row_count + '" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-4" style="background-color: #4d9fe4; color: #FFF;">' + name + ' <br />[' + pcode + ']</div><div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;"><div class="row"><div class="col-md-3" style="padding-top:7px"><span onclick="minusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/minus_icon.png" /></span></div><div class="col-md-6" style="padding-left: 0px; padding-right: 0px;"><input type="text" id="display_qty_' + add_row_count + '" class="form-control" value="1" onchange="manualQty(this.value, ' + add_row_count + ')" style="text-align:center;" /></div><div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span onclick="plusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/plus_icon.png" /></span></div></div></div><div class="col-md-3">' + price + '</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(' + add_row_count + ')" style="cursor:pointer;">x</span></div></div><input type="hidden" name="pcode_' + add_row_count + '" id="pcode_' + add_row_count + '" value="' + pcode + '" /><input type="hidden" name="price_' + add_row_count + '" id="price_' + add_row_count + '" value="' + price + '" /><input type="hidden" name="qty_' + add_row_count + '" id="qty_' + add_row_count + '" value="1" />';
                            logDiv.append(msgs + "");

                            add_row_count++;
                            document.getElementById("row_count").value = add_row_count;
                        } else {
                            $('#outofstockwrp').modal('show');
                            //alert("Out of Stock! Please Make Purchase Order!");
                        }
                    } else {

                        var check_existing_pcode = 0;

                        for (var q = 1; q < add_row_count; q++) {
                            var exist_pcode = document.getElementById("pcode_" + q).value;

                            if (pcode == exist_pcode) {
                                check_existing_pcode++;
                            }
                        }

                        if (check_existing_pcode == 0) {

                            if (qty >= 1) {
                                var msgs = '<div class="row" id="item_row_' + add_row_count + '" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-4" style="background-color: #4d9fe4; color: #FFF;">' + name + ' <br />[' + pcode + ']</div><div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;"><div class="row"><div class="col-md-3" style="padding-top:7px"><span onclick="minusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/minus_icon.png" /></span></div><div class="col-md-6" style="padding-left: 0px; padding-right: 0px;"><input type="text" id="display_qty_' + add_row_count + '" class="form-control" value="1" onchange="manualQty(this.value, ' + add_row_count + ')" style="text-align:center;" /></div><div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span onclick="plusDiv(' + add_row_count + ')" style="cursor:pointer;"><img src="<?= base_url() ?>assets/img/plus_icon.png" /></span></div></div></div><div class="col-md-3">' + price + '</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(' + add_row_count + ')" style="cursor:pointer;">x</span></div></div><input type="hidden" name="pcode_' + add_row_count + '" id="pcode_' + add_row_count + '" value="' + pcode + '" /><input type="hidden" name="price_' + add_row_count + '" id="price_' + add_row_count + '" value="' + price + '" /><input type="hidden" name="qty_' + add_row_count + '" id="qty_' + add_row_count + '" value="1" />';
                                logDiv.append(msgs + "");

                                add_row_count++;
                                document.getElementById("row_count").value = add_row_count;
                            } else {
                                $('#outofstockwrp').modal('show');
                                //alert("Out of Stock! Please make Purchase Order!");
                            }
                        } else {

                            for (var q = 1; q < add_row_count; q++) {
                                var exist_pcode = document.getElementById("pcode_" + q).value;
                                var exist_qty = document.getElementById("qty_" + q).value;

                                exist_qty = parseInt(exist_qty);

                                if (pcode == exist_pcode) {
                                    var new_qty = exist_qty + 1;

                                    if (qty >= new_qty) {
                                        //document.getElementById("display_qty_"+q).innerHTML 	= new_qty;
                                        document.getElementById("display_qty_" + q).value = new_qty;
                                        document.getElementById("qty_" + q).value = new_qty;
                                    } else {
                                        $('#outofstockwrp').modal('show');
                                        //alert("Out of Stock! Please make Purchase Order!");
                                    }


                                }
                            }



                        }

                    }



                    //document.getElementById("row_count").value 	= add_row_count;

                    var total_item_qty = 0;
                    var total_item_price = 0;
                    for (var p = 1; p < add_row_count; p++) {
                        var each_price = document.getElementById("price_" + p).value;
                        var each_qty = document.getElementById("qty_" + p).value;

                        each_price = parseFloat(each_price);
                        each_qty = parseInt(each_qty);

                        //alert(each_qty);

                        total_item_price += (each_price * each_qty);

                        if (each_price > 0) {
                            total_item_qty += each_qty;
                        }
                    }

                    total_item_price = total_item_price - discount_amt;

                    var total_tax_amt = total_item_price * (tax / 100);

                    var grandTotal = total_item_price + total_tax_amt;
                    grandTotal = grandTotal.toFixed(2);


                    document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                    document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                    document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
                    document.getElementById("total_payable").innerHTML = grandTotal;

                    // To display at Model;
                    document.getElementById("final_payable_amt").innerHTML = grandTotal;
                    document.getElementById("final_purchased_item").innerHTML = total_item_qty;

                    // To Insert DB;
                    document.getElementById("final_total_payable").value = grandTotal;
                    document.getElementById("final_total_qty").value = total_item_qty;

                    document.getElementById("total_item_qty").innerHTML = total_item_qty;

                    document.getElementById("subTotal").value = total_item_price.toFixed(2);



                }	// end of success;
            });


        });
    }


    function manualQty(comQty, ele) {
        var pcode = document.getElementById("pcode_" + ele).value;
        var temp_outlet = document.getElementById("outlet").value;

        comQty = parseInt(comQty);

        var new_qty = comQty;

        if (new_qty < 1) {
            document.getElementById("display_qty_" + ele).value = "1";
            document.getElementById("qty_" + ele).value = 1;

            var row_count = document.getElementById("row_count").value;

            var upd_row_count = 0;
            var total_item_qty = 0;
            var total_item_price = 0;
            for (var p = 1; p < row_count; p++) {
                var each_price = document.getElementById("price_" + p).value;
                var each_qty = document.getElementById("qty_" + p).value;

                each_price = parseFloat(each_price);
                each_qty = parseInt(each_qty);

                total_item_price += (each_price * each_qty);

                if (each_price > 0) {
                    total_item_qty += each_qty;
                }

                upd_row_count++;

            }

            var discount_amt = document.getElementById("dis_amt").value;
            discount_amt = parseFloat(discount_amt);

            var tax = document.getElementById("tax").value;
            tax = parseFloat(tax);

            total_item_price = total_item_price - discount_amt;

            var total_tax_amt = total_item_price * (tax / 100);

            var grandTotal = total_item_price + total_tax_amt;
            grandTotal = grandTotal.toFixed(2);

            document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
            document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

            document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
            document.getElementById("total_payable").innerHTML = grandTotal;

            // to display at Model;
            document.getElementById("final_payable_amt").innerHTML = grandTotal;
            document.getElementById("final_purchased_item").innerHTML = total_item_qty;

            // to insert Database;
            document.getElementById("final_total_payable").value = grandTotal;
            document.getElementById("final_total_qty").value = total_item_qty;

            document.getElementById("total_item_qty").innerHTML = total_item_qty;

            //document.getElementById("row_count").value 					= upd_row_count;

            document.getElementById("subTotal").value = total_item_price.toFixed(2);

            $("#openreachmini").modal('show');
        } else {
            var resultPrice = $.ajax({
                url: '<?= base_url() ?>pos/getProductDetail?pcode=' + pcode + '&outlet_id=' + temp_outlet,
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
                    var name = data.prod_name;
                    var price = data.price;
                    var qty = data.qty;

                    if (qty >= new_qty) {

                        //document.getElementById("display_qty_"+ele).innerHTML 	= new_qty;
                        document.getElementById("display_qty_" + ele).value = new_qty;
                        document.getElementById("qty_" + ele).value = new_qty;

                        var row_count = document.getElementById("row_count").value;

                        var upd_row_count = 0;
                        var total_item_qty = 0;
                        var total_item_price = 0;
                        for (var p = 1; p < row_count; p++) {
                            var each_price = document.getElementById("price_" + p).value;
                            var each_qty = document.getElementById("qty_" + p).value;

                            each_price = parseFloat(each_price);
                            each_qty = parseInt(each_qty);

                            total_item_price += (each_price * each_qty);

                            if (each_price > 0) {
                                total_item_qty += each_qty;
                            }

                            upd_row_count++;

                        }

                        var discount_amt = document.getElementById("dis_amt").value;
                        discount_amt = parseFloat(discount_amt);

                        var tax = document.getElementById("tax").value;
                        tax = parseFloat(tax);

                        total_item_price = total_item_price - discount_amt;

                        var total_tax_amt = total_item_price * (tax / 100);

                        var grandTotal = total_item_price + total_tax_amt;
                        grandTotal = grandTotal.toFixed(2);

                        document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                        document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                        document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
                        document.getElementById("total_payable").innerHTML = grandTotal;

                        // to display at Model;
                        document.getElementById("final_payable_amt").innerHTML = grandTotal;
                        document.getElementById("final_purchased_item").innerHTML = total_item_qty;

                        // to insert Database;
                        document.getElementById("final_total_payable").value = grandTotal;
                        document.getElementById("final_total_qty").value = total_item_qty;

                        document.getElementById("total_item_qty").innerHTML = total_item_qty;

                        //document.getElementById("row_count").value 					= upd_row_count;

                        document.getElementById("subTotal").value = total_item_price.toFixed(2);

                    } else {
                        document.getElementById("display_qty_" + ele).value = "1";
                        document.getElementById("qty_" + ele).value = 1;

                        var row_count = document.getElementById("row_count").value;

                        var upd_row_count = 0;
                        var total_item_qty = 0;
                        var total_item_price = 0;
                        for (var p = 1; p < row_count; p++) {
                            var each_price = document.getElementById("price_" + p).value;
                            var each_qty = document.getElementById("qty_" + p).value;

                            each_price = parseFloat(each_price);
                            each_qty = parseInt(each_qty);

                            total_item_price += (each_price * each_qty);

                            if (each_price > 0) {
                                total_item_qty += each_qty;
                            }

                            upd_row_count++;

                        }

                        var discount_amt = document.getElementById("dis_amt").value;
                        discount_amt = parseFloat(discount_amt);

                        var tax = document.getElementById("tax").value;
                        tax = parseFloat(tax);

                        total_item_price = total_item_price - discount_amt;

                        var total_tax_amt = total_item_price * (tax / 100);

                        var grandTotal = total_item_price + total_tax_amt;
                        grandTotal = grandTotal.toFixed(2);

                        document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                        document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                        document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
                        document.getElementById("total_payable").innerHTML = grandTotal;

                        // to display at Model;
                        document.getElementById("final_payable_amt").innerHTML = grandTotal;
                        document.getElementById("final_purchased_item").innerHTML = total_item_qty;

                        // to insert Database;
                        document.getElementById("final_total_payable").value = grandTotal;
                        document.getElementById("final_total_qty").value = total_item_qty;

                        document.getElementById("total_item_qty").innerHTML = total_item_qty;

                        //document.getElementById("row_count").value 					= upd_row_count;

                        document.getElementById("subTotal").value = total_item_price.toFixed(2);

                        $('#outofstockwrp').modal('show');
                    }
                }
            });

        }
    }

    function minusDiv(ele) {
        var pcode = document.getElementById("pcode_" + ele).value;
        var temp_outlet = document.getElementById("outlet").value;

        var curr_qty = document.getElementById("qty_" + ele).value;
        curr_qty = parseInt(curr_qty);

        var new_qty = curr_qty - 1;

        if (new_qty < 1) {
            $("#openreachmini").modal('show');
        } else {

            var resultPrice = $.ajax({
                url: '<?= base_url() ?>pos/getProductDetail?pcode=' + pcode + '&outlet_id=' + temp_outlet,
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
                    var name = data.prod_name;
                    var price = data.price;
                    var qty = data.qty;

                    if (qty >= new_qty) {

                        //document.getElementById("display_qty_"+ele).innerHTML 	= new_qty;
                        document.getElementById("display_qty_" + ele).value = new_qty;
                        document.getElementById("qty_" + ele).value = new_qty;

                        var row_count = document.getElementById("row_count").value;

                        var upd_row_count = 0;
                        var total_item_qty = 0;
                        var total_item_price = 0;
                        for (var p = 1; p < row_count; p++) {
                            var each_price = document.getElementById("price_" + p).value;
                            var each_qty = document.getElementById("qty_" + p).value;

                            each_price = parseFloat(each_price);
                            each_qty = parseInt(each_qty);

                            total_item_price += (each_price * each_qty);

                            if (each_price > 0) {
                                total_item_qty += each_qty;
                            }

                            upd_row_count++;

                        }

                        var discount_amt = document.getElementById("dis_amt").value;
                        discount_amt = parseFloat(discount_amt);

                        var tax = document.getElementById("tax").value;
                        tax = parseFloat(tax);

                        total_item_price = total_item_price - discount_amt;

                        var total_tax_amt = total_item_price * (tax / 100);

                        var grandTotal = total_item_price + total_tax_amt;
                        grandTotal = grandTotal.toFixed(2);

                        document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                        document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                        document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
                        document.getElementById("total_payable").innerHTML = grandTotal;

                        // to display at Model;
                        document.getElementById("final_payable_amt").innerHTML = grandTotal;
                        document.getElementById("final_purchased_item").innerHTML = total_item_qty;

                        // to insert Database;
                        document.getElementById("final_total_payable").value = grandTotal;
                        document.getElementById("final_total_qty").value = total_item_qty;

                        document.getElementById("total_item_qty").innerHTML = total_item_qty;

                        //document.getElementById("row_count").value 					= upd_row_count;

                        document.getElementById("subTotal").value = total_item_price.toFixed(2);

                    } else {
                        //document.getElementById("updInvPDT").innerHTML 			= name+" ["+pcode+"]";;
                        //document.getElementById("updInvPcode").value 			= pcode;

                        //$("#openreachmini").modal('show');	
                    }
                }
            });
        }
    }

    function plusDiv(ele) {
        var pcode = document.getElementById("pcode_" + ele).value;
        var temp_outlet = document.getElementById("outlet").value;

        var curr_qty = document.getElementById("qty_" + ele).value;
        curr_qty = parseInt(curr_qty);

        var new_qty = curr_qty + 1;

        var resultPrice = $.ajax({
            url: '<?= base_url() ?>pos/getProductDetail?pcode=' + pcode + '&outlet_id=' + temp_outlet,
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
                var name = data.prod_name;
                var price = data.price;
                var qty = data.qty;

                if (qty >= new_qty) {

                    //document.getElementById("display_qty_"+ele).innerHTML 	= new_qty;
                    document.getElementById("display_qty_" + ele).value = new_qty;
                    document.getElementById("qty_" + ele).value = new_qty;

                    var row_count = document.getElementById("row_count").value;

                    var upd_row_count = 0;
                    var total_item_qty = 0;
                    var total_item_price = 0;
                    for (var p = 1; p < row_count; p++) {
                        var each_price = document.getElementById("price_" + p).value;
                        var each_qty = document.getElementById("qty_" + p).value;

                        each_price = parseFloat(each_price);
                        each_qty = parseInt(each_qty);

                        total_item_price += (each_price * each_qty);

                        if (each_price > 0) {
                            total_item_qty += each_qty;
                        }

                        upd_row_count++;

                    }

                    var discount_amt = document.getElementById("dis_amt").value;
                    discount_amt = parseFloat(discount_amt);

                    var tax = document.getElementById("tax").value;
                    tax = parseFloat(tax);

                    total_item_price = total_item_price - discount_amt;

                    var total_tax_amt = total_item_price * (tax / 100);

                    var grandTotal = total_item_price + total_tax_amt;
                    grandTotal = grandTotal.toFixed(2);

                    document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                    document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                    document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
                    document.getElementById("total_payable").innerHTML = grandTotal;

                    // to display at Model;
                    document.getElementById("final_payable_amt").innerHTML = grandTotal;
                    document.getElementById("final_purchased_item").innerHTML = total_item_qty;

                    // to insert Database;
                    document.getElementById("final_total_payable").value = grandTotal;
                    document.getElementById("final_total_qty").value = total_item_qty;

                    document.getElementById("total_item_qty").innerHTML = total_item_qty;

                    //document.getElementById("row_count").value 					= upd_row_count;

                    document.getElementById("subTotal").value = total_item_price.toFixed(2);

                } else {
                    //document.getElementById("updInvPDT").innerHTML 			= name+" ["+pcode+"]";;
                    //document.getElementById("updInvPcode").value 			= pcode;							

                    $('#outofstockwrp').modal('show');

                    //$("#opendInventoryUpdate").modal('show');
                }
            }
        });
    }

    function deleteDiv(ele) {

        $('#item_row_' + ele).remove();
        document.getElementById("pcode_" + ele).value = "";
        document.getElementById("price_" + ele).value = 0;
        document.getElementById("qty_" + ele).value = 0;

        var row_count = document.getElementById("row_count").value;

        var upd_row_count = 0;
        var total_item_qty = 0;
        var total_item_price = 0;
        for (var p = 1; p < row_count; p++) {
            var each_price = document.getElementById("price_" + p).value;
            var each_qty = document.getElementById("qty_" + p).value;

            each_price = parseFloat(each_price);
            each_qty = parseInt(each_qty);

            total_item_price += (each_price * each_qty);

            if (each_price > 0) {
                total_item_qty += each_qty;
            }

            upd_row_count++;

        }

        var discount_amt = document.getElementById("dis_amt").value;
        discount_amt = parseFloat(discount_amt);

        var tax = document.getElementById("tax").value;
        tax = parseFloat(tax);

        total_item_price = total_item_price - discount_amt;

        var total_tax_amt = total_item_price * (tax / 100);

        var grandTotal = total_item_price + total_tax_amt;
        grandTotal = grandTotal.toFixed(2);

        document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
        document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

        document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
        document.getElementById("total_payable").innerHTML = grandTotal;

        // to display at Model;
        document.getElementById("final_payable_amt").innerHTML = grandTotal;
        document.getElementById("final_purchased_item").innerHTML = total_item_qty;

        // to insert Database;
        document.getElementById("final_total_payable").value = grandTotal;
        document.getElementById("final_total_qty").value = total_item_qty;

        document.getElementById("total_item_qty").innerHTML = total_item_qty;

        //document.getElementById("row_count").value 					= upd_row_count;

        document.getElementById("subTotal").value = total_item_price.toFixed(2);
    }

    function cancelSelected() {
        var row_count = document.getElementById("row_count").value;
        document.getElementById("dis_amt").value = 0;

        for (var r = 1; r < row_count; r++) {
            $('#item_row_' + r).remove();
            document.getElementById("pcode_" + r).value = "";
            document.getElementById("price_" + r).value = 0;
            document.getElementById("qty_" + r).value = 0;
        }

        var upd_row_count = 0;
        var total_item_qty = 0;
        var total_item_price = 0;
        for (var p = 1; p < row_count; p++) {
            var each_price = document.getElementById("price_" + p).value;
            var each_qty = document.getElementById("qty_" + p).value;

            each_price = parseFloat(each_price);
            each_qty = parseInt(each_qty);

            total_item_price += (each_price * each_qty);

            if (each_price > 0) {
                total_item_qty += each_qty;
            }

            upd_row_count++;

        }

        var discount_amt = document.getElementById("dis_amt").value;
        discount_amt = parseFloat(discount_amt);

        var tax = document.getElementById("tax").value;
        tax = parseFloat(tax);

        total_item_price = total_item_price - discount_amt;

        var total_tax_amt = total_item_price * (tax / 100);

        var grandTotal = total_item_price + total_tax_amt;
        grandTotal = grandTotal.toFixed(2);

        document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
        document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

        document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
        document.getElementById("total_payable").innerHTML = grandTotal;

        // to display at Model;
        document.getElementById("final_payable_amt").innerHTML = grandTotal;
        document.getElementById("final_purchased_item").innerHTML = total_item_qty;

        // to insert Database;
        document.getElementById("final_total_payable").value = grandTotal;
        document.getElementById("final_total_qty").value = total_item_qty;

        document.getElementById("total_item_qty").innerHTML = total_item_qty;

        document.getElementById("row_count").value = upd_row_count;

        document.getElementById("subTotal").value = total_item_price.toFixed(2);

    }


    function calculateDiscount(ele) {

        var tax = document.getElementById("tax").value;
        tax = parseFloat(tax);

        if (ele == 0) {

            var row_count = document.getElementById("row_count").value;

            var total_item_price = 0;
            for (var p = 1; p < row_count; p++) {
                var each_price = document.getElementById("price_" + p).value;
                var each_qty = document.getElementById("qty_" + p).value;

                each_price = parseFloat(each_price);
                each_qty = parseInt(each_qty);

                total_item_price += (each_price * each_qty);
            }

            var total_tax_amt = total_item_price * (tax / 100);

            var grandTotal = total_item_price + total_tax_amt;
            grandTotal = grandTotal.toFixed(2);

            document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
            document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

            document.getElementById("total_price").innerHTML = total_item_price.toFixed(2);
            document.getElementById("total_payable").innerHTML = grandTotal;

            document.getElementById("final_total_payable").value = grandTotal;
            document.getElementById("final_payable_amt").innerHTML = grandTotal;

            document.getElementById("subTotal").value = total_item_price.toFixed(2);

        } else {

            if (ele.indexOf("%") >= 0) {

                var row_count = document.getElementById("row_count").value;

                var final_total_payable = 0;
                for (var p = 1; p < row_count; p++) {
                    var each_price = document.getElementById("price_" + p).value;
                    var each_qty = document.getElementById("qty_" + p).value;

                    each_price = parseFloat(each_price);
                    each_qty = parseInt(each_qty);

                    final_total_payable += (each_price * each_qty);
                }


                var sep_ele = ele.substr(0, ele.indexOf('%'));
                sep_ele = parseInt(sep_ele);

                var ele_amt = (final_total_payable * (sep_ele / 100));

                if (ele_amt < final_total_payable) {
                    var amt = final_total_payable - ele_amt;

                    var total_tax_amt = amt * (tax / 100);

                    var grandTotal = amt + total_tax_amt;
                    grandTotal = grandTotal.toFixed(2);

                    document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                    document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                    document.getElementById("total_price").innerHTML = amt.toFixed(2);
                    document.getElementById("total_payable").innerHTML = grandTotal;

                    document.getElementById("final_total_payable").value = grandTotal;
                    document.getElementById("final_payable_amt").innerHTML = grandTotal;

                    document.getElementById("subTotal").value = amt.toFixed(2);
                } else {
                    alert("Discount Amount must to less than Payable Amount!");
                }


            } else {

                var row_count = document.getElementById("row_count").value;

                var final_total_payable = 0;
                for (var p = 1; p < row_count; p++) {
                    var each_price = document.getElementById("price_" + p).value;
                    var each_qty = document.getElementById("qty_" + p).value;

                    each_price = parseFloat(each_price);
                    each_qty = parseInt(each_qty);

                    final_total_payable += (each_price * each_qty);
                }


                if (ele < final_total_payable) {
                    var amt = final_total_payable - ele;

                    var total_tax_amt = amt * (tax / 100);

                    var grandTotal = amt + total_tax_amt;
                    grandTotal = grandTotal.toFixed(2);

                    document.getElementById("display_tax_amt").innerHTML = total_tax_amt.toFixed(2);
                    document.getElementById("tax_amt").value = total_tax_amt.toFixed(2);

                    document.getElementById("total_price").innerHTML = amt.toFixed(2);
                    document.getElementById("total_payable").innerHTML = grandTotal;

                    document.getElementById("final_total_payable").value = grandTotal;
                    document.getElementById("final_payable_amt").innerHTML = grandTotal;

                    document.getElementById("subTotal").value = amt.toFixed(2);

                } else {
                    alert("Discount Amount must to less than Payable Amount!");
                }

            }



        }
    }

    function calculatePaidAmt(ele) {
        var paid_by = document.getElementById("paid_by").value;
        var payable_amt = document.getElementById("final_total_payable").value;
        payable_amt = parseFloat(payable_amt);

        if (paid_by == "6") {
            var change_amt = 0;
        } else {
            var change_amt = ele - payable_amt;
        }

        document.getElementById("returned_change").value = change_amt.toFixed(2);
        document.getElementById("return_change").innerHTML = change_amt.toFixed(2);

        if ((paid_by == "6") || (paid_by == "7")) {
            document.getElementById("submit_btn").style.display = "block";
        } else {
            if (change_amt < 0) {
                document.getElementById("submit_btn").style.display = "none";
            } else {
                document.getElementById("submit_btn").style.display = "block";
            }
        }

        if (document.getElementById('advance').checked) {
            document.getElementById("submit_btn").style.display = "block";

            document.getElementById("addi_card_numb_wrp").style.display = "block";
            //document.getElementById("addi_card_numb").required 				= true;

        }
    }

    function calculatePaidAmtGift(ele) {
        var paid_by = document.getElementById("paid_by").value;
        var payable_amt = document.getElementById("final_total_payable").value;
        payable_amt = parseFloat(payable_amt);

        var change_amt = 0;
        if (ele <= payable_amt) {
            change_amt = ele - payable_amt;
        } else {
            change_amt = 0;
        }

        document.getElementById("returned_change").value = change_amt.toFixed(2);
        document.getElementById("return_change").innerHTML = change_amt.toFixed(2);

        if (change_amt < 0) {
            alert("Gift Card Amount is less than Payable Amount!");
            document.getElementById("submit_btn").style.display = "none";
        } else {
            document.getElementById("submit_btn").style.display = "block";
        }

        if (document.getElementById('advance').checked) {
            document.getElementById("submit_btn").style.display = "block";

            document.getElementById("addi_card_numb_wrp").style.display = "block";
            //document.getElementById("addi_card_numb").required 				= true;

        }

    }

</script>

<?php if ($keyboard == '1') { ?>
    <!-- jQuery.NumPad -->
    <script src="<?= base_url() ?>assets/numberpad/jquery.numpad.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/numberpad/jquery.numpad.css">
    <script type="text/javascript">
    // Set NumPad defaults for jQuery mobile. 
    // These defaults will be applied to all NumPads within this document!
        $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
        $.fn.numpad.defaults.buttonNumberTpl = '<button type="button" class="btn btn-default"></button>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
        $.fn.numpad.defaults.onKeypadCreate = function () {
            $(this).find('.done').addClass('btn-primary');
        };

    // Instantiate NumPad once the page is ready to be shown
        $(document).ready(function () {
            $('#paid').numpad();
        });
    </script>
    <?php
}
?>

</form>
<?php
require_once 'includes/footer.php';
?>