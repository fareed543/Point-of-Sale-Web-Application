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
            <h1 class="page-header"><?php echo $lang_gift_card; ?></h1>
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

                    <!--
                    <div class="row">
                            <div class="col-md-12" style="text-align: right;">
                                    <a href="<?= base_url() ?>sales/exportSales" style="text-decoration: none">
                                            <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                                    Export to Excel
                                            </button>
                                    </a>
                            </div>
                    </div>
                    -->

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="20%"><?php echo $lang_gift_card_number; ?></th>
                                            <th width="20%"><?php echo $lang_value; ?> (<?php echo $currency; ?>)</th>
                                            <th width="20%"><?php echo $lang_expiry_date; ?></th>
                                            <th width="20%"><?php echo $lang_status; ?></th>
                                            <th width="20%"><?php echo $lang_action; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $giftResult = $this->db->query('SELECT * FROM gift_card ORDER BY id DESC ');
                                        $giftData = $giftResult->result();

                                        for ($g = 0; $g < count($giftData); ++$g) {
                                            $gift_id = $giftData[$g]->id;
                                            $gift_numb = $giftData[$g]->card_number;
                                            $gift_value = $giftData[$g]->value;
                                            $gift_expiry = date("$dateformat", strtotime($giftData[$g]->expiry_date));
                                            $gift_status = $giftData[$g]->status;
                                            ?>
                                            <tr>
                                                <td><?php echo $gift_numb; ?></td>
                                                <td><?php echo number_format($gift_value, 2); ?></td>
                                                <td><?php echo $gift_expiry; ?></td>
                                                <td style="font-weight: bold;">
                                                    <?php
                                                    if ($gift_status == '0') {
                                                        echo $lang_not_in_use;
                                                    }
                                                    if ($gift_status == '1') {
                                                        echo $lang_used;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($gift_status == '0') {
                                                        if ($user_role == '1') {
                                                            ?>
                                                            <a href="<?= base_url() ?>gift_card/deletegiftcard?id=<?php echo $gift_id; ?>" style="text-decoration: none; margin-left: 5px;" title="Delete" onclick="return confirm('Are you confirm to delete this Gift Card : <?php echo $gift_numb; ?>?')">
                                                                <i class="icono-crossCircle" style="color: #F00"></i>
                                                            </a>
                                                            <?php
                                                        } else {
                                                            echo '-';
                                                        }
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            unset($gift_id);
                                            unset($gift_numb);
                                            unset($gift_value);
                                            unset($gift_expiry);
                                            unset($gift_status);
                                        }

                                        unset($giftResult);
                                        unset($giftData);
                                        ?>
                                    </tbody>
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