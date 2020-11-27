        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary border0 mb0 margesection">
                    <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('human_resource')." ".$this->lang->line('report')?></h3>
            </div>
                    <div class="">
                        <ul class="reportlists">
                     <?php if($this->rbac->hasPrivilege('staff_report','can_view')){ ?>
                                <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/human_resource/staff_report'); ?>"><a href="<?php echo base_url(); ?>report/staff_report"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('staff')." ".$this->lang->line('report'); ?></a></li>
                                     <?php
                                     }
                                      if(($this->rbac->hasPrivilege('payroll_report','can_view'))){ ?>
                                 <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/attendance/attendance_report'); ?>">
                                <a href="<?php echo base_url(); ?>admin/payroll/payrollreport"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('payroll')." ".$this->lang->line('report'); ?></a>
                            </li>
                        <?php } ?>
                                                  </ul>
                    </div>
                </div>
            </div>
        </div>