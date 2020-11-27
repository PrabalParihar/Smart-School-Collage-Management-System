<div class="row row-eq">
    <?php
    //print_r($enquiry_data);
    $admin = $this->customlib->getLoggedInUserData();
    // print_r($admin);
    ?>
    <div class="col-lg-8 col-md-8 col-sm-8 paddlr">
        <!-- general form elements -->

        <form id="folow_up_data" method="post" class="ptt10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('follow_up_date'); ?></label><small class="req"> *</small>

                        <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo $enquiry_data['id'] ?>">
                        <input type="hidden" id="enquiry_status" name="enquiry_status" value="<?php echo $enquiry_data['status'] ?>">
                        <input type="text" id="follow_date" name="date" class="form-control date" value="<?php echo set_value('follow_up_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($enquiry_data['date']))); ?>" readonly="">
                        <span class="text-danger" id="date_error"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('next_follow_up_date'); ?></label><small class="req"> *</small>
                        <input type="text" id="follow_date_of_call" name="follow_up_date"class="form-control date" value="<?php echo set_value('follow_up_date') ?>" readonly="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('response'); ?></label><small class="req"> *</small>  
                        <textarea name="response" id="response" class="form-control" ><?php echo set_value('response'); ?></textarea>   
                        <span class="text-danger" id="responce_error"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('note'); ?></label> 
                        <textarea name="note" id="note" class="form-control" ><?php echo set_value('note'); ?></textarea>
                    </div>
                </div>
            </div><!-- /.box-body --> 
            <div class="box-footer pr0">
                <?php 
                if($this->rbac->hasPrivilege('follow_up_admission_enquiry','can_add')){
                    ?>
                    <a onclick="follow_save()" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></a>
                    <?php
                }
                ?>
                
            </div>

        </form>
        <div class="ptbnull">
            <h4 class="box-title titlefix pb5"><?php echo $this->lang->line('follow_up'); ?> (<?php print_r($enquiry_data['name']); ?>)</h4>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="pt20">

            <div class="tab-pane active" id="timeline">
                <!-- The timeline -->            

            </div>                                                        
        </div><!-- /.box-body -->
    </div><!--/.col (left) -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-eq">
        <div class="taskside">
            <?php //print_r($enquiry_data); ?>
            <h4><?php echo $this->lang->line('summary'); ?>
                <div style="font-size: 15px;" class="box-tools pull-right">
                    <label><?php echo $this->lang->line('status'); ?></label>
                    <div class="form-group">
                        <select class="form-control" id="status_data" onchange="changeStatus(this.value, '<?php echo $enquiry_data['id'] ?>')">

                            <?php
                            foreach ($enquiry_status as $enkey => $envalue) {
                                ?>
                                <option <?php
                                if ($enquiry_data["status"] == $enkey) {
                                    echo "selected";
                                }
                                ?> value="<?php echo $enkey ?>"><?php echo $envalue ?></option>   
<?php }
?>
                        </select>
                    </div>
                </div>
            </h4>
            <!-- /.box-tools -->
            <h5 class="pt0 task-info-created">
                <small class="text-dark"><?php echo $this->lang->line('created_by'); ?>: <span class="text-dark"><?php echo $admin['username']; ?></span></small>

            </h5>

            <hr class="taskseparator" />
            <div class="task-info task-single-inline-wrap task-info-start-date">
                <h5><i class="fa task-info-icon fa-fw fa-lg fa-calendar-plus-o pull-left fa-margin"></i>
