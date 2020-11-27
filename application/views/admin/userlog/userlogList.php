<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-line-chart"></i> <?php echo $this->lang->line('reports'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">        

            <div class="col-md-12">            
                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs pull-right">

                        <li><a href="#tab_parent" data-toggle="tab"><?php echo $this->lang->line('parent'); ?></a></li>
                        <li><a href="#tab_student" data-toggle="tab"><?php echo $this->lang->line('students'); ?></a></li>

                        <li><a href="#tab_staff" data-toggle="tab"><?php echo $this->lang->line('staff') ?></a></li>
                        <li class="active"><a href="#tab_allusers" data-toggle="tab"><?php echo $this->lang->line('all_users'); ?></a></li>

                        <li class="pull-left header"><i class="fa fa-sign-in"></i> <?php echo $this->lang->line('user_log'); ?></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active table-responsive" id="tab_allusers">
                            <div class="download_label"><?php echo $this->lang->line('user_log'); ?></div>
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('users'); ?></th>
                                        <th><?php echo $this->lang->line('role'); ?></th>
                                        <th><?php echo $this->lang->line('ip_address'); ?></th>
                                        <th><?php echo $this->lang->line('login_time'); ?></th>
                                        <th><?php echo $this->lang->line('user_agent'); ?></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($userlogList)) {
                                        $count = 1;
                                        foreach ($userlogList as $userlog) {
                                            ?>
                                            <tr>
                                                <td><?php echo $userlog['user']; ?></td>                                                
                                                <td><?php echo ucfirst($userlog['role']); ?></td>
                                                <td><?php echo $userlog['ipaddress']; ?></td>
                                                <td>
                                                    <?php
                                                    $date_time = strtotime($userlog['login_datetime']);
                                                    $date = date('Y-m-d', $date_time);
                                                    $time = date('H:i:s', $date_time);
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date)) . " " . $time;
                                                    ?>

                                                </td>
                                                <td><?php echo $userlog['user_agent']; ?></td>  
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                        <!-- /.tab-pane -->
                        <div class="tab-pane table-responsive" id="tab_staff">
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('users'); ?></th>
                                        <th><?php echo $this->lang->line('role'); ?></th>
                                        <th><?php echo $this->lang->line('ip_address'); ?></th>
                                        <th><?php echo $this->lang->line('login_time'); ?></th>
                                        <th><?php echo $this->lang->line('user_agent'); ?></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($userlogStaffList)) {
                                        $count = 1;
                                        foreach ($userlogStaffList as $userlogAdmin) {
                                            ?>
                                            <tr>
                                                <td><?php echo $userlogAdmin['user']; ?></td>                                                
                                                <td><?php echo ucfirst($userlogAdmin['role']); ?></td>
                                                <td><?php echo $userlogAdmin['ipaddress']; ?></td>
                                                <td>
                                                    <?php
                                                    $date_time = strtotime($userlogAdmin['login_datetime']);
                                                    $date = date('Y-m-d', $date_time);
                                                    $time = date('H:i:s', $date_time);
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date)) . " " . $time;
                                                    ?>


                                                </td>
                                                <td><?php echo $userlogAdmin['user_agent']; ?></td>  
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>



                        <!-- /.tab-pane -->
                        <div class="tab-pane table-responsive" id="tab_student">
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('users'); ?></th>
                                        <th><?php echo $this->lang->line('role'); ?></th>
                                        <th><?php echo $this->lang->line('ip_address'); ?></th>
                                        <th><?php echo $this->lang->line('login_time'); ?></th>
                                        <th><?php echo $this->lang->line('user_agent'); ?></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($userlogStudentList)) {
                                        $count = 1;
                                        foreach ($userlogStudentList as $userlogStudent) {
                                            ?>
                                            <tr>
                                                <td><?php echo $userlogStudent['user']; ?></td>                                                
                                                <td><?php echo ucfirst($userlogStudent['role']); ?></td>
                                                <td><?php echo $userlogStudent['ipaddress']; ?></td>
                                                <td>
                                                    <?php
                                                    $date_time = strtotime($userlogStudent['login_datetime']);
                                                    $date = date('Y-m-d', $date_time);
                                                    $time = date('H:i:s', $date_time);
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date)) . " " . $time;
                                                    ?>

                                                </td>
                                                <td><?php echo $userlogStudent['user_agent']; ?></td>  
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane table-responsive" id="tab_parent">
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('users'); ?></th>
                                        <th><?php echo $this->lang->line('role'); ?></th>
                                        <th><?php echo $this->lang->line('ip_address'); ?></th>
                                        <th><?php echo $this->lang->line('login_time'); ?></th>
                                        <th><?php echo $this->lang->line('user_agent'); ?></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($userlogParentList)) {
                                        $count = 1;
                                        foreach ($userlogParentList as $userlogParent) {
                                            ?>
                                            <tr>
                                                <td><?php echo $userlogParent['user']; ?></td>                                                
                                                <td><?php echo ucfirst($userlogParent['role']); ?></td>
                                                <td><?php echo $userlogParent['ipaddress']; ?></td>
                                                <td>
                                                    <?php
                                                    $date_time = strtotime($userlogParent['login_datetime']);
                                                    $date = date('Y-m-d', $date_time);
                                                    $time = date('H:i:s', $date_time);
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date)) . " " . $time;
                                                    ?>

                                                </td>
                                                <td><?php echo $userlogParent['user_agent']; ?></td>  
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div> 
        </div> 
    </section>
</div>

