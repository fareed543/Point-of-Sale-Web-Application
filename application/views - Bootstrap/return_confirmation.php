<?php
require_once 'includes/header.php';

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
$pay_name = $returnData[0]->payment_method_name;

$staff_name = '';
$staffData = $this->Constant_model->getDataOneColumn('users', 'id', $ret_staff_id);
if (count($staffData) == 1) {
    $staff_name = $staffData[0]->fullname;
}
?>



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_return_order_confirmation; ?></h1>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_customer; ?></label>
                                <br />
                                <?php
                                echo $ret_cust_name;
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_outlets; ?></label>
                                <br />
                                <?php echo $outlet_name; ?>
                            </div>
                        </div>
                        <div class="col-md-5" style="text-align: right;">
                            <a href="<?= base_url() ?>returnorder/printReturn?return_id=<?php echo $return_id ?>" style="text-decoration: none;">
                                <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo $lang_print_return_order_receipt; ?>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_remark; ?></label>
                                <br />
                                <?php echo nl2br($ret_remark); ?>
                            </div>
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_refund_amount; ?></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            : <?php echo number_format($ret_paid_amt, 2); ?> (<?php echo $site_currency; ?>)
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_refund_tax; ?></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            : <?php echo number_format($ret_taxTotal, 2); ?> (<?php echo $site_currency; ?>)
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_refund_grand_total; ?></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            : <?php echo number_format($ret_grandTotal, 2); ?> (<?php echo $site_currency; ?>)
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;"><?php echo $lang_refund_by; ?></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            : <?php echo $pay_name; ?>
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                    <?php
                    if (!empty($ret_cheque_no)) {
                        ?>
                        <div class="row" id="cheque_wrp">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-size: 14px;">Cheque Number</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                : <?php echo $ret_cheque_no; ?>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size: 13px;"><?php echo $lang_refund_method; ?></label>
                            </div>
                        </div>
                        <div class="col-md-4">: 
                            <?php
                            if ($ret_vt_status == '1') {
                                echo $lang_full_refund;
                            }
                            if ($ret_vt_status == '2') {
                                echo $lang_partial_refund;
                            }
                            ?>
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                    <div class="row" style="margin-top: 5px; margin-bottom: 15px;">
                        <div class="col-md-12" style="border-top: 1px solid #ccc;"></div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="25%" style="background-color: #686868; color: #FFF;"><?php echo $lang_product_code; ?></th>
                                            <th width="25%" style="background-color: #686868; color: #FFF;"><?php echo $lang_product_name; ?></th>
                                            <th width="25%" style="background-color: #686868; color: #FFF;"><?php echo $lang_return_quantity; ?></th>
                                            <th width="25%" style="background-color: #686868; color: #FFF;"><?php echo $lang_condition; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $itemResult = $this->db->query("SELECT * FROM return_items WHERE order_id = '$return_id' ORDER BY id ");
                                        $itemData = $itemResult->result();
                                        for ($i = 0; $i < count($itemData); ++$i) {
                                            $pcode = $itemData[$i]->product_code;
                                            $price = $itemData[$i]->price;
                                            $qty = $itemData[$i]->qty;
                                            $cond = $itemData[$i]->item_condition;

                                            $p_name = '';
                                            $pNameData = $this->Constant_model->getDataOneColumn('products', 'code', $pcode);
                                            if (count($pNameData) == 1) {
                                                $p_name = $pNameData[0]->name;
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $pcode; ?>
                                                </td>
                                                <td>
                                                    <?php echo $p_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $qty; ?>
                                                </td>
                                                <td style="font-weight: bold;">
                                                    <?php
                                                    if ($cond == '1') {
                                                        echo $lang_good;
                                                    }
                                                    if ($cond == '2') {
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
                            </div>
                        </div>
                    </div>

                    <!-- Product List // END -->





                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->


        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->

    <br /><br /><br /><br /><br />

</div><!-- Right Colmn // END -->


<?php
require_once 'includes/footer.php';
?>

