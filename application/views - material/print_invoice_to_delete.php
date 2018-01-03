<?php
$settingResult = $this->db->get_where('site_setting');
$settingData = $settingResult->row();

$setting_dateformat = $settingData->datetime_format;
$setting_site_logo = $settingData->site_logo;

$orderData = $this->Constant_model->getDataOneColumn('orders', 'id', $order_id);

if (count($orderData) == 0) {
    $this->session->set_flashdata('alert_msg', array('success', 'Error', 'Something Wrong!'));
    redirect(base_url() . 'pos');

    die();
}

$ordered_dtm = date("$setting_dateformat H:i A", strtotime($orderData[0]->ordered_datetime));
$cust_fullname = $orderData[0]->customer_name;
$cust_mobile = $orderData[0]->customer_mobile;
$outlet_id = $orderData[0]->outlet_id;
$subTotal = $orderData[0]->subtotal;
$dis_amt = $orderData[0]->discount_total;
$tax_amt = $orderData[0]->tax;
$grandTotal = $orderData[0]->grandtotal;
$us_id = $orderData[0]->created_user_id;
$pay_method_id = $orderData[0]->payment_method;
$pay_method_name = $orderData[0]->payment_method_name;
$paid_amt = $orderData[0]->paid_amt;
$return_change = $orderData[0]->return_change;
$cheque_numb = $orderData[0]->cheque_number;
$dis_percentage = $orderData[0]->discount_percentage;

$outlet_name = $orderData[0]->outlet_name;
$outlet_address = $orderData[0]->outlet_address;
$outlet_contact = $orderData[0]->outlet_contact;
$card_numb = $orderData[0]->gift_card;

$receipt_header = '';
$receipt_footer = $orderData[0]->outlet_receipt_footer;

