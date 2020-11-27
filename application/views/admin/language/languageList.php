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
    .table .pull-right {text-align: initial; width: auto}
    .alert-warning{ overflow: hidden;text-overflow: ellipsis;}
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?><small><?php echo $this->lang->line('setting1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-language"></i> <?php echo $this->lang->line('language_list'); ?></h3>

                        <div class="box-tools pull-right">
                            <div class="box-tools pull-right">
                                <a href="<?php echo base_url(); ?>admin/language/create" class="btn btn-primary btn-sm" data-placement="left" data-toggle="tooltip" title="<?php echo $this->lang->line('add'); ?>" >
                                    <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                                </a>
                            </div>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-warning">
                            To change language key phrases, go your language directory e.g. for English language go edit file  /application/language/English/app_files/system_lang.php
                        </div>
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <?php echo $this->session->flashdata('msg') ?>
                        <?php } ?>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo $this->lang->line('language'); ?></th>
                                       
                                        <th><?php echo $this->lang->line('short_code'); ?></th>
                                        <th><?php echo $this->lang->line('country_code'); ?></th>
                                         <th><?php echo $this->lang->line('status'); ?></th>
                                         <th><?php echo $this->lang->line('active'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                    <tbody id="result_data">
                                    <?php $this->load->view('admin/language/languageResult'); ?>
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var onload=  $('#languageSwitcher').val();
      //load();
        $(document).on('click', '.chk', function () {
            var checked = $(this).is(':checked');
           
            var rowid = $(this).data('rowid');
            var role = $(this).data('role');
            var confirm_msg='<?php echo $this->lang->line('confirm_msg') ?>';
           
            if (checked) {

                if (!confirm(confirm_msg)) {
                    $(this).removeAttr('checked');

                } else {
                    var status = "yes";

                    if(role=='2'){
                        changeStatusselect(rowid);
                    }else{
                        changeStatusunselect(rowid);
                    }

                }

            } else if (!confirm(confirm_msg)) {

                $(this).prop("checked", true);
            } else {
                
                var status = "no";
                if(role=='2'){
                        changeStatusselect(rowid);
                    }else{
                        changeStatusunselect(rowid);
                    }

            }
        });
    });

    function changeStatusselect(rowid) {

        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/language/select_language/"+rowid,
            data: {},
            
            success: function (data) {
                successMsg("Status Change Successfully");
              $('#languageSwitcher').html(data);
             
               window.location.reload('true');
            }

        });
    }

    function changeStatusunselect(rowid) {

 
        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/language/unselect_language/"+rowid,
            data: {},
           
            success: function (data) {

               successMsg("Status Change Successfully");
               window.location.reload('true');
           }
        });
    }


function load(){
 $.ajax({
        type: "POST",
        url: '<?php echo base_url() ?>admin/language/onloadlanguage',
        data: {},
        //dataType: "json",
        success: function (data) {
           window.location.reload('true');
          
        }
        });
}

    function defoult(id){
        $.ajax({
        type: "POST",
        url: '<?php echo base_url() ?>admin/language/defoult_language/'+id,
        data: {},
        //dataType: "json",
        success: function (data) {
           window.location.reload('true');
          
        }
        });
    }

</script>