<?php echo $this->lang->line('enquiry'); ?> <?php echo $this->lang->line('date'); ?>: <?php print_r(date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($enquiry_data['date']))); ?>                                      
                </h5>
            </div>

            <div class="task-info task-single-inline-wrap task-info-start-date">
                <h5><i class="fa task-info-icon fa-fw fa-lg fa-calendar-plus-o pull-left fa-margin"></i>
                    <?php echo $this->lang->line('last_follow_up_date'); ?>: <?php
                    if (!empty($next_date)) {
                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($next_date[0]['date']));
                    }
                    ?>                                      
                </h5>
            </div>
            <div class="task-info task-single-inline-wrap task-info-start-date">
                <h5><i class="fa task-info-icon fa-fw fa-lg fa-calendar-plus-o pull-left fa-margin"></i>
                    <?php echo $this->lang->line('next_follow_up_date'); ?>: <?php
                    if (!empty($next_date)) {
                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($next_date[0]['next_date']));
                    } else {
                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($enquiry_data['follow_up_date']));
                    }
                    ?>                                       
                </h5>
            </div>
            <div class="task-info task-single-inline-wrap ptt10">

                <label><?php echo $this->lang->line('phone'); ?>: <?php echo $enquiry_data['contact']; ?></label>
                <label><?php echo $this->lang->line('address'); ?>: <?php echo $enquiry_data['address']; ?></label>
                <label><?php echo $this->lang->line('reference'); ?>: <?php echo $enquiry_data['reference']; ?></label>
                <label><?php echo $this->lang->line('description'); ?>: <?php echo $enquiry_data['description']; ?></label>
                <label><?php echo $this->lang->line('note'); ?>: <?php echo $enquiry_data['note']; ?></label>
                <label><?php echo $this->lang->line('source'); ?>: <?php echo $enquiry_data['source']; ?></label>
                <label><?php echo $this->lang->line('assigned'); ?>: <?php echo $enquiry_data['assigned']; ?></label>
                <label><?php echo $this->lang->line('email'); ?>: <?php echo $enquiry_data['email']; ?></label>
                <label><?php echo $this->lang->line('class'); ?>: <?php echo $enquiry_data['classname']; ?></label>
                <label><?php echo $this->lang->line('number_of_child'); ?>: <?php echo $enquiry_data['no_of_child']; ?></label>
            </div> 
        </div>
    </div>  
</div>
<script>
  

   

    function follow_save() {
        //alert('Jai Shree Ram');
        var id = $('#enquiry_id').val();
         var status = $('#enquiry_status').val();
        var responce = $('#response').val();
        var follow_date = $('#follow_date').val();
        //  alert(follow_date);

        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/follow_up_insert',
            type: 'POST',
            dataType: 'json',
            data: $("#folow_up_data").serialize(),
            success: function (data) {

                //alert(data);

                if (data.status == "fail") {

                    var message = "";
                    $.each(data.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);
                } else {

                    successMsg(data.message);
                    follow_up_new(id,status);
                }

               
            },

            error: function () {
                alert("Fail")
            }
        });


    }

    // function follow_up(id) {
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/enquiry/follow_up/' + id,
    //         success: function (data) {
    //             $('#getdetails_follow_up').html(data);
    //             $.ajax({
    //                 url: '<?php echo base_url(); ?>admin/enquiry/follow_up_list/' + id,
    //                 success: function (data) {
    //                     $('#timeline').html(data);
    //                 },
    //                 error: function () {
    //                     alert("Fail")
    //                 }
    //             });
    //         },
    //         error: function () {
    //             alert("Fail")
    //         }
    //     });
    // }


function follow_up_new(id, status) {
         
            $.ajax({
                url: '<?php echo base_url(); ?>admin/enquiry/follow_up/' + id + '/' + status,
                success: function (data) {
                    $('#getdetails_follow_up').html(data);
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/enquiry/follow_up_list/' + id,
                        success: function (data) {
                            $('#timeline').html(data);
                        },
                        error: function () {
                            alert("Fail")
                        }
                    });
                },
                error: function () {
                    alert("Fail")
                }
            });
        }

    function changeStatus(status, id) {

       //alert(status+id);

        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/change_status/',
            type: 'POST',
            dataType: 'json',
            data: {status: status, id: id},
            success: function (data) {
                if (data.status == "fail") {

                    errorMsg(data.message);
                } else {

                    successMsg(data.message);
                    follow_up_new(id,status);
                }
            }

        })
    }

</script>