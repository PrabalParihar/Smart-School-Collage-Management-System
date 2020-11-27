<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
             <?php echo $this->lang->line('system_settings'); 

            // print_r(validation_errors());
             //die; ?> </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
 
                <div class="nav-tabs-custom box box-primary theme-shadow">
                    
                    <ul class="nav nav-tabs pull-right">
                        <li ><a href="#tab_4" data-toggle="tab"><?php echo $this->lang->line('payslip')?></a></li>
                        <li class="active"><a href="#tab_3" data-toggle="tab"><?php echo $this->lang->line('fees_receipt'); ?></a></li>
                       
                        <li class="pull-left header"> <?php echo $this->lang->line('print_headerfooter'); ?></li>
                    </ul>
                    <div class="tab-content">
                        <?php if ($this->session->flashdata('msg')!='') { 
                                    $msg=$this->session->flashdata('msg');
                                    ?>
                                
                                    <?php echo $msg ?>
                                <?php } ?>    
                                <?php echo $this->customlib->getCSRF(); ?>
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="tab_3">
                            <form role="form"  enctype="multipart/form-data" action="<?php echo site_url('admin/print_headerfooter/edit') ?>" class="" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('header')." ".$this->lang->line('image'). " (2230px X 300px)"; ?></label>
                                                <input id="documents" data-default-file="<?php echo base_url()?>./uploads/print_headerfooter/student_receipt/<?php echo $result[1]['header_image']?>" placeholder="" type="file" class="filestyle form-control" data-height="180"  name="header_image">
                                                 <input  placeholder="" type="hidden" class="form-control" value="student_receipt" name="type">
                                                 <span class="text-danger"><?php echo form_error('header_image'); ?></span>
                                            </div>
                                                            <div class="form-group"><label><?php echo $this->lang->line('footer')." ".$this->lang->line('content'); ?><small class="req"> *</small></label>
                                                    <textarea id="student_textarea" name="message1" class="form-control" style="height: 250px">
                                                         <?php echo set_value('message1',$result[1]['footer_content']); ?>
                                                    </textarea>
                                                    <span class="text-danger"><?php echo form_error('message1'); ?></span>
                                                </div>
                                        </div>
                                    

                               
                               <div class="col-lg-12">         
                                <div class="pull-right">
                                    <?php if($this->rbac->hasPrivilege('payment_methods', 'can_edit')){ ?>
                                    <button type="submit" class="btn btn-primary " data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                                <?php } ?>
                                </div>
                              </div>  
                            </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_4">
                            <form role="form" action="<?php echo site_url('admin/print_headerfooter') ?>" class="" enctype="multipart/form-data" method="post">
                                <div class="row">
                                  <div class="col-md-12">     
                                     <div class="form-group">
                                    <label><?php echo $this->lang->line('header')." ".$this->lang->line('image'). " (2230px X 300px)"; ?></label>
                                    <input id="documents" data-default-file="<?php echo base_url()?>./uploads/print_headerfooter/staff_payslip/<?php echo $result[0]['header_image']?>" placeholder="" type="file" class="filestyle form-control" data-height="180"  name="header_image">
                                     <input  placeholder="" type="hidden" class="form-control" value="staff_payslip" name="type">
                                      <span class="text-danger"><?php echo form_error('header_image'); ?></span>
                                </div>
                                    <div class="form-group"><label><?php echo $this->lang->line('footer')." ".$this->lang->line('content'); ?><small class="req"> *</small></label>
                                        <textarea id="staff_textarea" name="message" class="form-control" style="height: 250px">
                                            <?php echo set_value('message',$result[0]['footer_content']); ?>
                                        </textarea>
                                        <span class="text-danger"><?php echo form_error('message'); ?></span>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                                    </div>
                                 </div>   
                              </div>  
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            
        </div>  
    </section>
</div>


<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        $("#staff_textarea").wysihtml5();
        $("#student_textarea").wysihtml5();
        
    });
</script>


