<style type="text/css">
    .material-switch > input[type="checkbox"] {
        display: none;   
    }

    .material-switch > label {
        cursor: pointer;
        height: 0px;
        position: relative; 
        width: 40px;  
    }

    .material-switch > label::before {
        background: rgb(0, 0, 0);
        box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        content: '';
        height: 16px;
        margin-top: -8px;
        position:absolute;
        opacity: 0.3;
        transition: all 0.4s ease-in-out;
        width: 40px;
    }
    .material-switch > label::after {
        background: rgb(255, 255, 255);
        border-radius: 16px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        content: '';
        height: 24px;
        left: -4px;
        margin-top: -8px;
        position: absolute;
        top: -4px;
        transition: all 0.3s ease-in-out;
        width: 24px;
    }
    .material-switch > input[type="checkbox"]:checked + label::before {
        background: inherit;
        opacity: 0.5;
    }
    .material-switch > input[type="checkbox"]:checked + label::after {
        background: inherit;
        left: 20px;
    }
    .table .pull-right {text-align: initial;}
.material-switch{position: absolute; right: 6px;}
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">        

            <div class="col-md-12">            
                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs pull-right">

                        <li><a href="#tab_parent" data-toggle="tab"><?php echo $this->lang->line('parent') ?></a></li>
                        <li><a href="#tab_students" data-toggle="tab"><?php echo $this->lang->line('student') ?></a></li>                        
                        <li class="active"><a href="#tab_system" data-toggle="tab"><?php echo $this->lang->line('system') ?></a></li>

                        <li class="pull-left header"> <?php echo $this->lang->line('modules'); ?></li>
                    </ul>
                    <div class="tab-content">
<div class="tab-pane table-responsive active" id="tab_system">
                            <div class="download_label"><?php echo $this->lang->line('modules'); ?></div>
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                 <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('name'); ?></th>

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                     <?php
                                        if (!empty($permissionList)) {
                                            $count = 1;
                                            foreach ($permissionList as $system) {
                                                ?>
                                            <tr>
                                                <td><?php echo $system['name']; ?></td>



                                                <td class="pull-right">
                                                    <div class="material-switch">

                                                        <input id="system<?php echo $system['id'] ?>" name="someSwitchOption001" type="checkbox" data-role="system" class="chk" data-rowid="<?php echo $system['id'] ?>" value="checked" <?php if ($system['is_active'] == 1) echo "checked='checked'"; ?> />
                                                        <label for="system<?php echo $system['id'] ?>" class="label-success"></label>
                                                    </div>

                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane  table-responsive" id="tab_students">
                            <div class="download_label"><?php echo $this->lang->line('users'); ?></div>
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                 <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('name') ?></th>

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                     <?php
                                        if (!empty($studentpermissionList)) {
                                            $count = 1;
                                            foreach ($studentpermissionList as $student) {
                                                ?>
                                            <tr>
                                                <td><?php echo $student['name']; ?></td>



                                                <td class="pull-right">
                                                    <div class="material-switch">

                                                        <input id="student<?php echo $student['id'] ?>" name="someSwitchOption001" type="checkbox" data-role="student" class="chk" data-rowid="<?php echo $student['id'] ?>" value="checked" <?php if ($student['is_active'] == 1) echo "checked='checked'"; ?> />
                                                        <label for="student<?php echo $student['id'] ?>" class="label-success"></label>
                                                    </div>

                                                </td>
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
                            <div class="download_label"><?php echo $this->lang->line('users'); ?></div>
                           <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                 <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('name') ?></th>

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                     <?php
                                        if (!empty($parentpermissionList)) {
                                            $count = 1;
                                            foreach ($parentpermissionList as $parent) {
                                                ?>
                                            <tr>
                                                <td><?php echo $parent['name']; ?></td>



                                                <td class="pull-right">
                                                    <div class="material-switch">

                                                        <input id="parent<?php echo $parent['id'] ?>" name="someSwitchOption001" type="checkbox" data-role="parent" class="chk" data-rowid="<?php echo $parent['id'] ?>" value="checked" <?php if ($parent['is_active'] == 1) echo "checked='checked'"; ?> />
                                                        <label for="parent<?php echo $parent['id'] ?>" class="label-success"></label>
                                                    </div>

                                                </td>
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
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div> 
        </div> 
    </section>
</div>


<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '.chk', function () {
            var checked = $(this).is(':checked');
            var rowid = $(this).data('rowid');
            var role = $(this).data('role');

            if (checked) {
                if (!confirm('<?php echo $this->lang->line('are_you_sure'); ?>')) {
                    $(this).removeAttr('checked');

                } else {
                    var status = "1";
                    if(role=='system'){
                         changeStatus(rowid, status, role);

                    }else if(role=='parent'){

                        changeParentStatus(rowid, status, role);

                    }else if(role=='student'){

                        changeStudentStatus(rowid, status, role);

                    }
                   

                }

            } else if (!confirm('<?php echo $this->lang->line('are_you_sure'); ?>')) {
                $(this).prop("checked", true);
            } else {
                var status = "0";
                if(role=='system'){
                         changeStatus(rowid, status, role);

                    }else if(role=='parent'){

                        changeParentStatus(rowid, status, role);

                    }else if(role=='student'){
                        
                        changeStudentStatus(rowid, status, role);

                    }

            }
        });
    });

     function changeStatus(rowid, status, role) {


        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/module/changeStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
                window.location.reload();
            }
        });
    }

function changeStudentStatus(rowid, status, role) {

  
        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/module/changeStudentStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
                window.location.reload();
            }
        });
    }

    function changeParentStatus(rowid, status, role) {
      

        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/module/changeParentStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
                window.location.reload();
            }
        });
    }


</script>