<div class="wrapper wrapper-content">
    <h3>Welcome Vendor <span class="text-success">
            <?php
            $user = getUser($this->session->userdata('user_id'));
            if (!empty($user)) {
                echo ucwords($user->first_name . " (" . $user->team_code . ")");
            }
            ?></span></h3>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <div class="stat-percent font-bold text-success"> <i class="fa fa-trophy"></i></div>
                                <h5 ><a class="text-success" href="<?php echo base_url() . 'users'; ?>">Users</a></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                    <?php
                                    $option = array('table' => 'users');
                                    echo commonCountHelper($option);
                                    ?>
                                </h1>
                                <small>Total Users</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>