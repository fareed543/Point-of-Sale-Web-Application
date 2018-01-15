<?php
require_once 'includes/header.php';
?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/datatables/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/datatables/jquery.dataTables.min.js"></script>
<link href="<?= base_url() ?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_today_sales; ?></h1>
        </div>
    </div><!--/.row-->

    <script type="text/javascript">
        function openReceipt(ele) {
            var myWindow = window.open(ele, "", "width=380, height=550");
        }
    </script>

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
                        <div class="col-md-12" style="text-align: right;">
                            <a href="<?= base_url() ?>sales/exportSales" style="text-decoration: none">
                                <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo $lang_export_to_excel; ?>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <?php
                            $totalPaidAmount = 0;
                            $totalGrandTotal = 0;
                            ?>
                            <div class="table-responsive">
                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="14%"><?php echo $lang_date; ?></th>
                                            <th width="7%"><?php echo $lang_sale_id; ?></th>
                                            <th width="7%"><?php echo $lang_users; ?></th>
                                            <th width="6%"><?php echo $lang_type; ?></th>
                                            <th width="12%"><?php echo $lang_outlets; ?></th>
                                            <th width="10%"><?php echo $lang_customer; ?></th>
                                            <th width="5%"><?php echo $lang_items; ?></th>
                                            <th width="8%"><?php echo $lang_sub_total; ?></th>
                                            <th width="8%"><?php echo $lang_tax; ?></th>
                                            <th width="8%">Paid Amount</th>
                                            <th width="8%"><?php echo $lang_grand_total; ?></th>
                                            <th width="10%"><?php echo $lang_action; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $today_start = date('Y-m-d 00:00:00', time());
                                        $today_end = date('Y-m-d 23:59:59', time());

                                        if ($user_role == 1) {
                                            $orderResult = $this->db->query("SELECT u.fullname,o.* FROM orders o
												LEFT JOIN users u ON o.created_user_id = u.id
												WHERE (o.ordered_datetime >= '$today_start' AND o.ordered_datetime <= '$today_end' ) OR
												(o.adv_ordered_datetime >= '$today_start' AND o.adv_ordered_datetime <= '$today_end' )
												ORDER BY o.id DESC ");
                                        } else {
                                            $orderResult = $this->db->query("SELECT u.fullname,o.* FROM orders o 
												LEFT JOIN users u ON o.created_user_id = u.id
												WHERE (o.ordered_datetime >= '$today_start' AND o.ordered_datetime <= '$today_end') OR
												(o.adv_ordered_datetime >= '$today_start' AND o.adv_ordered_datetime <= '$today_end')
												AND o.outlet_id= '$user_outlet' ORDER BY o.id DESC ");
                                        }
                                        $orderRows = $orderResult->num_rows();


                                        if ($orderRows > 0) {

                                            $orderData = $orderResult->result();

                                            foreach ($orderData as $data) {
                                                /* echo "<pre>";
                                                  print_r($data);
                                                  echo "<pre>"; */
                                                $return_change = $data->return_change;
                                                $order_id = $data->id;
                                                $cust_fn = $data->customer_name;
                                                $ordered_dtm = date("$setting_dateformat H:i A", strtotime($data->ordered_datetime));
                                                $outlet_id = $data->outlet_id;
                                                $subTotal = $data->subtotal;
                                                $discountTotal = $data->discount_total;
                                                $taxTotal = $data->tax;
                                                $grandTotal = $data->grandtotal;
                                                $total_items = $data->total_items;
                                                $payment_method = $data->payment_method;
                                                $status = $data->status;
                                                $outlet_name = $data->outlet_name;
                                                $fullname = $data->fullname;
                                                $order_type = $data->status;
                                                $paid_amt = $data->paid_amt;
                                                $adv_paid_amt = $data->adv_paid_amt;
                                                $totalGrandTotal = $grandTotal + $totalGrandTotal;

                                                $vt_status = $data->vt_status;


                                                $dt = new DateTime($data->ordered_datetime);
                                                $ordered_datetime = $dt->format('Y-m-d');

                                                $advdt = new DateTime($data->adv_ordered_datetime);
                                                $adv_ordered_datetime = $advdt->format('Y-m-d');

                                                $displayPaidAmount = 0;
                                                if ($vt_status == 0) {
                                                    $displayPaidAmount = $displayPaidAmount + $paid_amt;
                                                    $totalPaidAmount = $totalPaidAmount + $paid_amt;
                                                } else {
                                                    if ($adv_ordered_datetime == date("Y-m-d")) {
                                                        $displayPaidAmount = $displayPaidAmount + $adv_paid_amt;
                                                        $totalPaidAmount = $totalPaidAmount + $adv_paid_amt;
                                                    }
                                                    if ($ordered_datetime == date("Y-m-d")) {
                                                        $displayPaidAmount = $displayPaidAmount + $paid_amt;
                                                        $totalPaidAmount = $totalPaidAmount + $paid_amt;
                                                    }
                                                    if ($return_change > 0) {
                                                        $displayPaidAmount = $displayPaidAmount - $return_change;
                                                        $totalPaidAmount = $totalPaidAmount - $return_change;
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $ordered_dtm; ?></td>
                                                    <td><?php echo $order_id; ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td style="font-weight: bold;">
                                                        <?php
                                                        if ($cust_fn == 'Complimentrory') {
                                                            echo 'Comp';
                                                        } else if ($cust_fn == 'Expired / Damaged') {
                                                            echo 'Exp/Dam.';
                                                        } else {
                                                            if ($order_type == '1') {
                                                                echo 'Sale';
                                                            } elseif ($order_type == '2') {
                                                                echo 'Return';
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $outlet_name; ?></td>
                                                    <td><?php echo $cust_fn; ?></td>
                                                    <td><?php echo $total_items; ?></td>
                                                    <td><?php echo $subTotal; ?></td>
                                                    <td><?php echo $taxTotal; ?></td>
                                                    <td><?php echo $displayPaidAmount; ?></td>
                                                    <td><?php echo $grandTotal; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($order_type == '1') {
                                                            ?>
                                                            <a onclick="openReceipt('<?= base_url() ?>pos/view_invoice?id=<?php echo $order_id; ?>')" style="text-decoration: none; cursor: pointer;" title="Print Receipt">
                                                                <i class="fa fa-print fa-2x" style="color: #005b8a;"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        if ($order_type == '2') {
                                                            ?>
                                                            <a onclick="openReceipt('<?= base_url() ?>returnorder/printReturn?return_id=<?php echo $order_id; ?>')" style="text-decoration: none; cursor: pointer;" title="Print Receipt">
                                                                <i class="fa fa-print fa-2x" style="color: #005b8a;"></i>
                                                            </a>
                                                        <?php }
                                                        ?>
                                                        <a href="<?= base_url() ?>sales/deleteSale?id=<?php echo $order_id; ?>" style="text-decoration: none; margin-left: 5px;" title="Delete" onclick="return confirm('Are you confirm to delete this Sale?')">
                                                            <i class="fa fa-times fa-2x" style="color: #F00"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            unset($orderData);
                                        }
                                        ?>

                                    </tbody>
                                    <?php if (($totalPaidAmount > 0) || ($totalGrandTotal > 0)) { ?>
                                        <tfoot>
                                            <tr>
                                                <th width="14%"></th>
                                                <th width="7%"></th>
                                                <th width="7%"></th>
                                                <th width="6%"></th>
                                                <th width="12%"></th>
                                                <th width="10%"></th>
                                                <th width="5%"></th>
                                                <th width="8%"></th>
                                                <th width="8%">Total : </th>
                                                <th width="8%"><?php echo $totalPaidAmount; ?></th>
                                                <th width="8%"><?php echo $totalGrandTotal; ?></th>
                                                <th width="10%"></th>
                                            </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>

                        </div>
                    </div>



                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->
        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->

    <br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>		