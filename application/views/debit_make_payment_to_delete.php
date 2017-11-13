<?php
require_once 'includes/header.php';

$orderDtaData = $this->Constant_model->getDataOneColumn('orders', 'id', "$id");
if (count($orderDtaData) == 0) {
    redirect(base_url());
}

$order_cust_name = $orderDtaData[0]->customer_name;
$order_cust_email = $orderDtaData[0]->customer_email;
$order_cust_mb = $orderDtaData[0]->customer_mobile;
$order_date = date("$dateformat H:i A", strtotime($orderDtaData[0]->ordered_datetime));
$order_outlet_name = $orderDtaData[0]->outlet_name;
$order_outlet_address = $orderDtaData[0]->outlet_address;
$order_outlet_contact = $orderDtaData[0]->outlet_contact;
$order_subTotal = $orderDtaData[0]->subtotal;
$order_gstTotal = $orderDtaData[0]->tax;
$order_grandTotal = $orderDtaData[0]->grandtotal;
$order_disAmt = $orderDtaData[0]->discount_total;
$order_disPer = $orderDtaData[0]->discount_percentage;
$order_total_item = $orderDtaData[0]->total_items;
$order_pay_method_id = $orderDtaData[0]->payment_method;
$order_paid_amt = $orderDtaData[0]->paid_amt;
$vt_status = $orderDtaData[0]->vt_status;
$order_pay_method_name = $orderDtaData[0]->payment_method_name;
$order_cheque_numb = $orderDtaData[0]->cheque_number;
$order_gift_numb = $orderDtaData[0]->gift_card;

