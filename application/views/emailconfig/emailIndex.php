<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
        <h1><i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?>                           <small class="pull-right">
                     <a type="button" onclick="test_mail()" class="btn btn-primary btn-sm">Test Email --r</a>
                </small>
                    </h1>
    </section>   
    <section class="content">
        <div class="row">
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-envelope"></i> <?php echo $this->lang->line('email_setting'); ?></h3>
                    </div>   
                    <form id="form1" action="<?php echo base_url() ?>emailconfig/index"   name="employeeform" class="form-horizontal form-label-left" method="post" accept-charset="utf-8">

                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>   
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('email_engine'); ?>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select autofocus="" id="email_type" name="email_type" class="form-control">

                                        <?php
                                        foreach ($mailMethods as $method_key => $method_value) {
                                            ?>
                                            <option value="<?php echo $method_key ?>"
                                                    <?php if (set_value('email_type', $emaillist->email_type) == $method_key) echo "selected=selected" ?>>
                                                <?php echo $method_value ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="text-danger"><?php echo form_error('email_type'); ?></span>
                                </div>
                            </div>   
                            <?php $display = (set_value('email_type', $emaillist->email_type) != "smtp") ? 'ss-none' : '' ?>
                            <div class="is_disabled <?php echo $display; ?>" >


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                        <?php echo $this->lang->line('smtp_username'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" name="smtp_username" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('smtp_username', $emaillist->smtp_username); ?>" />
                                        <span class="text-danger"><?php echo form_error('smtp_username'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                        <?php echo $this->lang->line('smtp_password'); ?>
                                    </label><div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" name="smtp_password" placeholder="" type="password" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_password', $emaillist->smtp_password); ?>" />
                                        <span class="text-danger"><?php echo form_error('smtp_password'); ?></span>
                                    </div></div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                        <?php echo $this->lang->line('smtp_server'); ?>
                                    </label><div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" name="smtp_server" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_server', $emaillist->smtp_server); ?>"  />
                                        <span class="text-danger"><?php echo form_error('smtp_server'); ?></span>
                                    </div>  </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                        <?php echo $this->lang->line('smtp_port'); ?>
                                    </label><div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" name="smtp_port" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_port', $emaillist->smtp_port); ?>"  />
                                        <span class="text-danger"><?php echo form_error('smtp_port'); ?></span>
                                    </div></div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                        <?php echo $this->lang->line('smtp_security'); ?>
                                    </label><div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" name="smtp_security" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_security', $emaillist->ssl_tls); ?>"  />
                                        <span class="text-danger"><?php echo form_error('smtp_security'); ?></span>
                                    </div></div>  
                            </div>                          
                        </div>
                        <div class="box-footer">
                            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
                                <?php 
                                if($this->rbac->hasPrivilege('email_setting','can_edit')){
                                    ?>

                                      <button type="submit" class="btn btn-info pull-left"><?php echo $this->lang->line('save'); ?></button>
                                    <?php

                                }
                                    ?>
                               
                              
                           
                               
                            </div>
                        </div>

                    </form>
                </div>
            </div>           
        </div></section>

<div id="myModal" class="modal fade in" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Test Mail --r</h4>
            </div>
            <div class="modal-body pt0 pb0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                           <div class="">
                                       <form id="sendform" action="<?php echo base_url() ?>emailconfig/test_mail"   name="employeeform" class="form-horizontal form-label-left" method="post" accept-charset="utf-8"> 
                                        <div class="">
                                           
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pwd">Email --r</label><small class="req"> *</small>  
                                            <input type="text" id="title" autocomplete="off" class="form-control" value="" name="email">
                                            <span id="name_add_error" class="text-danger"></span>
                                        </div>

                                    </div>
                                        </div>

                                </div><!--./row--> 
 <div class="box-footer">
                    <div class="pull-right paddA10">

                        <button type="submit" class="btn btn-info pull-right">Send --r</button>
                    </div>
                </div>
                            </form>  
                            </div>                     
                        </div><!--./col-md-12-->       

                    </div><!--./row--> 

                </div>
            </div>
        </div>
    </div>
</div>

</div>


<script type="text/javascript">
    $(document).ready(function () {


        $(document).on('change', '#email_type', function () {
            var selected = $(this).val();
            is_disabled(selected);
        });

    });
    function is_disabled(selected) {
        if (selected != "smtp") {
            $('.is_disabled').slideUp();
        } else {
            $('.is_disabled').slideDown();
        }
    }

    function test_mail(){
        $('#myModal').modal('show');
    }

    $(document).ready(function (e) {
$("#sendform").on('submit', (function (e) {
e.preventDefault();
    $.ajax({
    url: '<?php echo base_url() ?>emailconfig/test_mail',
    type: "POST",
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    if (data.status == "fail") {
    var message = "";
    $.each(data.error, function (index, value) {
    message += value;
    });
    errorMsg(message);
    } else {
    successMsg(data.message);
    window.location.reload(true);
    }
    },
    error: function () {}
    });
}));
});
</script>