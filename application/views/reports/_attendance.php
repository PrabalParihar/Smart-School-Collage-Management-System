

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary border0 mb0 margesection">
                    <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('attendance')." ".$this->lang->line('report')?></h3>

            </div>
                    <div class="">
                        <ul class="reportlists">
                       <?php
                       if (!is_subAttendence()) { 

                       
                             if ($this->rbac->hasPrivilege('attendance_report', 'can_view')) {
                                ?> 
                                <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/attendance/attendance_report'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/classattendencereport"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('attendance_report'); ?></a></li>
                                <?php
                            } 
                            if($this->rbac->hasPrivilege('student_attendance_type_report','can_view')){
                              ?>
                              <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/attendence/attendancereport'); ?>"><a href="<?php echo base_url() ?>report/attendancereport"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('student')." ".$this->lang->line('attendance')." ".$this->lang->line('type')." ".$this->lang->line('report'); ?></a></li>
                              <?php
                            }
                            }
                            if($this->rbac->hasPrivilege('staff_attendance_report','can_view')){
                             ?>
                            
                            <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/attendance/staff_attendance_report'); ?>"><a href="<?php echo base_url() ?>admin/staffattendance/attendancereport"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('staff_attendance_report'); ?></a></li>
                        <?php } ?>
                         <?php
                          if (is_subAttendence()) { 
                            if(($this->rbac->hasPrivilege('student_period_attendance_report','can_view'))){
                             ?>
                            
                             <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_subSubmenu('Reports/attendence/reportbymonth'); ?>"><a href="<?php echo site_url('admin/subjectattendence/reportbymonth'); ?>"><i class="fa fa-file-text-o"></i> <?php ?> <?php echo $this->lang->line('period') . " " . $this->lang->line('attendance') . " " . $this->lang->line('report'); ?></a></li>
                              <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_subSubmenu('Reports/attendence/reportbymonthstudent'); ?>"><a href="<?php echo site_url('admin/subjectattendence/reportbymonthstudent'); ?>"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('student') . " " . $this->lang->line('period') . " " . $this->lang->line('attendance'); ?></a></li>
                        <?php } }
                        if($this->customlib->is_biometricAttendence()){
                        if($this->rbac->hasPrivilege('biometric_attendance_log','can_view')){
                            ?>
                            <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/attendence/biometric_attlog'); ?>"><a href="<?php echo site_url('report/biometric_attlog'); ?>"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('biometric') . " " . $this->lang->line('attendance') . " " . $this->lang->line('log'); ?></a></li>
                            <?php
                        }}
                        ?>

                         
                       
                        </ul>
                    </div>
                </div>
            </div>
        </div>