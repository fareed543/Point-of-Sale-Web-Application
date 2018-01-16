<?php
require_once 'includes/header.php';

$orderRows = 0;
?>

<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>

<script>
    $(function () {
        $("#startDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });

        $("#endDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });
    });
</script>

<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<?php
$url_outlet = '';
$url_paid_by = '';
$url_start = '';
$url_end = '';

if (isset($_GET['report'])) {
    $url_outlet = $_GET['outlet'];
    $url_paid_by = $_GET['paid'];
    $url_start = $_GET['start_date'];
    $url_end = $_GET['end_date'];
}
?>
<script type="text/javascript">
    function openReceipt(ele) {
        var myWindow = window.open(ele, "", "width=380, height=550");
    }
</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/datatables/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/datatables/jquery.dataTables.min.js"></script>
<link href="<?= base_url() ?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->



            <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
            <ol class="breadcrumb breadcrumb-bg-cyan">
                <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">report</i> <?php echo $lang_sales_report; ?></li>

            </ol>
            <div class="card">


               
                
                    <div class="header">
                        <h3><?php echo $lang_sales_report; ?></h3>
                         <?php
                if (isset($_GET['report'])) {
                    ?>
                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>reports/exportSalesReport?report=<?php echo $_GET['report']; ?>&start_date=<?php echo $url_start; ?>&end_date=<?php echo $url_end; ?>&outlet=<?php echo $url_outlet; ?>&paid=<?php echo $url_paid_by; ?>" style="text-decoration: none;">
                                <button type="button" info="" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo $lang_export_to_excel; ?>
                                </button>
                            </a>
                        </ul>
                        <?php
                }
                ?>
                    </div>
                    

                <div class="row header" style="margin-top: 10px;">
                    <form action="<?= base_url() ?>reports/sales_report" method="get">
                        <!--<div class="col-md-2"></div>-->
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_outlets; ?></label>
                                <select name="outlet" class="form-control show-tick" data-live-search="true" required>
                                    <?php
                                    if ($user_role == '1') {
                                        ?>
                                        <option value=""><?php echo $lang_choose_outlet; ?></option>
                                        <option value="-" <?php
                                        if ($url_outlet == '-') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_all_outlets; ?></option>
                                                <?php
                                            }
                                            ?>

                                    <?php
                                    if ($user_role == '1') {
                                        $outletData = $this->Constant_model->getDataAll('outlets', 'id', 'ASC');
                                    } else {
                                        $outletData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$user_outlet");
                                    }
                                    for ($o = 0; $o < count($outletData); ++$o) {
                                        $outlet_id = $outletData[$o]->id;
                                        $outlet_fn = $outletData[$o]->name;
                                        ?>
                                        <option value="<?php echo $outlet_id; ?>" <?php
                                        if ($url_outlet == $outlet_id) {
                                            echo 'selected="selected"';
                                        }
                                        ?>>
                                                    <?php echo $outlet_fn; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_paid_by; ?></label>
                                <select name="paid" class="form-control show-tick" data-live-search="true" required>
                                    <option value=""><?php echo $lang_choose_paid_by; ?></option>
                                    <option value="-" <?php
                                    if ($url_paid_by == '-') {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?php echo $lang_all; ?></option>
                                            <?php
                                            $paymentData = $this->Constant_model->getDataAll('payment_method', 'name', 'ASC');
                                            for ($p = 0; $p < count($paymentData); ++$p) {
                                                $pay_id = $paymentData[$p]->id;
                                                $pay_name = $paymentData[$p]->name;
                                                ?>
                                        <option value="<?php echo $pay_id; ?>" <?php
                                        if ($url_paid_by == "$pay_id") {
                                            echo 'selected="selected"';
                                        }
                                        ?>>
                                                    <?php echo $pay_name; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_start_date; ?></label>
                                <input type="text" name="start_date" class="form-control" id="startDate" required value="<?php echo $url_start; ?>"  />

                            </div>


                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_end_date; ?></label>
                                <input type="text" name="end_date" class="form-control" id="endDate" required value="<?php echo $url_end; ?>" />

                            </div>


                        </div>

                        <div class="col-md-2">
                            <div class="form-line">
                                <input type="hidden" name="report" value="1" />
                                <label>&nbsp;</label><br />
                                <button class="btn btn-primary" style="width: 100%;">&nbsp;&nbsp;<?php echo $lang_get_report; ?>&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <?php
                if (isset($_GET['report'])) {
                    if ($site_dateformat == 'd/m/Y') {
                        $startArray = explode('/', $url_start);
                        $endArray = explode('/', $url_end);

                        $start_day = $startArray[0];
                        $start_mon = $startArray[1];
                        $start_yea = $startArray[2];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[0];
                        $end_mon = $endArray[1];
                        $end_yea = $endArray[2];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    if ($site_dateformat == 'd.m.Y') {
                        $startArray = explode('.', $url_start);
                        $endArray = explode('.', $url_end);

                        $start_day = $startArray[0];
                        $start_mon = $startArray[1];
                        $start_yea = $startArray[2];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[0];
                        $end_mon = $endArray[1];
                        $end_yea = $endArray[2];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    if ($site_dateformat == 'd-m-Y') {
                        $startArray = explode('-', $url_start);
                        $endArray = explode('-', $url_end);

                        $start_day = $startArray[0];
                        $start_mon = $startArray[1];
                        $start_yea = $startArray[2];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[0];
                        $end_mon = $endArray[1];
                        $end_yea = $endArray[2];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }

                    if ($site_dateformat == 'm/d/Y') {
                        $startArray = explode('/', $url_start);
                        $endArray = explode('/', $url_end);

                        $start_day = $startArray[1];
                        $start_mon = $startArray[0];
                        $start_yea = $startArray[2];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[1];
                        $end_mon = $endArray[0];
                        $end_yea = $endArray[2];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    if ($site_dateformat == 'm.d.Y') {
                        $startArray = explode('.', $url_start);
                        $endArray = explode('.', $url_end);

                        $start_day = $startArray[1];
                        $start_mon = $startArray[0];
                        $start_yea = $startArray[2];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[1];
                        $end_mon = $endArray[0];
                        $end_yea = $endArray[2];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    if ($site_dateformat == 'm-d-Y') {
                        $startArray = explode('-', $url_start);
                        $endArray = explode('-', $url_end);

                        $start_day = $startArray[1];
                        $start_mon = $startArray[0];
                        $start_yea = $startArray[2];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[1];
                        $end_mon = $endArray[0];
                        $end_yea = $endArray[2];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }

                    if ($site_dateformat == 'Y.m.d') {
                        $startArray = explode('.', $url_start);
                        $endArray = explode('.', $url_end);

                        $start_day = $startArray[2];
                        $start_mon = $startArray[1];
                        $start_yea = $startArray[0];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[2];
                        $end_mon = $endArray[1];
                        $end_yea = $endArray[0];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    if ($site_dateformat == 'Y/m/d') {
                        $startArray = explode('/', $url_start);
                        $endArray = explode('/', $url_end);

                        $start_day = $startArray[2];
                        $start_mon = $startArray[1];
                        $start_yea = $startArray[0];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[2];
                        $end_mon = $endArray[1];
                        $end_yea = $endArray[0];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    if ($site_dateformat == 'Y-m-d') {
                        $startArray = explode('-', $url_start);
                        $endArray = explode('-', $url_end);

                        $start_day = $startArray[2];
                        $start_mon = $startArray[1];
                        $start_yea = $startArray[0];

                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                        $end_day = $endArray[2];
                        $end_mon = $endArray[1];
                        $end_yea = $endArray[0];

                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                    }
                    ?>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th width="12%"><?php echo $lang_date; ?></th>
                                    <th width="5%"><?php echo $lang_sale_id; ?></th>
                                    <th width="12%"><?php echo $lang_users; ?></th>
                                    <th width="12%"><?php echo $lang_outlets; ?></th>
                                    <th width="10%"><?php echo $lang_payment_methods; ?></th>
                                    <th width="10%"><?php echo $lang_sub_total; ?> (<?php echo $site_currency; ?>)</th>
                                    <th width="10%"><?php echo $lang_tax; ?> (<?php echo $site_currency; ?>)</th>
                                    <th width="10%"><?php echo $lang_grand_total; ?> (<?php echo $site_currency; ?>)</th>
                                    <th width="5%"><?php echo $lang_print; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_sub_amt = 0;
                                $total_tax_amt = 0;
                                $total_grand_amt = 0;

                                $url_start = date('Y-m-d', strtotime($url_start));
                                $url_end = date('Y-m-d', strtotime($url_end));

                                $start_date = $url_start . ' 00:00:00';
                                $end_date = $url_end . ' 23:59:59';

                                $paid_sort = '';
                                if ($url_paid_by == '-') {
                                    $paid_sort = ' AND o.payment_method >= 0 ';
                                } else {
                                    $paid_sort = " AND o.payment_method = '$url_paid_by' ";
                                }

                                $outlet_sort = '';
                                if ($url_outlet == '-') {
                                    $outlet_sort = ' AND o.outlet_id >= 0 ';
                                } else {
                                    $outlet_sort = " AND o.outlet_id = '$url_outlet' ";
                                }

                                $orderResult = $this->db->query("SELECT u.fullname,o.* FROM orders o
													LEFT JOIN users u ON o.created_user_id = u.id
													WHERE o.ordered_datetime >= '$start_date' AND o.ordered_datetime <= '$end_date' $paid_sort $outlet_sort ORDER BY o.ordered_datetime DESC ");
                                $orderRows = $orderResult->num_rows();

                                if ($orderRows > 0) {
                                    $orderData = $orderResult->result();
                                    for ($od = 0; $od < count($orderData); ++$od) {
                                        $order_id = $orderData[$od]->id;
                                        $order_dtm = date("$site_dateformat H:i A", strtotime($orderData[$od]->ordered_datetime));
                                        $outlet_id = $orderData[$od]->outlet_id;
                                        $subTotal = $orderData[$od]->subtotal;
                                        $tax = $orderData[$od]->tax;
                                        $grandTotal = $orderData[$od]->grandtotal;
                                        $pay_method_id = $orderData[$od]->payment_method;
                                        $cheque_numb = $orderData[$od]->cheque_number;
                                        $customer_id = $orderData[$od]->customer_id;
                                        $customer_name = $orderData[$od]->customer_name;
                                        $fullname = $orderData[$od]->fullname;

                                        $outlet_name = $orderData[$od]->outlet_name;
                                        $payment_method_name = $orderData[$od]->payment_method_name;
                                        $order_type = $orderData[$od]->status;
                                        ?>
                                        <tr>
                                            <td><?php echo $order_dtm; ?></td>
                                            <td><?php echo $order_id; ?></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $outlet_name; ?></td>
                                            <td><?php
                                                if ($customer_id == 3 || ($customer_id == 4)) {
                                                    echo $customer_name;
                                                } else {
                                                    echo $payment_method_name;
                                                    if (!empty($cheque_numb)) {
                                                        echo "<br />(Cheque No. : $cheque_numb)";
                                                    }
                                                }
                                                ?></td>
                                            <td><?php echo number_format($subTotal, 2, '.', ''); ?></td>
                                            <td><?php echo number_format($tax, 2, '.', ''); ?></td>
                                            <td><?php echo number_format($grandTotal, 2, '.', ''); ?></td>


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

                                            </td>
                                        </tr>
                                     <?php
                                                        $total_sub_amt += $subTotal;
                                                        $total_tax_amt += $tax;
                                                        $total_grand_amt += $grandTotal;

                                                        unset($order_id);
                                                        unset($order_dtm);
                                                        unset($outlet_id);
                                                        unset($subTotal);
                                                        unset($subTotal);
                                                        unset($grandTotal);
                                                    }
                                                    unset($orderData);
                                                }
                                                unset($orderResult);
                                                ?>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr  style="text-align:center;">
                                    <th></th>
                                    <th style="text-align:center;">Summary</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;"><?php echo $lang_sub_total; ?> (<?php echo $site_currency; ?>)</th>
                                    <th style="text-align:center;"><?php echo $lang_tax_total; ?> (<?php echo $site_currency; ?>)</th>
                                    <th style="text-align:center;"><?php echo $lang_grand_total; ?> (<?php echo $site_currency; ?>)</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <td style="text-align:center;"> <?php echo number_format($total_sub_amt, 2); ?></td>
                            <td style="text-align:center;"><?php echo number_format($total_tax_amt, 2); ?></td>
                            <td style="text-align:center;"><?php echo number_format($total_grand_amt, 2); ?></td>
                            </tbody>
                        </table>
                 <?php
                        }
                        ?>
                


            </div>
            <!--</div>-->
            <!-- #END# Task Info -->
        </div>
    </div>
</section>



<?php
require_once 'includes/footer.php';
?>			