
<div class="row">
            <div class="col-md-12">
                <div class="box box-primary border0 mb0 margesection">
                    <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('finance')?></h3>

            </div>
                    <div class="">
                        <ul class="reportlists">
                        	
                         <?php
                             if ($this->rbac->hasPrivilege('fees_statement', 'can_view')) {
                                ?>
                                <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/reportbyname'); ?>"><a href="<?php echo base_url(); ?>studentfee/reportbyname"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('fees_statement'); ?></a></li>
                                <?php
                            }
                             if ($this->rbac->hasPrivilege('balance_fees_report', 'can_view')) {
                                ?>

                                <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/studentacademicreport'); ?>"><a href="<?php echo base_url(); ?>admin/transaction/studentacademicreport"><i class="fa fa-file-text-o"></i>
                                        <?php echo $this->lang->line('balance_fees_report'); ?></a></li>
                                <?php
                            } 
                             if ($this->rbac->hasPrivilege('fees_collection_report', 'can_view')) {
                               
                            ?>

                            <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/collection_report'); ?>"><a href="<?php echo base_url(); ?>studentfee/collection_report"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('fees')." ".$this->lang->line('collection')." ".$this->lang->line('report'); ?></a></li>
                        <?php } if($this->rbac->hasPrivilege('online_fees_collection_report','can_view')){?>
                        <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/onlinefees_report'); ?>"><a href="<?php echo base_url(); ?>report/onlinefees_report"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('online')." ".$this->lang->line('fees')." ".$this->lang->line('collection')." ".$this->lang->line('report'); ?></a></li>
                    <?php }
                     if($this->rbac->hasPrivilege('income_report','can_view')){ ?>
                         <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/income'); ?>"><a href="<?php echo base_url(); ?>report/income"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('income')." ".$this->lang->line('report'); ?></a></li>
                     <?php } 
                     if($this->rbac->hasPrivilege('expense_report','can_view')){ ?>
                         <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/expense'); ?>"><a href="<?php echo base_url(); ?>report/expense"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('expense').' '.$this->lang->line('report'); ?></a></li>
                     <?php } 
                     if($this->rbac->hasPrivilege('payroll_report','can_view')){?>
                         <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/payroll'); ?>"><a href="<?php echo base_url(); ?>report/payroll"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('payroll')." ".$this->lang->line('report'); ?></a></li>
                     <?php } 
                     if($this->rbac->hasPrivilege('income_group_report','can_view')){ ?>
                         <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/incomegroup'); ?>"><a href="<?php echo base_url(); ?>report/incomegroup"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('income')." ".$this->lang->line('group')." ".$this->lang->line('report'); ?></a></li>
                     <?php } 
                     if($this->rbac->hasPrivilege('expense_group_report','can_view')){ ?> 
                         <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/finance/expensegroup'); ?>"><a href="<?php echo base_url(); ?>report/expensegroup"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('expense')." ".$this->lang->line('group')." ".$this->lang->line('report'); ?></a></li>
                     <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>