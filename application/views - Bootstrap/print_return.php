<?php
$returnData = $this->Constant_model->getDataTwoColumn('orders', 'id', $return_id, 'status', '2');
if (count($returnData) == 0) {
    redirect(base_url() . 'dashboard');
}

$ret_cust_name = $returnData[0]->customer_name;
$ret_date_time = date("$site_dateformat", strtotime($returnData[0]->ordered_datetime));
$ret_outlet_id = $returnData[0]->outlet_id;
$ret_subTotal = $returnData[0]->subtotal;
$ret_taxTotal = $returnData[0]->tax;
$ret_grandTotal = $returnData[0]->grandtotal;
$ret_paid_by = $returnData[0]->payment_method;
$ret_cheque_no = $returnData[0]->cheque_number;
$ret_paid_amt = $returnData[0]->paid_amt;
$ret_staff_id = $returnData[0]->created_user_id;
$ret_vt_status = $returnData[0]->refund_status;
$ret_remark = $returnData[0]->remark;

$outlet_name = $returnData[0]->outlet_name;
$outlet_address = $returnData[0]->outlet_address;
$outlet_contact = $returnData[0]->outlet_contact;
$receipt_footer = $returnData[0]->outlet_receipt_footer;

$pay_name = $returnData[0]->payment_method_name;

$staff_name = '';
$staffData = $this->Constant_model->getDataOneColumn('users', 'id', $ret_staff_id);
if (count($staffData) == 1) {
    $staff_name = $staffData[0]->fullname;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Return Sale No : <?php echo $return_id; ?></title>
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
                float:left; 
                text-align:left; 
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
            <h2 style="padding-top: 0px; padding-bottom: 20px; font-size: 22px;"><strong><?php echo $outlet_name; ?></strong></h2>
            <span class="left"><?php echo $lang_address; ?> : <?php echo $outlet_address; ?></span>	
            <span class="left"><?php echo $lang_telephone; ?> : <?php echo $outlet_contact; ?></span> 
            <span class="left"><?php echo $lang_date; ?> : <?php echo $ret_date_time; ?></span>
            <span class="left"><?php echo $lang_customer; ?> : <?php echo $ret_cust_name; ?></span> 

            <div style="clear:both;"></div>

            <table class="table" cellspacing="0"  border="0"> 
                <thead> 
                    <tr> 
                        <th width="10%"><em>#</em></th> 
                        <th width="30%" align="left"><?php echo $lang_code; ?></th>
                        <th width="25%" align="left"><?php echo $lang_name; ?></th>
                        <th width="10%"><?php echo $lang_quantity; ?></th>
                        <th width="25%" align="right"><?php echo $lang_condition; ?></th>
                    </tr> 
                </thead> 
                <tbody> 
                    <?php
                    $total_item_amt = 0;
                    $total_item_qty = 0;

                    $itemResult = $this->db->query("SELECT * FROM return_items WHERE order_id = '$return_id' ORDER BY id ");
                    $itemData = $itemResult->result();
                    for ($i = 0; $i < count($itemData); ++$i) {
                        $pcode = $itemData[$i]->product_code;
                        $price = $itemData[$i]->price;
                        $qty = $itemData[$i]->qty;
                        $cond = $itemData[$i]->item_condition;

                        $total_item_qty += $qty;

                        $p_name = '';
                        $pNameData = $this->Constant_model->getDataOneColumn('products', 'code', $pcode);
                        if (count($pNameData) == 1) {
                            $p_name = $pNameData[0]->name;
                        }
                        ?>
                        <tr>
                            <td style="text-align:center; width:30px;" valign="top"><?php echo $i + 1; ?></td>
                            <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $pcode; ?></td>
                            <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $p_name; ?></td>
                            <td style="text-align:center; width:50px;" valign="top"><?php echo $qty; ?></td>
                            <td style="text-align:right; width:70px;" valign="top">
                                <?php
                                if ($cond == '1') {
                                    echo $lang_good;
                                } else {
                                    echo $lang_not_good;
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        unset($pcode);
                        unset($price);
                        unset($qty);
                        unset($cond);
                    }
                    unset($itemResult);
                    unset($itemData);
                    ?>








                </tbody> 
            </table> 


            <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000;">
                <tbody>
                    <!--
                            <tr>
                                    <td style="text-align:left; padding-top: 5px;">Total Items</td>
                                    <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"><?php echo $total_item_qty; ?></td>
                                    <td style="text-align:left; padding-left:1.5%;">Refund Amt.</td>
                                    <td style="text-align:right;font-weight:bold;"><?php echo number_format($ret_paid_amt, 2); ?></td>
                            </tr>
                    -->
                    <tr>
                        <td style="text-align:left; padding-top: 5px;"><?php echo $lang_total_items; ?></td>
                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"><?php echo $total_item_qty; ?></td>
                        <td style="text-align:left; padding-left:1.5%;"><?php echo $lang_sub_total; ?></td>
                        <td style="text-align:right;font-weight:bold;"><?php echo number_format($ret_subTotal, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;">&nbsp;</td>
                        <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
                        <td style="text-align:left; padding-left:1.5%;"><?php echo $lang_tax; ?></td>
                        <td style="text-align:right;font-weight:bold;"><?php echo $ret_taxTotal; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;"><?php echo $lang_grand_total; ?></td>
                        <td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"><?php echo $ret_grandTotal; ?></td>
                    </tr>

                    <tr>
                        <td style="text-align:left; padding-top: 5px; font-weight: bold; border-top: 1px solid #000;"><?php echo $lang_refund_by; ?> : </td>
                        <td style="text-align:right; padding-top: 5px; border-top: 1px solid #000;font-weight:bold;" colspan="3">
                            <?php echo $pay_name; ?>
                            <?php
                            if ($ret_paid_by == '5') {
                                echo "(Cheque No. : $ret_cheque_no)";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px; font-weight: bold; border-top: 1px solid #000;" colspan="2"><?php echo $lang_refund_method; ?> : </td>
                        <td style="text-align:right; padding-top: 5px; padding-right:1.5%; border-top: 1px solid #000;font-weight:bold;" colspan="2">
                            <?php
                            if ($ret_vt_status == '1') {
                                echo $lang_full_refund;
                            }
                            if ($ret_vt_status == '2') {
                                echo $lang_partial_refund;
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    if (!empty($ret_remark)) {
                        ?>
                        <tr>
                            <td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;"><?php echo $lang_remark; ?></td>
                            <td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"><?php echo nl2br($ret_remark); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <div style="border-top:1px solid #000; padding-top:10px;">
                <?php
                echo $receipt_footer;
                ?>    
            </div>

            <div id="bkpos_wrp">
                <a href="<?= base_url() ?>returnorder/confirmation?return_id=<?php echo $return_id; ?>" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;"><?php echo $lang_back; ?></a>
            </div>


        </div>

        <script src="<?= base_url() ?>assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                window.print();
            });
        </script>




    </body>
</html>