$unpaid_amt = 0;
if ($vt_status == '0') {
    $unpaid_amt = $order_paid_amt - $order_grandTotal;
}
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Make Payment for Sales Id : <?php echo $id; ?></h1>
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

                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?= base_url() ?>pos/view_invoice?id=<?php echo $id; ?>" style="text-decoration: none;" target="_blank">
                                <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h2><?php echo $order_outlet_name; ?></h2>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            Address : <?php echo $order_outlet_address; ?>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            Tel : <?php echo $order_outlet_contact; ?>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            Ordered Date : <?php echo $order_date; ?>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            Customer : <?php echo $order_cust_name; ?>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="table" cellspacing="0"  border="0" style="margin-bottom: 0px; width: 100%;"> 
                                <thead> 
                                    <tr> 
                                        <th width="10%"><em>#</em></th> 
                                        <th width="35%" align="left">Product</th>
                                        <th width="10%">Qty</th>
                                        <th width="25%">Per Item</th>
                                        <th width="20%" style="text-align: right;">Total</th> 
                                    </tr> 
                                </thead> 
                                <tbody>

                                    <?php
                                    $total_item_amt = 0;

                                    $orderItemResult = $this->db->query("SELECT * FROM order_items WHERE order_id = '$id' ORDER BY id ");
                                    $orderItemData = $orderItemResult->result();
                                    for ($i = 0; $i < count($orderItemData); ++$i) {
                                        $pcode = $orderItemData[$i]->product_code;
                                        $name = $orderItemData[$i]->product_name;
                                        $qty = $orderItemData[$i]->qty;
                                        $price = $orderItemData[$i]->price;

                                        $each_row_price = 0;
                                        $each_row_price = $qty * $price;
                                        ?>
                                        <tr>
                                            <td style="text-align:center; width:30px;" valign="top"><?php echo $i + 1; ?></td>
                                            <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top">
                                                <?php echo $name; ?><br />[<?php echo $pcode; ?>]
                                            </td>
                                            <td style="text-align:left; width:50px;" valign="top">
                                                <?php echo $qty; ?>
                                            </td>
                                            <td style="text-align:left; width:50px;" valign="top">
                                                <?php echo number_format($price, 2); ?>
                                            </td>
                                            <td style="text-align:right; width:70px;" valign="top">
                                                <?php echo number_format($each_row_price, 2); ?>
                                            </td>
                                        </tr>	
                                        <?php
                                        $total_item_amt += $each_row_price;

                                        unset($pcode);
                                        unset($name);
                                        unset($qty);
                                        unset($price);
                                    }
                                    unset($orderItemResult);
                                    unset($orderItemData);
                                    ?>

                                </tbody>
                            </table>


                            <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000; border-collapse: collapse; width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="text-align:left; padding-top: 5px;">Total Items</td>
                                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"><?php echo $order_total_item; ?></td>
                                        <td style="text-align:left; padding-left:1.5%;">Total</td>
                                        <td style="text-align:right;font-weight:bold;"><?php echo number_format($total_item_amt, 2); ?></td>
                                    </tr>

                                    <?php
                                    if ($order_disAmt > 0) {
                                        ?>
                                        <tr>
                                            <td style="text-align:left;"></td>
                                            <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"></td>
                                            <td style="text-align:left; padding-left:1.5%; padding-bottom: 5px;">
                                                Discount&nbsp;<?php
                                                if (!empty($order_disPer)) {
                                                    echo '(' . $order_disPer . ')';
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align:right;font-weight:bold;">
                                                -<?php echo number_format($order_disAmt, 2); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td style="text-align:left; padding-top: 5px;">&nbsp;</td>
                                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
                                        <td style="text-align:left; padding-left:1.5%;">Sub Total</td>
                                        <td style="text-align:right;font-weight:bold;">
                                            <?php echo number_format($order_subTotal, 2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; padding-top: 5px;">&nbsp;</td>
                                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
                                        <td style="text-align:left; padding-left:1.5%;">Tax</td>
                                        <td style="text-align:right;font-weight:bold;">
                                            <?php echo number_format($order_gstTotal, 2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;">
                                            Grand Total
                                        </td>
                                        <td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;">
                                            <?php echo number_format($order_grandTotal, 2); ?>
                                        </td>
                                    </tr>

                                    <tr>    
                                        <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Paid</td>
                                        <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($order_paid_amt, 2); ?></td>
                                    </tr>
                                    <?php
                                    if ($unpaid_amt < 0) {
                                        ?>
                                        <tr>
                                            <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Unpaid</td>
                                            <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($unpaid_amt, 2); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    <tr>    
                                        <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px; border-top: 1px solid #000;">Paid By</td>
                                        <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold; border-top: 1px solid #000;">
                                            <?php echo $order_pay_method_name; ?>
                                            <?php
                                            if ($order_pay_method_id == '5') {
                                                echo "(Cheque No. : $order_cheque_numb)";
                                            }
                                            if ($order_pay_method_id == '7') {
                                                echo "(Gift No. : $order_gift_numb)";
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <script type="text/javascript">
                        function checkChequePayment(ele) {
                            if (ele == "5") {
                                document.getElementById("cheque_wrp").style.display = "block";
                                document.getElementById("cheque").required = true;
                                document.getElementById("cheque").focus();
                            } else {
                                document.getElementById("cheque_wrp").style.display = "none";
                                document.getElementById("cheque").required = false;
                            }
                        }
                    </script>			
                    <?php
                    //if ($order_pay_method_id == '6') {
                    if ($vt_status == '0') {
                        ?>
                        <form action="<?= base_url() ?>debit/submitDebitPayment" method="post">		
                            <div class="row" style="padding-top: 0px; padding-bottom: 5px;">
                                <div class="col-md-2"></div>
                                <div class="col-md-8" style="border-top: 1px solid #000;">

                                    <div class="row" style="padding-top: 15px;">
                                        <div class="col-md-6" style="text-align: right; padding-top: 10px;"><b>Payment Method</b></div>
                                        <div class="col-md-6">
                                            <select name="payment_method" class="form-control" style="border: 1px solid #3a3a3a; color: #010101;" required onchange="checkChequePayment(this.value)">
                                                <option value="">Please select Payment Method</option>
                                                <?php
                                                $payMethodData = $this->Constant_model->getDataOneColumnSortColumn('payment_method', 'status', '1', 'name', 'ASC');
                                                for ($m = 0; $m < count($payMethodData); ++$m) {
                                                    $payMethod_id = $payMethodData[$m]->id;
                                                    $payMethod_name = $payMethodData[$m]->name;

                                                    if (($payMethod_id == '6') || ($payMethod_id == '7')) {
                                                        continue;
                                                    }
                                                    ?>
                                                    <option value="<?php echo $payMethod_id; ?>">
                                                        <?php echo $payMethod_name; ?>
                                                    </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" id="cheque_wrp" style="padding-top: 10px; padding-bottom: 10px; display: none;">
                                        <div class="col-md-6" style="text-align: right; padding-top: 10px;"><b>Cheque Number :</b></div>
                                        <div class="col-md-6">
                                            <input type="text" name="cheque" class="form-control" id="cheque" placeholder="Cheque Number" style="border: 1px solid #3a3a3a; color: #010101;" />
                                        </div>
                                    </div>

                                    <div class="row" id="cheque_wrp" style="padding-top: 15px; padding-bottom: 10px;">
                                        <div class="col-md-6" style="text-align: right; padding-top: 10px;"></div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                            <button type="submit" class="btn btn-primary">
                                                Submit Payment
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                        <?php
                    }
                    ?>		
                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->

            <a href="<?= base_url() ?>debit/view" style="text-decoration: none;">
                <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                    <i class="icono-caretLeft" style="color: #FFF;"></i>Back
                </div>
            </a>

        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->

    <br /><br /><br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>