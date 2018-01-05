<?php
require_once 'includes/header.php';
?>


<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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

                <div class="card">
                    <div class="header">
                        <h2><?php echo $lang_suppliers; ?></h2>

                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>setting/addsupplier">
                                <button class="btn btn-primary"><?php echo $lang_add_supplier; ?></button>
                            </a>

                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th width="20%"><?php echo $lang_name; ?></th>
                                        <th width="15%"><?php echo $lang_email; ?></th>
                                        <th width="10%"><?php echo $lang_telephone; ?></th>
                                        <th width="15%"><?php echo $lang_fax; ?></th>
                                        <th width="10%"><?php echo $lang_status; ?></th>
                                        <th width="10%"><?php echo $lang_action; ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (count($results) > 0) {
                                        foreach ($results as $data) {
                                            $id = $data->id;
                                            $name = $data->name;
                                            $email = $data->email;
                                            $tel = $data->tel;
                                            $fax = $data->fax;
                                            $status = $data->status;
                                            ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <td>
                                                    <?php
                                                    if (empty($email)) {
                                                        echo '-';
                                                    } else {
                                                        echo $email;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (empty($tel)) {
                                                        echo '-';
                                                    } else {
                                                        echo $tel;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (empty($fax)) {
                                                        echo '-';
                                                    } else {
                                                        echo $fax;
                                                    }
                                                    ?>
                                                </td>
                                                <td style="font-weight: bold;">
                                                    <?php
                                                    if ($status == '1') {
                                                        echo '<span style="color: #090;">' . $lang_active . '</span>';
                                                    }
                                                    if ($status == '0') {
                                                        echo '<span style="color: #f9243f;">' . $lang_inactive . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>setting/editsupplier?id=<?php echo $id; ?>" style="text-decoration: none; margin-left: 5px;">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>
                                                    <a href="#">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr class="no-records-found">
                                            <td colspan="6"><?php echo $lang_no_match_found; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>        





                <br /><br /><br />

                <!--</div> Right Colmn // END -->
            </div>
        </div>
</section>


<?php
require_once 'includes/footer.php';
?>