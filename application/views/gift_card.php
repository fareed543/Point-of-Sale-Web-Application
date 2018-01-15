<?php require_once 'includes/header.php'; ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo $lang_gift_card; ?></h2>
                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url() ?>sales/exportSales">
                                <button class="btn btn-primary"> Export to Excel</button>
                            </a>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>.