<?php require_once 'includes/header.php'; ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i> USERS</a></li>
                </ol>

                <div class="card">
                    <div class="header">
                        <h2>USERS</h2>
                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url() ?>setting/adduser">
                                <button class="btn btn-primary bg-blue"> <i class="material-icons">person_add</i> CREATE</button>
                            </a>
                            <a href="setting/createuser">
                                <button class="btn btn-danger bg-red"><i class="material-icons">delete_forever</i> DELETE</button>
                            </a>
                        </ul>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th width="10%"><?php echo $lang_full_name; ?></th>
                                        <th width="10%"><?php echo $lang_email; ?></th>
                                        <th width="10%"><?php echo $lang_role; ?></th>
                                        <th width="10%"><?php echo $lang_outlets; ?></th>
                                        <th width="10%"><?php echo $lang_status; ?></th>
                                        <th width="10%"><?php echo $lang_action; ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (count($results) > 0) {
                                        foreach ($results as $k => $data) {
                                            $role_id = $data->role_id;
                                            $outlet_id = $data->outlet_id;
                                            $status = $data->status;
                                            $outlet_name = '-';
                                            if ($outlet_id > 0) {
                                                $outletNameData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$outlet_id");
                                                if (count($outletNameData) > 0) {
                                                    $outlet_name = $outletNameData[0]->name;
                                                }
                                            }
                                            $role_name = '';
                                            $roleNameData = $this->Constant_model->getDataOneColumn('user_roles', 'id', "$role_id");
                                            $role_name = $roleNameData[0]->name;
                                            ?>
                                            <tr>
                                                <td><?php echo $k; ?></td>
                                                <td><?php echo $data->fullname; ?></td>
                                                <td><?php echo $data->email; ?></td>
                                                <td><?php echo $role_name; ?></td>
                                                <td><?php echo $outlet_name; ?></td>
                                                <td><?php echo ($status == '1') ? $lang_active : $lang_inactive; ?></td>
                                                <td>
                                                    <a href="<?= base_url() ?>setting/changePassword?id=<?php echo $data->id; ?>">
                                                        <i class="material-icons" title="<?php echo $lang_change_password; ?>">lock_outline</i>
                                                    </a>
                                                    <a href="<?= base_url() ?>setting/edituser?id=<?php echo $data->id; ?>">
                                                        <i class="material-icons" title="<?php echo $lang_edit; ?>">mode_edit</i>
                                                    </a>
                                                    <a href="<?= base_url() ?>setting/deleteUser?id=<?php echo $data->id; ?>">
                                                        <i class="material-icons" title="Delete">delete_forever</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }
                                    }
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