$unpaid_amt = 0;
//if ( ($pay_method_id == '6') || ($pay_method_id == '7') ) {
if (($pay_method_id == '6')) {
    $unpaid_amt = $paid_amt - $grandTotal;
}
/*
  $staff_name = '';
  $staffData = $this->Constant_model->getDataOneColumn('users', 'id', $us_id);

  $staff_name = $staffData[0]->fullname;

  $outlet_name = '';
  $outlet_address = '';
  $outlet_contact = '';

  $receipt_header = '';
  $receipt_footer = '';

  $outletNameData = $this->Constant_model->getDataOneColumn('outlets', 'id', $outlet_id);
  if (count($outletNameData) == 1) {
  $outlet_name = $outletNameData[0]->name;
  $outlet_address = $outletNameData[0]->address;
  $outlet_contact = $outletNameData[0]->contact_number;

  $receipt_header = $outletNameData[0]->receipt_header;
  $receipt_footer = $outletNameData[0]->receipt_footer;
  }
 */
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Sale No : <?php echo $order_id; ?></title>
        <script src="<?= base_url() ?>assets/js/jquery-1.7.2.min.js"></script>

        <style type="text/css" media="all">
            body { 
                max-width: 300px; 
                margin:0 auto; 
                text-align:center; 
                color:#000; 
                font-family: Arial, Helvetica, sans-serif; 
                font-size:12px; 
            }
            #wrapper { 
                min-width: 250px; 
                margin: 0px auto; 
            }
            #wrapper img { 
                max-width: 300px; 
                width: auto; 
            }

            h2, h3, p { 
                margin: 5px 0;
            }
            .left { 
                width:100%; 
                float:right; 
                text-align:right; 
                margin-bottom: 3px;
                margin-top: 3px;
            }
            .right { 
                width:40%; 
                float:right; 
                text-align:right; 
                margin-bottom: 3px; 
            }
            .table, .totals { 
                width: 100%; 
                margin:10px 0; 
            }
            .table th { 
                border-top: 1px solid #000; 
                border-bottom: 1px solid #000; 
                padding-top: 4px;
                padding-bottom: 4px;
            }
            .table td { 
                padding:0; 
            }
            .totals td { 
                width: 24%; 
                padding:0; 
            }
            .table td:nth-child(2) { 
                overflow:hidden; 
            }

            @media print {
                body { text-transform: uppercase; }
                #buttons { display: none; }
                #wrapper { width: 100%; margin: 0; font-size:9px; }
                #wrapper img { max-width:300px; width: 80%; }
                #bkpos_wrp{
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <div id="wrapper">
            <table border="0" style="border-collapse: collapse; width: 100%; height: auto;">
                <tr>
                    <td width="100%" align="center">
                <center>
                    <img src="<?= base_url() ?>assets/img/logo/<?php echo $setting_site_logo; ?>" style="width: 60px;" />
                </center>
                </td>
                </tr>
                <tr>
                    <td width="100%" align="center">
                        <h2 style="padding-top: 0px; font-size: 24px;"><strong><?php echo $outlet_name; ?></strong></h2>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span class="left" style="text-align: left;">Address : <?php echo $outlet_address; ?></span>	
                        <span class="left" style="text-align: left;">Tel : <?php echo $outlet_contact; ?></span> 
                        <span class="left" style="text-align: left;">Sale Id : <?php echo $order_id; ?></span>
                        <span class="left" style="text-align: left;">Date : <?php echo $ordered_dtm; ?></span>
                        <span class="left" style="text-align: left;">Customer Name&nbsp; : <?php echo $cust_fullname; ?></span> 
                        <span class="left" style="text-align: left;">Customer Phone : <?php
                            if (empty($cust_mobile)) {
                                echo '-';
                            } else {
                                echo $cust_mobile;
                            }
                            ?></span>
                    </td>
                </tr>   
            </table>



            <div style="clear:both;"></div>

            <table class="table" cellspacing="0"  border="0"> 
                <thead> 
                    <tr> 
                        <th width="10%"><em>#</em></th> 
                        <th width="35%" align="left">Product</th>
                        <th width="10%">Qty</th>
                        <th width="25%">Per Item</th>
                        <th width="20%" align="right">Total</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php
                    $total_item_amt = 0;
                    $total_item_qty = 0;

                    $orderItemResult = $this->db->query("SELECT * FROM order_items WHERE order_id = '$order_id' ORDER BY id ");
                    $orderItemData = $orderItemResult->result();
                    for ($i = 0; $i < count($orderItemData); ++$i) {
                        $pcode = $orderItemData[$i]->product_code;
                        $name = $orderItemData[$i]->product_name;
                        $qty = $orderItemData[$i]->qty;
                        $price = $orderItemData[$i]->price;

                        $each_row_price = 0;
                        $each_row_price = $qty * $price;

                        $total_item_amt += $each_row_price;
                        ?>
                        <tr>
                            <td style="text-align:center; width:30px;" valign="top"><?php echo $i + 1; ?></td>
                            <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $name; ?><br />[<?php echo $pcode; ?>]</td>
                            <td style="text-align:center; width:50px;" valign="top"><?php echo $qty; ?></td>
                            <td style="text-align:center; width:50px;" valign="top"><?php echo number_format($price, 2); ?></td>
                            <td style="text-align:right; width:70px;" valign="top"><?php echo number_format($each_row_price, 2); ?></td>
                        </tr>	
                        <?php
                        $total_item_qty += $qty;

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


            <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;">Total Items</td>
                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"><?php echo $total_item_qty; ?></td>
                        <td style="text-align:left; padding-left:1.5%;">Total</td>
                        <td style="text-align:right;font-weight:bold;"><?php echo number_format($total_item_amt, 2); ?></td>
                    </tr>

                    <?php
                    if ($dis_amt > 0) {
                        ?>
                        <tr>
                            <td style="text-align:left;"></td>
                            <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"></td>
                            <td style="text-align:left; padding-left:1.5%; padding-bottom: 5px;">Discount&nbsp;<?php
                                if (!empty($dis_percentage)) {
                                    echo '(' . $dis_percentage . ')';
                                }
                                ?></td>
                            <td style="text-align:right;font-weight:bold;">-<?php echo number_format($dis_amt, 2); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;">&nbsp;</td>
                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
                        <td style="text-align:left; padding-left:1.5%;">Sub Total</td>
                        <td style="text-align:right;font-weight:bold;"><?php echo number_format($subTotal, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;">&nbsp;</td>
                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
                        <td style="text-align:left; padding-left:1.5%;">Tax</td>
                        <td style="text-align:right;font-weight:bold;"><?php echo number_format($tax_amt, 2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;">Grand Total</td>
                        <td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($grandTotal, 2); ?></td>
                    </tr>

                    <tr>    
                        <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Paid</td>
                        <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($paid_amt, 2); ?></td>
                    </tr>
                    <?php
                    if ($return_change > 0) {
                        ?>
                        <tr>
                            <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Change</td>
                            <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($return_change, 2); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
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
                        <td style="text-align:left; padding-top: 5px; font-weight: bold; border-top: 1px solid #000;">Paid By : </td>
                        <td style="text-align:right; padding-top: 5px; padding-right:1.5%; border-top: 1px solid #000;font-weight:bold;" colspan="3">
                            <?php echo $pay_method_name; ?>
                            <?php
                            if ($pay_method_id == '5') {
                                echo "(Cheque No. : $cheque_numb)";
                            }
                            if ($pay_method_id == '7') {
                                echo "(Card No. : $card_numb)";
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="border-top:1px solid #000; padding-top:10px;">
                <?php
                echo $receipt_footer;
                ?>    
            </div>
            <!--
                    <div id="buttons" style="padding-top:10px; text-transform:uppercase;">
                <span class="left"><a href="#" style="width:90%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 1px; font-weight:bold;" id="email">Email</a></span>
                <span class="right"><button type="button" onClick="window.print();return false;" style="width:100%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 1px; font-weight:bold;">Print</button></span>
                <div style="clear:both;"></div>
            -->

            <div id="bkpos_wrp">
                <a href="<?= base_url() ?>pos" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;">Back to POS</a>
            </div>

            <div id="bkpos_wrp">
                <button type="button" onClick="window.print();return false;" style="width:101%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 0px; font-weight:bold;">Print Small Receipt</button>
            </div>

            <div id="bkpos_wrp" style="margin-top: 8px;">
                <span class="left"><a href="#" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 0px; font-weight:bold;" id="email">Email</a></span>
            </div>

            <div id="bkpos_wrp">
                <span class="left">
                    <a href="<?= base_url() ?>pos/view_invoice_a4?id=<?php echo $order_id; ?>" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 0px; font-weight:bold; margin-top: 6px;">
                        Print A4
                    </a>
                </span>
            </div>

            <input type="hidden" id="id" value="<?php echo $order_id; ?>" />

        </div>

        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
                    $(document).ready(function () {
                        $('#email').click(function () {
                            var email = prompt("Please enter email address", "test@mail.com");
                            var id = document.getElementById("id").value;

                            $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>pos/send_invoice",
                                data: {email: email, id: id}
                            }).done(function (msg) {
                                alert("Successfully Sent Receipt to " + email);
                            });

                        });
                    });

                    $(window).load(function () {
                        window.print();
                    });
        </script>




    </body>
</html>
